<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReorderPropertyMediaRequest;
use App\Http\Requests\UploadPropertyMediaRequest;
use App\Http\Resources\PropertyMediaResource;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use App\Models\PropertyMedia;
use App\Services\PropertyMediaService;
use Illuminate\Http\Request;

class PropertyMediaController extends Controller
{
    public function __construct(private PropertyMediaService $mediaService) {}

    public function store(UploadPropertyMediaRequest $request, Property $property)
    {
        $created = $this->mediaService->upload($property, $request->file('media', []));

        if ($request->expectsJson()) {
            $property->load(['media', 'images', 'videos', 'cover', 'sections']);

            return response()->json([
                'message' => 'تم رفع الوسائط بنجاح.',
                'media' => PropertyMediaResource::collection($created),
                'property' => (new PropertyResource($property))->resolve(),
            ], 201);
        }

        return back()->with('success', 'تم رفع الوسائط بنجاح.');
    }

    public function destroy(Request $request, Property $property, PropertyMedia $media)
    {
        $this->mediaService->delete($property, $media);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'تم حذف الوسيط.']);
        }

        return back()->with('success', 'تم حذف الوسيط.');
    }

    public function cover(Request $request, Property $property, PropertyMedia $media)
    {
        $media = $this->mediaService->setCover($property, $media);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'تم تعيين صورة الغلاف.',
                'media' => new PropertyMediaResource($media),
            ]);
        }

        return back()->with('success', 'تم تعيين صورة الغلاف.');
    }

    public function reorder(ReorderPropertyMediaRequest $request, Property $property)
    {
        $this->mediaService->reorder($property, $request->input('order', []));

        if ($request->expectsJson()) {
            return response()->json(['message' => 'تم تحديث ترتيب الوسائط.']);
        }

        return back()->with('success', 'تم تحديث ترتيب الوسائط.');
    }
}
