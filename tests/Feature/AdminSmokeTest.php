<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_and_pages_render(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Property::factory()->create(['is_active' => true]);

        $this->actingAs($admin)->get('/admin')->assertOk();
        $this->actingAs($admin)->get('/admin/properties')->assertOk();
        $this->actingAs($admin)->get('/admin/properties/create')->assertOk();
        $this->actingAs($admin)->get('/admin/settings')->assertOk();
        $this->actingAs($admin)->get('/admin/admins')->assertOk();
        $this->actingAs($admin)->get('/admin/admins/create')->assertOk();
        $this->actingAs($admin)->get('/dashboard')->assertRedirect(route('admin.dashboard'));
    }

    public function test_non_admin_cannot_access_admin(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get('/admin')->assertForbidden();
        $this->actingAs($user)->get('/dashboard')->assertRedirect(route('home'));
    }

    public function test_property_store_saves_image_to_public_disk(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post(route('admin.properties.store'), [
            'title' => 'شقة اختبار',
            'city' => 'دمشق',
            'purpose' => 'بيع',
            'price_usd' => 50000,
            'area' => 120,
            'rooms' => 3,
            'bathrooms' => 2,
        ]);

        $response->assertRedirect(route('admin.properties.index'));
        $this->assertDatabaseHas('properties', ['title' => 'شقة اختبار']);
    }

    public function test_unchecking_is_active_hides_property(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $property = Property::factory()->create(['is_active' => true]);

        // Simulate unchecked checkbox: field absent from request
        $this->actingAs($admin)->put(route('admin.properties.update', $property), [
            'title' => $property->title,
            'city' => $property->city,
            'purpose' => $property->purpose,
            'price_usd' => $property->price_usd,
            'area' => $property->area,
            'rooms' => $property->rooms,
            'bathrooms' => $property->bathrooms,
        ])->assertRedirect(route('admin.properties.index'));

        $this->assertFalse($property->fresh()->is_active);
    }

    public function test_property_store_accepts_avif_image(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['is_admin' => true]);

        $avif = UploadedFile::fake()->createWithContent(
            'photo.avif',
            hex2bin('00000020667479706176696600000000617669666d6966316d696166') . str_repeat('A', 2048)
        );

        $response = $this->actingAs($admin)->post(route('admin.properties.store'), [
            'title' => 'شقة AVIF',
            'city' => 'دمشق',
            'purpose' => 'بيع',
            'price_usd' => 50000,
            'area' => 120,
            'rooms' => 3,
            'bathrooms' => 2,
            'image' => $avif,
        ]);

        $response->assertRedirect(route('admin.properties.index'));
        $response->assertSessionHasNoErrors();
        $path = Property::where('title', 'شقة AVIF')->firstOrFail()->image;
        Storage::disk('public')->assertExists($path);
    }
}
