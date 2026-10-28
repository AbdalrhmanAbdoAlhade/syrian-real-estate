<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property\StorePropertyRequest;
use App\Http\Requests\Property\UpdatePropertyRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use App\Models\Section;
use App\Models\Setting;
use App\Services\PropertyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function __construct(private PropertyService $properties) {}

    public function index(Request $request)
    {
        $query = Property::with(['media', 'images', 'videos', 'cover', 'sections'])->latest();

        if ($request->filled('section_id')) {
            $query->inSection($request->integer('section_id'));
        }

        $properties = $query->paginate(15)->withQueryString();
        $sections = Section::orderBy('name_ar')->get();

        return view('admin.properties.index', compact('properties', 'sections'));
    }

    public function create()
    {
        $defaultPhone = Setting::get('default_phone', '');
        $sections = Section::orderBy('name_ar')->get();

        return view('admin.properties.create', compact('defaultPhone', 'sections'));
    }

    public function store(StorePropertyRequest $request)
    {
        $data = $this->propertyData($request);
        $property = $this->properties->create(
            $data,
            $this->sectionIds($request) ?? [],
            $this->mediaFiles($request)
        );

        $message = 'تم إضافة العقار بنجاح.';

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
                'redirect' => route('admin.properties.index'),
                'property' => (new PropertyResource($property))->resolve(),
            ], 201);
        }

        return redirect()->route('admin.properties.index')->with('success', $message);
    }

    public function edit(Property $property)
    {
        $property->load(['media', 'images', 'videos', 'cover', 'sections']);
        $defaultPhone = $property->phone;
        $sections = Section::orderBy('name_ar')->get();

        return view('admin.properties.edit', compact('property', 'defaultPhone', 'sections'));
    }

    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $data = $this->propertyData($request);
        $data['is_active'] = $request->boolean('is_active');

        $property = $this->properties->update(
            $property,
            $data,
            $this->sectionIds($request),
            $this->mediaFiles($request)
        );

        $message = 'تم تحديث العقار بنجاح.';

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
                'redirect' => route('admin.properties.index'),
                'property' => (new PropertyResource($property))->resolve(),
            ]);
        }

        return redirect()->route('admin.properties.index')->with('success', $message);
    }

    public function destroy(Request $request, Property $property)
    {
        $this->properties->delete($property);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'تم حذف العقار.']);
        }

        return redirect()->route('admin.properties.index')->with('success', 'تم حذف العقار.');
    }

    private function propertyData(Request $request): array
    {
        $data = $request->validated();
        unset($data['section_ids'], $data['sections_present'], $data['media']);

        if ($request->hasFile('image')) {
            $oldImage = $request->route('property')?->image;

            if ($oldImage && ! $request->route('property')->media()->where('path', $oldImage)->exists()) {
                Storage::disk('public')->delete($oldImage);
            }

            $data['image'] = $request->file('image')->store('properties', 'public');
        }

        $data['phone'] = $data['phone'] ?? Setting::get('default_phone', '');
        $data['is_active'] = $request->boolean('is_active');

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
