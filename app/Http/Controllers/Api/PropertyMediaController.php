<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReorderPropertyMediaRequest;
use App\Http\Requests\UploadPropertyMediaRequest;
use App\Http\Resources\PropertyMediaResource;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use App\Models\PropertyMedia;
use App\Services\PropertyMediaService;

class PropertyMediaController extends Controller
{
    public function __construct(private PropertyMediaService $mediaService) {}

    public function store(UploadPropertyMediaRequest $request, Property $property)
    {
        $created = $this->mediaService->upload($property, $request->file('media', []));
        $property->load(['media', 'images', 'videos', 'cover', 'sections']);

        return response()->json([
            'message' => 'تم رفع الوسائط بنجاح.',
            'media' => PropertyMediaResource::collection($created),
            'property' => (new PropertyResource($property))->resolve(),
        ], 201);
    }

    public function destroy(Property $property, PropertyMedia $media)
    {
        $this->mediaService->delete($property, $media);

        return response()->json(['message' => 'تم حذف الوسيط.']);
    }

    public function cover(Property $property, PropertyMedia $media)
    {
        $media = $this->mediaService->setCover($property, $media);

        return response()->json([
            'message' => 'تم تعيين صورة الغلاف.',
            'media' => new PropertyMediaResource($media),
        ]);
    }

    public function reorder(ReorderPropertyMediaRequest $request, Property $property)
    {
        $this->mediaService->reorder($property, $request->input('order', []));

        return response()->json(['message' => 'تم تحديث ترتيب الوسائط.']);
    }
}
