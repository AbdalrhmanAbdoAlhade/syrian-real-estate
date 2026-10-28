<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SocialLink extends Model
{
    use HasFactory;

    public const FOOTER_CACHE_KEY = 'social_links.footer';

    public const PLATFORMS = [
        'facebook',
        'instagram',
        'x',
        'youtube',
        'tiktok',
        'whatsapp',
        'telegram',
        'linkedin',
        'snapchat',
        'website',
        'other',
    ];

    protected $fillable = [
        'platform',
        'label_ar',
        'label_en',
        'url',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function getLabelAttribute(): string
    {
        $label = app()->getLocale() === 'ar'
            ? ($this->label_ar ?: $this->label_en)
            : ($this->label_en ?: $this->label_ar);

        return $label ?: Str::headline($this->platform);
    }

    public static function cachedFooterLinks(): array
    {
        return Cache::rememberForever(self::FOOTER_CACHE_KEY, function (): array {
            return static::query()
                ->active()
                ->get(['platform', 'label_ar', 'label_en', 'url'])
                ->filter(fn (self $link): bool => preg_match('#^https?://#i', $link->url) === 1)
                ->map(fn (self $link): array => [
                    'platform' => $link->platform,
                    'label_ar' => $link->label_ar,
                    'label_en' => $link->label_en,
                    'url' => $link->url,
                ])
                ->values()
                ->all();
        });
    }

    public static function clearFooterCache(): void
    {
        Cache::forget(self::FOOTER_CACHE_KEY);
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::clearFooterCache());
        static::deleted(fn () => static::clearFooterCache());
    }
}
