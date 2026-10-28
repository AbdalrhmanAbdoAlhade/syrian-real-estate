<?php

namespace App\Http\Requests\SocialLink;

use App\Models\SocialLink;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSocialLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'platform' => ['required', 'string', Rule::in(SocialLink::PLATFORMS)],
            'label_ar' => 'nullable|string|max:255',
            'label_en' => 'nullable|string|max:255',
            'url' => ['required', 'string', 'max:2048', 'url:http,https', 'regex:/^https?:\/\//i'],
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
