<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Section>
 */
class SectionFactory extends Factory
{
    protected $model = Section::class;

    public function definition(): array
    {
        return [
            'name_ar' => fake()->unique()->words(2, true),
            'name_en' => fake()->unique()->words(2, true),
        ];
    }
}
