<?php

namespace App\Http\Requests;

use App\Rules\ProductMediaFile;
use Illuminate\Foundation\Http\FormRequest;

class UploadPropertyMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $maxMedia = (int) config('media.images.max_count', 10) + (int) config('media.videos.max_count', 3);

        return [
            'media' => "required|array|min:1|max:{$maxMedia}",
            'media.*' => ['required', 'file', new ProductMediaFile],
        ];
    }
}
