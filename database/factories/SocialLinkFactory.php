<?php

namespace Database\Factories;

use App\Models\SocialLink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SocialLink>
 */
class SocialLinkFactory extends Factory
{
    protected $model = SocialLink::class;

    public function definition(): array
    {
        $platform = fake()->randomElement(SocialLink::PLATFORMS);

        return [
            'platform' => $platform,
            'label_ar' => 'رابط '.$platform,
            'label_en' => ucfirst($platform),
            'url' => 'https://example.com/'.$platform,
            'sort_order' => fake()->numberBetween(0, 20),
            'is_active' => true,
        ];
    }
}
