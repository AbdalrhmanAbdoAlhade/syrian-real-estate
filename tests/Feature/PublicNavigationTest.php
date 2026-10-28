<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicNavigationTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_contains_the_tourism_and_contact_targets(): void
    {
        $response = $this->get(route('home'))->assertOk();

        $html = $response->getContent();

        $this->assertSame(1, substr_count($html, 'id="tourism"'));
        $this->assertSame(1, substr_count($html, 'id="contact"'));
        $this->assertStringContainsString('html{scroll-behavior:smooth}', $html);
        $this->assertStringContainsString('#properties,#sections,#tourism,#contact{scroll-margin-top:6rem}', $html);
    }

    public function test_public_navigation_links_point_to_home_anchors_on_an_inner_page(): void
    {
        $property = Property::factory()->create(['is_active' => true]);

        $response = $this->get(route('property.show', $property))->assertOk();

        $response->assertSee('href="'.route('home').'#tourism"', false);
        $response->assertSee('href="'.route('home').'#contact"', false);
        $response->assertSee('href="'.route('home').'#properties"', false);
        $response->assertSee('id="mobileNav"', false);
        $response->assertSee('id="mobileNavBtn"', false);
    }
}
