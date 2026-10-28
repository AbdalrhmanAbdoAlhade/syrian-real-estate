<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\PropertyMedia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PropertyMediaTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->admin = User::factory()->create(['is_admin' => true]);
    }

    public function test_product_store_accepts_multiple_media_and_first_image_becomes_cover(): void
    {
        $this->actingAs($this->admin)->post(route('admin.properties.store'), $this->propertyPayload([
            'media' => [
                UploadedFile::fake()->create('one.jpg', 100, 'image/jpeg'),
                UploadedFile::fake()->create('two.png', 100, 'image/png'),
                UploadedFile::fake()->create('clip.mp4', 1024, 'video/mp4'),
            ],
        ]))->assertRedirect(route('admin.properties.index'));

        $property = Property::where('title', 'عقار وسائط')->firstOrFail();
        $this->assertSame(3, $property->media()->count());

        $images = $property->images()->orderBy('sort_order')->get();
        $this->assertCount(2, $images);
        $this->assertTrue($images[0]->is_cover);
        $this->assertFalse($images[1]->is_cover);

        $video = $property->videos()->firstOrFail();
        $this->assertFalse($video->is_cover);

        $this->assertSame(1, $property->media()->where('is_cover', true)->count());
        $this->assertSame($images[0]->path, $property->fresh()->image);
        Storage::disk('public')->assertExists($images[0]->path);
        Storage::disk('public')->assertExists($video->path);
    }

    public function test_setting_a_new_cover_unsets_the_previous_cover(): void
    {
        $property = Property::factory()->create();
        $this->upload($property, [
            UploadedFile::fake()->create('first.jpg', 100, 'image/jpeg'),
            UploadedFile::fake()->create('second.jpg', 100, 'image/jpeg'),
        ]);

        $first = $property->images()->orderBy('sort_order')->firstOrFail();
        $second = $property->images()->orderBy('sort_order')->skip(1)->firstOrFail();
        $this->assertTrue($first->is_cover);

        $this->actingAs($this->admin)
            ->patch(route('admin.properties.media.cover', [$property, $second]))
            ->assertRedirect();

        $this->assertFalse($first->fresh()->is_cover);
        $this->assertTrue($second->fresh()->is_cover);
        $this->assertSame(1, $property->media()->where('is_cover', true)->count());
    }

    public function test_deleting_the_cover_promotes_the_next_image(): void
    {
        $property = Property::factory()->create();
        $this->upload($property, [
            UploadedFile::fake()->create('first.jpg', 100, 'image/jpeg'),
            UploadedFile::fake()->create('second.jpg', 100, 'image/jpeg'),
        ]);

        $first = $property->images()->orderBy('sort_order')->firstOrFail();
        $second = $property->images()->orderBy('sort_order')->skip(1)->firstOrFail();

        $this->actingAs($this->admin)
            ->delete(route('admin.properties.media.destroy', [$property, $first]))
            ->assertRedirect();

        $this->assertDatabaseMissing('property_media', ['id' => $first->id]);
        $this->assertTrue($second->fresh()->is_cover);
        $this->assertSame(1, $property->media()->where('is_cover', true)->count());
    }

    public function test_deleting_the_last_image_leaves_no_cover(): void
    {
        $property = Property::factory()->create();
        $this->upload($property, [UploadedFile::fake()->create('only.jpg', 100, 'image/jpeg')]);

        $image = $property->images()->firstOrFail();

        $this->actingAs($this->admin)
            ->delete(route('admin.properties.media.destroy', [$property, $image]))
            ->assertRedirect();

        $this->assertSame(0, $property->media()->count());
        $this->assertNull($property->fresh()->cover);
        $this->assertNull($property->fresh()->image);
    }

    public function test_video_cannot_be_set_as_cover(): void
    {
        $property = Property::factory()->create();
        $this->upload($property, [
            UploadedFile::fake()->create('photo.jpg', 100, 'image/jpeg'),
            UploadedFile::fake()->create('clip.mp4', 1024, 'video/mp4'),
        ]);

        $image = $property->images()->firstOrFail();
        $video = $property->videos()->firstOrFail();

        $this->actingAs($this->admin)
            ->from(route('admin.properties.edit', $property))
            ->patch(route('admin.properties.media.cover', [$property, $video]))
            ->assertRedirect(route('admin.properties.edit', $property))
            ->assertSessionHasErrors('media');

        $this->assertFalse($video->fresh()->is_cover);
        $this->assertTrue($image->fresh()->is_cover);
        $this->assertSame(1, $property->media()->where('is_cover', true)->count());
    }

    public function test_media_can_be_reordered(): void
    {
        $property = Property::factory()->create();
        $this->upload($property, [
            UploadedFile::fake()->create('a.jpg', 100, 'image/jpeg'),
            UploadedFile::fake()->create('b.jpg', 100, 'image/jpeg'),
            UploadedFile::fake()->create('c.jpg', 100, 'image/jpeg'),
        ]);

        $ids = $property->media()->orderByDesc('sort_order')->pluck('id')->all();

        $this->actingAs($this->admin)
            ->post(route('admin.properties.media.reorder', $property), ['order' => $ids])
            ->assertRedirect();

        foreach ($ids as $index => $id) {
            $this->assertSame($index, PropertyMedia::findOrFail($id)->sort_order);
        }
    }

    public function test_product_without_media_still_works(): void
    {
        $property = Property::factory()->create(['image' => null]);

        $this->actingAs($this->admin)
            ->get(route('admin.properties.edit', $property))
            ->assertOk();

        $this->getJson('/api/properties/'.$property->id)
            ->assertOk()
            ->assertJsonPath('media', [])
            ->assertJsonPath('images', [])
            ->assertJsonPath('videos', [])
            ->assertJsonPath('sections', []);

        $this->assertStringContainsString('placehold.co', $property->fresh()->cover_url);
    }

    public function test_media_deletion_removes_the_physical_file(): void
    {
        $property = Property::factory()->create();
        $this->upload($property, [UploadedFile::fake()->create('photo.jpg', 100, 'image/jpeg')]);

        $media = $property->media()->firstOrFail();
        Storage::disk('public')->assertExists($media->path);

        $this->actingAs($this->admin)
            ->delete(route('admin.properties.media.destroy', [$property, $media]))
            ->assertRedirect();

        Storage::disk('public')->assertMissing($media->path);
        $this->assertDatabaseMissing('property_media', ['id' => $media->id]);
    }

    public function test_deleting_a_product_deletes_its_media_files(): void
    {
        $property = Property::factory()->create();
        $this->upload($property, [
            UploadedFile::fake()->create('photo.jpg', 100, 'image/jpeg'),
            UploadedFile::fake()->create('clip.mp4', 1024, 'video/mp4'),
        ]);

        $paths = $property->media()->pluck('path')->all();
        $this->assertCount(2, $paths);

        $this->actingAs($this->admin)
            ->delete(route('admin.properties.destroy', $property))
            ->assertRedirect(route('admin.properties.index'));

        foreach ($paths as $path) {
            Storage::disk('public')->assertMissing($path);
        }

        $this->assertDatabaseMissing('properties', ['id' => $property->id]);
        $this->assertSame(0, PropertyMedia::where('property_id', $property->id)->count());
    }

    public function test_legacy_image_backfill_is_idempotent(): void
    {
        Storage::disk('public')->put('properties/legacy.jpg', 'legacy-file-content');

        $property = Property::factory()->create(['image' => 'properties/legacy.jpg']);
        DB::table('property_media')->delete();

        $migration = require database_path('migrations/2026_10_20_000004_backfill_property_media_from_properties_image.php');
        $migration->up();

        $migrationAgain = require database_path('migrations/2026_10_20_000004_backfill_property_media_from_properties_image.php');
        $migrationAgain->up();

        $this->assertSame(1, PropertyMedia::where('property_id', $property->id)->count());

        $media = PropertyMedia::where('property_id', $property->id)->firstOrFail();
        $this->assertSame('image', $media->type);
        $this->assertSame('properties/legacy.jpg', $media->path);
        $this->assertSame('public', $media->disk);
        $this->assertTrue($media->is_cover);
        $this->assertSame('properties/legacy.jpg', $property->fresh()->image);
        Storage::disk('public')->assertExists('properties/legacy.jpg');
    }

    public function test_non_admin_cannot_manage_media(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $property = Property::factory()->create();
        $media = PropertyMedia::factory()->create(['property_id' => $property->id, 'is_cover' => true]);

        $this->actingAs($user)->post(route('admin.properties.media.store', $property), [
            'media' => [UploadedFile::fake()->create('photo.jpg', 100, 'image/jpeg')],
        ])->assertForbidden();

        $this->actingAs($user)->delete(route('admin.properties.media.destroy', [$property, $media]))->assertForbidden();
    }

    public function test_api_media_endpoints_work_for_admins(): void
    {
        $property = Property::factory()->create();

        $this->actingAs($this->admin, 'sanctum')
            ->post('/api/properties/'.$property->id.'/media', [
                'media' => [UploadedFile::fake()->create('api-photo.jpg', 100, 'image/jpeg')],
            ], ['Accept' => 'application/json'])
            ->assertCreated()
            ->assertJsonCount(1, 'media');

        $media = $property->media()->firstOrFail();
        $this->assertTrue($media->is_cover);

        $this->actingAs($this->admin, 'sanctum')
            ->put('/api/properties/'.$property->id.'/media/'.$media->id.'/cover', [], ['Accept' => 'application/json'])
            ->assertOk();

        $this->actingAs($this->admin, 'sanctum')
            ->delete('/api/properties/'.$property->id.'/media/'.$media->id, [], ['Accept' => 'application/json'])
            ->assertOk();

        $this->assertDatabaseMissing('property_media', ['id' => $media->id]);
    }

    public function test_upload_rejects_unsupported_file_types(): void
    {
        $property = Property::factory()->create();

        $this->actingAs($this->admin)
            ->post(route('admin.properties.media.store', $property), [
                'media' => [UploadedFile::fake()->create('notes.txt', 10, 'text/plain')],
            ])
            ->assertSessionHasErrors('media.0');

        $this->assertSame(0, $property->media()->count());
    }

    public function test_upload_rejects_disallowed_mime_types(): void
    {
        $property = Property::factory()->create();

        $this->actingAs($this->admin)
            ->post(route('admin.properties.media.store', $property), [
                'media' => [
                    UploadedFile::fake()->create('vector.svg', 10, 'image/svg+xml'),
                    UploadedFile::fake()->create('clip.avi', 10, 'video/x-msvideo'),
                ],
            ])
            ->assertSessionHasErrors(['media.0', 'media.1']);

        $this->assertSame(0, $property->media()->count());
    }

    private function propertyPayload(array $overrides = []): array
    {
        return array_merge([
            'title' => 'عقار وسائط',
            'city' => 'دمشق',
            'purpose' => 'بيع',
            'price_usd' => 100000,
            'area' => 120,
            'rooms' => 3,
            'bathrooms' => 2,
        ], $overrides);
    }

    private function upload(Property $property, array $files): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.properties.media.store', $property), ['media' => $files])
            ->assertRedirect();
    }
}
