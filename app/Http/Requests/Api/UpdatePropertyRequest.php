<?php

namespace App\Http\Requests\Api;

use App\Rules\ProductMediaFile;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $maxMedia = (int) config('media.images.max_count', 10) + (int) config('media.videos.max_count', 3);

        return [
            'title' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:100',
            'district' => 'nullable|string|max:100',
            'purpose' => 'sometimes|in:بيع,إيجار',
            'price_usd' => 'sometimes|numeric|min:0',
            'area' => 'sometimes|integer|min:1',
            'rooms' => 'sometimes|integer|min:1|max:20',
            'bathrooms' => 'sometimes|integer|min:1|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:5120',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:30',
            'is_active' => 'boolean',
            'section_ids' => 'nullable|array',
            'section_ids.*' => 'integer|distinct|exists:sections,id',
            'sections_present' => 'nullable|boolean',
            'media' => "nullable|array|max:{$maxMedia}",
            'media.*' => ['file', new ProductMediaFile],
        ];
    }
}
