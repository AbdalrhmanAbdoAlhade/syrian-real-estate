<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\PropertyMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PropertyMedia>
 */
class PropertyMediaFactory extends Factory
{
    protected $model = PropertyMedia::class;

    public function definition(): array
    {
        return [
            'property_id' => Property::factory(),
            'type' => 'image',
            'path' => 'properties/media/'.fake()->uuid().'.jpg',
            'disk' => 'public',
            'mime_type' => 'image/jpeg',
            'size' => fake()->numberBetween(10000, 500000),
            'sort_order' => 0,
            'is_cover' => false,
        ];
    }

    public function image(): static
    {
        return $this->state(fn () => [
            'type' => 'image',
            'mime_type' => 'image/jpeg',
        ]);
    }

    public function video(): static
    {
        return $this->state(fn () => [
            'type' => 'video',
            'path' => 'properties/media/'.fake()->uuid().'.mp4',
            'mime_type' => 'video/mp4',
        ]);
    }

    public function cover(): static
    {
        return $this->state(fn () => [
            'type' => 'image',
            'is_cover' => true,
        ]);
    }
}
