<?php

namespace App\Services;

use App\Models\Property;
use App\Models\PropertyMedia;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PropertyMediaService
{
    public function upload(Property $property, array $files): array
    {
        return DB::transaction(function () use ($property, $files) {
            $files = array_values(array_filter($files, fn ($file) => $file instanceof UploadedFile));

            if ($files === []) {
                return [];
            }

            $incoming = ['image' => 0, 'video' => 0];
            $prepared = [];

            foreach ($files as $file) {
                $type = $this->typeFor($file);
                $this->assertFileSizeWithinLimit($file, $type);
                $prepared[] = [$file, $type];
                $incoming[$type]++;
            }

            $this->assertCountsWithinLimit($property, $incoming);

            $nextSortOrder = ((int) $property->media()->max('sort_order')) + 1;
            $created = [];
            $storedPaths = [];
            $disk = config('media.disk', 'public');

            try {
                foreach ($prepared as [$file, $type]) {
                    $path = $file->store(config('media.directory', 'properties/media'), $disk);

                    if (! $path) {
                        throw ValidationException::withMessages([
                            'media' => 'تعذر حفظ أحد الملفات على التخزين.',
                        ]);
                    }

                    $storedPaths[] = $path;

                    $created[] = $property->media()->create([
                        'type' => $type,
                        'path' => $path,
                        'disk' => $disk,
                        'mime_type' => $file->getMimeType() ?: $file->getClientMimeType(),
                        'size' => $file->getSize(),
                        'sort_order' => $nextSortOrder++,
                        'is_cover' => false,
                    ]);
                }
            } catch (\Throwable $exception) {
                foreach ($storedPaths as $path) {
                    Storage::disk($disk)->delete($path);
                }

                throw $exception;
            }

            $this->ensureCover($property);

            return $created;
        });
    }

    public function attachStoredPath(Property $property, string $path, string $disk = 'public', bool $makeCover = false): PropertyMedia
    {
        return DB::transaction(function () use ($property, $path, $disk, $makeCover) {
            $media = $property->media()->firstOrCreate(
                ['path' => $path],
                [
                    'type' => 'image',
                    'disk' => $disk,
                    'mime_type' => $this->mimeTypeFor($path),
                    'size' => null,
                    'sort_order' => ((int) $property->media()->max('sort_order')) + 1,
                    'is_cover' => false,
                ]
            );

            if ($makeCover && $media->type === 'image') {
                return $this->setCover($property, $media);
            }

            $this->ensureCover($property);

            return $media->fresh();
        });
    }

    public function setCover(Property $property, PropertyMedia $media): PropertyMedia
    {
        return DB::transaction(function () use ($property, $media) {
            $this->assertBelongsToProperty($property, $media);

            if ($media->type !== 'image') {
                throw ValidationException::withMessages([
                    'media' => 'لا يمكن تعيين فيديو كصورة غلاف. الغلاف يجب أن يكون صورة.',
                ]);
            }

            $property->media()
                ->where('id', '<>', $media->id)
                ->where('is_cover', true)
                ->update(['is_cover' => false]);

            $media->forceFill(['is_cover' => true])->save();

            $property->forceFill(['image' => $media->path])->saveQuietly();

            return $media->fresh();
        });
    }

    public function delete(Property $property, PropertyMedia $media): void
    {
        DB::transaction(function () use ($property, $media) {
            $this->assertBelongsToProperty($property, $media);

            $wasCover = $media->is_cover;

            $media->delete();

            if ($wasCover) {
                $next = $property->images()->orderBy('sort_order')->orderBy('id')->first();

                if ($next) {
                    $this->setCover($property, $next);
                } else {
                    $property->forceFill(['image' => null])->saveQuietly();
                }
            }
        });
    }

    public function reorder(Property $property, array $mediaIds): void
    {
        DB::transaction(function () use ($property, $mediaIds) {
            $media = $property->media()->get()->keyBy('id');
            $orderedIds = [];

            foreach ($mediaIds as $id) {
                $id = (int) $id;

                if (! $media->has($id)) {
                    throw ValidationException::withMessages([
                        'order' => 'ترتيب الوسائط يحتوي على عنصر لا يخص هذا العقار.',
                    ]);
                }

                if (! in_array($id, $orderedIds, true)) {
                    $orderedIds[] = $id;
                }
            }

            foreach ($media->keys() as $id) {
                if (! in_array((int) $id, $orderedIds, true)) {
                    $orderedIds[] = (int) $id;
                }
            }

            foreach ($orderedIds as $index => $id) {
                PropertyMedia::where('id', $id)->update(['sort_order' => $index]);
            }
        });
    }

    public function ensureCover(Property $property): ?PropertyMedia
    {
        return DB::transaction(function () use ($property) {
            $cover = $property->cover()->lockForUpdate()->first();

            if ($cover) {
                if ($property->image !== $cover->path) {
                    $property->forceFill(['image' => $cover->path])->saveQuietly();
                }

                return $cover;
            }

            $firstImage = $property->images()->lockForUpdate()->first();

            if (! $firstImage) {
                return null;
            }

            $property->media()
                ->where('is_cover', true)
                ->update(['is_cover' => false]);

            $firstImage->forceFill(['is_cover' => true])->save();
            $property->forceFill(['image' => $firstImage->path])->saveQuietly();

            return $firstImage->fresh();
        });
    }

    private function assertCountsWithinLimit(Property $property, array $incoming): void
    {
        $limits = [
            'image' => (int) config('media.images.max_count', 10),
            'video' => (int) config('media.videos.max_count', 3),
        ];

        foreach ($limits as $type => $limit) {
            $existing = $property->media()->where('type', $type)->count();

            if ($incoming[$type] > 0 && $existing + $incoming[$type] > $limit) {
                throw ValidationException::withMessages([
                    'media' => $type === 'image'
                        ? "لا يمكن أن يحتوي العقار على أكثر من {$limit} صور."
                        : "لا يمكن أن يحتوي العقار على أكثر من {$limit} فيديوهات.",
                ]);
            }
        }
    }

    private function assertFileSizeWithinLimit(UploadedFile $file, string $type): void
    {
        $maxKb = $type === 'video'
            ? (int) config('media.videos.max_size_kb', 51200)
            : (int) config('media.images.max_size_kb', 5120);

        if ($file->getSize() > $maxKb * 1024) {
            throw ValidationException::withMessages([
                'media' => $type === 'video'
                    ? "حجم الفيديو يجب ألا يتجاوز {$maxKb} كيلوبايت."
                    : "حجم الصورة يجب ألا يتجاوز {$maxKb} كيلوبايت.",
            ]);
        }
    }

    private function typeFor(UploadedFile $file): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $mime = (string) ($file->getMimeType() ?: $file->getClientMimeType());

        if (in_array($extension, config('media.videos.mimes', ['mp4', 'webm', 'mov']), true) || Str::startsWith($mime, 'video/')) {
            return 'video';
        }

        if (in_array($extension, config('media.images.mimes', ['jpg', 'jpeg', 'png', 'webp']), true) || Str::startsWith($mime, 'image/')) {
            return 'image';
        }

        throw ValidationException::withMessages([
            'media' => 'نوع الملف غير مدعوم. الصور: jpg, jpeg, png, webp, avif. الفيديو: mp4, webm, mov.',
        ]);
    }

    private function mimeTypeFor(string $path): ?string
    {
        $extension = strtolower(pathinfo(parse_url($path, PHP_URL_PATH) ?: $path, PATHINFO_EXTENSION));

        return match ($extension) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'webp' => 'image/webp',
            'avif' => 'image/avif',
            'gif' => 'image/gif',
            'mp4' => 'video/mp4',
            'webm' => 'video/webm',
            'mov' => 'video/quicktime',
            default => null,
        };
    }

    private function assertBelongsToProperty(Property $property, PropertyMedia $media): void
    {
        if ((int) $media->property_id !== (int) $property->id) {
            abort(404);
        }
    }
}
