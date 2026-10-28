<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_section_pages(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $section = Section::factory()->create(['name_ar' => 'شقق', 'name_en' => 'Apartments']);

        $this->actingAs($admin)->get(route('admin.sections.index'))->assertOk()->assertSee('شقق');
        $this->actingAs($admin)->get(route('admin.sections.create'))->assertOk();
        $this->actingAs($admin)->get(route('admin.sections.edit', $section))->assertOk();
    }

    public function test_admin_can_create_update_and_delete_sections_without_deleting_products(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->post(route('admin.sections.store'), ['name_ar' => 'شقق', 'name_en' => 'Apartments'])
            ->assertRedirect(route('admin.sections.index'));

        $section = Section::firstOrFail();
        $property = Property::factory()->create();
        $property->sections()->attach($section);

        $this->actingAs($admin)
            ->put(route('admin.sections.update', $section), ['name_ar' => 'شقق فاخرة', 'name_en' => 'Luxury Apartments'])
            ->assertRedirect(route('admin.sections.index'));

        $this->assertDatabaseHas('sections', [
            'id' => $section->id,
            'name_ar' => 'شقق فاخرة',
            'name_en' => 'Luxury Apartments',
        ]);

        $this->actingAs($admin)
            ->delete(route('admin.sections.destroy', $section))
            ->assertRedirect(route('admin.sections.index'));

        $this->assertDatabaseMissing('sections', ['id' => $section->id]);
        $this->assertDatabaseHas('properties', ['id' => $property->id]);
        $this->assertDatabaseMissing('property_section', ['section_id' => $section->id]);
    }

    public function test_section_names_are_required(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->post(route('admin.sections.store'), [])
            ->assertSessionHasErrors(['name_ar', 'name_en']);

        $this->assertDatabaseCount('sections', 0);
    }

    public function test_non_admin_cannot_manage_sections(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get(route('admin.sections.index'))->assertForbidden();
        $this->actingAs($user)->post(route('admin.sections.store'), [
            'name_ar' => 'شقق',
            'name_en' => 'Apartments',
        ])->assertForbidden();
    }

    public function test_api_sections_are_localized(): void
    {
        $section = Section::factory()->create(['name_ar' => 'شقق', 'name_en' => 'Apartments']);

        app()->setLocale('ar');
        $this->getJson('/api/sections')
            ->assertOk()
            ->assertJsonPath('data.0.name', 'شقق')
            ->assertJsonPath('data.0.name_ar', 'شقق')
            ->assertJsonPath('data.0.name_en', 'Apartments');

        app()->setLocale('en');
        $this->getJson('/api/sections/'.$section->id)
            ->assertOk()
            ->assertJsonPath('name', 'Apartments');
    }

    public function test_product_create_and_update_sync_sections(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $first = Section::factory()->create(['name_ar' => 'شقق', 'name_en' => 'Apartments']);
        $second = Section::factory()->create(['name_ar' => 'فلل', 'name_en' => 'Villas']);

        $this->actingAs($admin)->post(route('admin.properties.store'), [
            'title' => 'عقار مع أقسام',
            'city' => 'دمشق',
            'purpose' => 'بيع',
            'price_usd' => 100000,
            'area' => 120,
            'rooms' => 3,
            'bathrooms' => 2,
            'section_ids' => [$first->id, $second->id],
            'sections_present' => 1,
        ])->assertRedirect(route('admin.properties.index'));

        $property = Property::where('title', 'عقار مع أقسام')->firstOrFail();
        $this->assertDatabaseHas('property_section', ['property_id' => $property->id, 'section_id' => $first->id]);
        $this->assertDatabaseHas('property_section', ['property_id' => $property->id, 'section_id' => $second->id]);

        $this->actingAs($admin)->put(route('admin.properties.update', $property), [
            'title' => $property->title,
            'city' => $property->city,
            'purpose' => $property->purpose,
            'price_usd' => $property->price_usd,
            'area' => $property->area,
            'rooms' => $property->rooms,
            'bathrooms' => $property->bathrooms,
            'section_ids' => [$second->id],
            'sections_present' => 1,
        ])->assertRedirect(route('admin.properties.index'));

        $this->assertDatabaseMissing('property_section', ['property_id' => $property->id, 'section_id' => $first->id]);
        $this->assertDatabaseHas('property_section', ['property_id' => $property->id, 'section_id' => $second->id]);
    }

    public function test_product_without_sections_still_works(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)->post(route('admin.properties.store'), [
            'title' => 'عقار بدون أقسام',
            'city' => 'دمشق',
            'purpose' => 'بيع',
            'price_usd' => 50000,
            'area' => 80,
            'rooms' => 2,
            'bathrooms' => 1,
            'is_active' => 1,
        ])->assertRedirect(route('admin.properties.index'));

        $property = Property::where('title', 'عقار بدون أقسام')->firstOrFail();
        $this->assertDatabaseMissing('property_section', ['property_id' => $property->id]);

        $this->getJson('/api/properties/'.$property->id)
            ->assertOk()
            ->assertJsonPath('sections', []);
    }

    public function test_api_products_can_be_filtered_by_one_or_many_sections(): void
    {
        $first = Section::factory()->create(['name_ar' => 'شقق', 'name_en' => 'Apartments']);
        $second = Section::factory()->create(['name_ar' => 'فلل', 'name_en' => 'Villas']);

        $firstProperty = Property::factory()->create(['is_active' => true]);
        $secondProperty = Property::factory()->create(['is_active' => true]);
        $withoutSection = Property::factory()->create(['is_active' => true]);

        $firstProperty->sections()->attach($first);
        $secondProperty->sections()->attach($second);

        $this->getJson('/api/properties?section_id='.$first->id)
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $firstProperty->id);

        $this->getJson('/api/properties?section_ids[]='.$first->id.'&section_ids[]='.$second->id)
            ->assertOk()
            ->assertJsonCount(2, 'data');

        $this->getJson('/api/properties/'.$withoutSection->id)
            ->assertOk()
            ->assertJsonPath('sections', []);
    }
}
