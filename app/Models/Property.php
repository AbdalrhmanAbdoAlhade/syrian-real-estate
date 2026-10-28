<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'city', 'district', 'purpose', 'price_usd', 'area', 'rooms', 'bathrooms',
        'image', 'description', 'phone', 'is_active',
    ];

    protected function casts(): array
    {
        return ['price_usd' => 'decimal:2', 'is_active' => 'boolean'];
    }

    public function media(): HasMany
    {
        return $this->hasMany(PropertyMedia::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PropertyMedia::class)
            ->where('type', 'image')
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function videos(): HasMany
    {
        return $this->hasMany(PropertyMedia::class)
            ->where('type', 'video')
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function cover(): HasOne
    {
        return $this->hasOne(PropertyMedia::class)
            ->where('type', 'image')
            ->where('is_cover', true);
    }

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class, 'property_section');
    }

    public function scopeInSection($query, int|array|string|null $sectionIds)
    {
        $ids = array_values(array_filter((array) $sectionIds, fn ($id) => $id !== null && $id !== ''));

        return $query->when($ids !== [], function ($query) use ($ids) {
            $query->whereHas('sections', fn ($sections) => $sections->whereIn('sections.id', $ids));
        });
    }

    public function getCoverUrlAttribute(): string
    {
        $cover = $this->relationLoaded('cover')
            ? $this->getRelation('cover')
            : $this->cover()->first();

        if ($cover) {
            return $cover->url;
        }

        $firstImage = $this->relationLoaded('images')
            ? $this->getRelation('images')->first()
            : $this->images()->first();

        if ($firstImage) {
            return $firstImage->url;
        }

        if ($this->image && ! Str::startsWith($this->image, ['http://', 'https://', '//'])) {
            if (Storage::disk('public')->exists($this->image)) {
                return asset('storage/'.ltrim($this->image, '/'));
            }
        } elseif ($this->image) {
            return $this->image;
        }

        return (string) config('media.placeholder');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->cover_url;
    }

    public function getWhatsappLinkAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->phone ?? '');

        return 'https://wa.me/'.$phone;
    }

    protected static function booted(): void
    {
        static::deleting(function (Property $property) {
            $media = $property->media()->get();
            $paths = $media->pluck('path')->all();

            $media->each->delete();

            if ($property->image && ! in_array($property->image, $paths, true)) {
                Storage::disk('public')->delete($property->image);
            }
        });
    }
}
