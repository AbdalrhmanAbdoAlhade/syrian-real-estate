<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en'];

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'property_section');
    }

    public function getLocalizedNameAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }

    public function getNameAttribute(): string
    {
        return $this->localized_name;
    }
}
