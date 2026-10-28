<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'city' => $this->city,
            'district' => $this->district,
            'purpose' => $this->purpose,
            'price_usd' => (float) $this->price_usd,
            'area' => $this->area,
            'rooms' => $this->rooms,
            'bathrooms' => $this->bathrooms,
            'image' => $this->image_url,
            'image_url' => $this->image_url,
            'cover_url' => $this->cover_url,
            'description' => $this->description,
            'phone' => $this->phone,
            'whatsapp_link' => $this->whatsapp_link,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
            'cover' => $this->whenLoaded('cover', fn () => $this->cover ? new PropertyMediaResource($this->cover) : null),
            'media' => PropertyMediaResource::collection($this->whenLoaded('media')),
            'images' => PropertyMediaResource::collection($this->whenLoaded('images')),
            'videos' => PropertyMediaResource::collection($this->whenLoaded('videos')),
            'sections' => SectionResource::collection($this->whenLoaded('sections')),
        ];
    }
}
