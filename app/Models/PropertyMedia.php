<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertyMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id', 'type', 'path', 'disk', 'mime_type', 'size', 'sort_order', 'is_cover',
    ];

    protected function casts(): array
    {
        return [
            'size' => 'integer',
            'sort_order' => 'integer',
            'is_cover' => 'boolean',
        ];
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function getUrlAttribute(): string
    {
        $path = (string) $this->path;

        if ($path === '') {
            return (string) config('media.placeholder');
        }

        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            return $path;
        }

        if (Str::startsWith($path, '/')) {
            return asset(ltrim($path, '/'));
        }

        return Storage::disk($this->disk ?: config('media.disk', 'public'))->url($path);
    }

    public function getIsImageAttribute(): bool
    {
        return $this->type === 'image';
    }

    public function getIsVideoAttribute(): bool
    {
        return $this->type === 'video';
    }

    protected static function booted(): void
    {
        static::deleting(function (PropertyMedia $media) {
            $path = (string) $media->path;

            if ($path !== '' && ! Str::startsWith($path, ['http://', 'https://', '//', '/'])) {
                Storage::disk($media->disk ?: config('media.disk', 'public'))->delete($path);
            }
        });
    }
}
