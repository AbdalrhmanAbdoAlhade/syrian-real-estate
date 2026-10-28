<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class PropertyService
{
    public function __construct(private PropertyMediaService $mediaService) {}

    public function create(array $data, ?array $sectionIds = null, array $mediaFiles = []): Property
    {
        return DB::transaction(function () use ($data, $sectionIds, $mediaFiles) {
            $property = Property::create($data);

            if ($sectionIds !== null) {
                $property->sections()->sync($sectionIds);
            }

            if (is_string($property->image) && $property->image !== '') {
                $this->mediaService->attachStoredPath($property, $property->image, 'public', true);
            }

            $this->uploadMedia($property, $mediaFiles);

            return $this->loadProductRelations($property);
        });
    }

    public function update(Property $property, array $data, ?array $sectionIds = null, array $mediaFiles = []): Property
    {
        return DB::transaction(function () use ($property, $data, $sectionIds, $mediaFiles) {
            $property->update($data);

            if ($sectionIds !== null) {
                $property->sections()->sync($sectionIds);
            }

            if (is_string($property->image) && $property->image !== '') {
                $this->mediaService->attachStoredPath($property, $property->image, 'public', true);
            }

            $this->uploadMedia($property, $mediaFiles);

            return $this->loadProductRelations($property);
        });
    }

    public function delete(Property $property): void
    {
        DB::transaction(fn () => $property->delete());
    }

    private function uploadMedia(Property $property, array $mediaFiles): void
    {
        $files = array_values(array_filter($mediaFiles, fn ($file) => $file instanceof UploadedFile));

        if ($files !== []) {
            $this->mediaService->upload($property, $files);
        }
    }

    private function loadProductRelations(Property $property): Property
    {
        return $property->fresh()->load(['media', 'images', 'videos', 'cover', 'sections']);
    }
}
