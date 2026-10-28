<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyMediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'url' => $this->url,
            'path' => $this->path,
            'disk' => $this->disk,
            'mime_type' => $this->mime_type,
            'size' => $this->size,
            'sort_order' => $this->sort_order,
            'is_cover' => $this->is_cover,
        ];
    }
}
