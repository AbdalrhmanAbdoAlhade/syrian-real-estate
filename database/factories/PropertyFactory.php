<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'city' => fake()->randomElement(['دمشق', 'حلب', 'اللاذقية', 'حمص']),
            'district' => fake()->word(),
            'purpose' => fake()->randomElement(['بيع', 'إيجار']),
            'price_usd' => fake()->numberBetween(10000, 200000),
            'area' => fake()->numberBetween(50, 300),
            'rooms' => fake()->numberBetween(1, 6),
            'bathrooms' => fake()->numberBetween(1, 3),
            'description' => fake()->paragraph(),
            'phone' => '+963900000000',
            'is_active' => true,
        ];
    }
}
