<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePropertyRequest;
use App\Http\Requests\Api\UpdatePropertyRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use App\Models\Setting;
use App\Services\PropertyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function __construct(private PropertyService $properties) {}

    public function index(Request $request)
    {
        $query = Property::with(['media', 'images', 'videos', 'cover', 'sections'])
            ->where('is_active', true);

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        if ($request->filled('purpose') && in_array($request->purpose, ['بيع', 'إيجار'])) {
            $query->where('purpose', $request->purpose);
        }

        if ($request->filled('max_price')) {
            $query->where('price_usd', '<=', (float) $request->max_price);
        }

        $sectionIds = $request->input('section_ids', $request->input('section_id'));

        if ($sectionIds !== null && $sectionIds !== '' && $sectionIds !== []) {
            $query->inSection($sectionIds);
        }

        $properties = $query->latest()->paginate($request->get('per_page', 15));
        $properties->getCollection()->transform(fn ($property) => (new PropertyResource($property))->resolve());

        return response()->json($properties);
    }

    public function show(Property $property)
    {
        if (! $property->is_active) {
            return response()->json(['message' => 'العقار غير موجود'], 404);
        }

        $property->load(['media', 'images', 'videos', 'cover', 'sections']);

        return response()->json((new PropertyResource($property))->resolve());
    }

    public function store(StorePropertyRequest $request)
    {
        $data = $this->propertyData($request);
        $property = $this->properties->create(
            $data,
            $this->sectionIds($request) ?? [],
            $this->mediaFiles($request)
        );

        return response()->json((new PropertyResource($property))->resolve(), 201);
    }

    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $data = $this->propertyData($request);

        if ($request->has('is_active')) {
            $data['is_active'] = $request->boolean('is_active');
        }

        $property = $this->properties->update(
            $property,
            $data,
            $this->sectionIds($request),
            $this->mediaFiles($request)
        );

        return response()->json((new PropertyResource($property))->resolve());
    }

    public function destroy(Property $property)
    {
        $this->properties->delete($property);

        return response()->json(['message' => 'تم حذف العقار']);
    }

    private function propertyData(Request $request): array
    {
        $data = $request->validated();
        unset($data['section_ids'], $data['sections_present'], $data['media']);

        if ($request->hasFile('image')) {
            $property = $request->route('property');

            if ($property instanceof Property && $property->image && ! $property->media()->where('path', $property->image)->exists()) {
                Storage::disk('public')->delete($property->image);
            }

            $data['image'] = $request->file('image')->store('properties', 'public');
        }

        $data['phone'] = $data['phone'] ?? Setting::get('default_phone', '');

        if ($request->isMethod('post')) {
            $data['is_active'] = $request->boolean('is_active', true);
        }

        return $data;
    }

    private function sectionIds(Request $request): ?array
    {
        if (! $request->has('section_ids') && ! $request->boolean('sections_present')) {
            return null;
        }

        return array_values(array_map('intval', (array) $request->input('section_ids', [])));
    }

    private function mediaFiles(Request $request): array
    {
        $files = $request->file('media', []);

        return is_array($files) ? $files : [$files];
    }
}
