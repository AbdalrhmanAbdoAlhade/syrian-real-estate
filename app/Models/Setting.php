<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];
    public static function get(string $key, mixed $default = null): mixed {
        return Cache::rememberForever('setting_' . $key, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }
    public static function set(string $key, mixed $value): void {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('setting_' . $key);
    }
    public static function getLogoUrl(): string {
        $logo = static::get('logo');
        if ($logo && Storage::disk('public')->exists($logo)) return asset('storage/' . $logo);
        return '';
    }
    public static function getFaviconUrl(): string {
        $icon = static::get('favicon');
        if ($icon && Storage::disk('public')->exists($icon)) return asset('storage/' . $icon);
        return '';
    }
}
