<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReorderPropertyMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order' => 'required|array',
            'order.*' => 'integer|distinct|exists:property_media,id',
        ];
    }
}
