<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

class ProductMediaFile implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $value instanceof UploadedFile) {
            $fail('الملف المرفوع غير صالح.');

            return;
        }

        $extension = strtolower($value->getClientOriginalExtension());
        $mime = strtolower((string) ($value->getMimeType() ?: $value->getClientMimeType()));

        $imageMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/avif'];
        $videoMimes = ['video/mp4', 'video/webm', 'video/quicktime'];

        $isVideo = in_array($extension, config('media.videos.mimes', ['mp4', 'webm', 'mov']), true)
            && in_array($mime, $videoMimes, true);

        $isImage = in_array($extension, config('media.images.mimes', ['jpg', 'jpeg', 'png', 'webp', 'avif']), true)
            && in_array($mime, $imageMimes, true);

        if (! $isImage && ! $isVideo) {
            $fail('نوع الملف غير مدعوم. الصور المسموحة: jpg, jpeg, png, webp, avif. الفيديو: mp4, webm, mov.');

            return;
        }

        $maxKb = $isVideo
            ? (int) config('media.videos.max_size_kb', 51200)
            : (int) config('media.images.max_size_kb', 5120);

        if ((int) $value->getSize() > $maxKb * 1024) {
            $fail($isVideo
                ? "حجم الفيديو يجب ألا يتجاوز {$maxKb} كيلوبايت."
                : "حجم الصورة يجب ألا يتجاوز {$maxKb} كيلوبايت.");
        }
    }
}
