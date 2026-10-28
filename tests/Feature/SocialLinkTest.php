<?php

namespace Tests\Feature;

use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class SocialLinkTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['is_admin' => true]);
    }

    public function test_admin_can_create_update_toggle_and_delete_social_links(): void
    {
        $this->actingAs($this->admin)->get(route('admin.social-links.index'))->assertOk();
        $this->actingAs($this->admin)->get(route('admin.social-links.create'))->assertOk();

        $this->actingAs($this->admin)->post(route('admin.social-links.store'), [
            'platform' => 'facebook',
            'label_ar' => 'فيسبوك المنصة',
            'label_en' => 'Platform Facebook',
            'url' => 'https://example.com/facebook',
            'sort_order' => 3,
            'is_active' => 1,
        ])->assertRedirect(route('admin.social-links.index'));

        $link = SocialLink::firstOrFail();

        $this->assertDatabaseHas('social_links', [
            'id' => $link->id,
            'platform' => 'facebook',
            'url' => 'https://example.com/facebook',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        $this->actingAs($this->admin)->get(route('admin.social-links.edit', $link))
            ->assertOk()
            ->assertSee('فيسبوك المنصة');

        $this->actingAs($this->admin)->put(route('admin.social-links.update', $link), [
            'platform' => 'instagram',
            'label_ar' => 'إنستغرام المنصة',
            'label_en' => 'Platform Instagram',
            'url' => 'https://example.com/instagram',
            'sort_order' => 1,
            'is_active' => 1,
        ])->assertRedirect(route('admin.social-links.index'));

        $this->assertDatabaseHas('social_links', [
            'id' => $link->id,
            'platform' => 'instagram',
            'url' => 'https://example.com/instagram',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $this->actingAs($this->admin)->patch(route('admin.social-links.toggle', $link))
            ->assertRedirect(route('admin.social-links.index'));
        $this->assertFalse($link->fresh()->is_active);

        $this->actingAs($this->admin)->patch(route('admin.social-links.toggle', $link))
            ->assertRedirect(route('admin.social-links.index'));
        $this->assertTrue($link->fresh()->is_active);

        $this->actingAs($this->admin)->delete(route('admin.social-links.destroy', $link))
            ->assertRedirect(route('admin.social-links.index'));

        $this->assertDatabaseMissing('social_links', ['id' => $link->id]);
    }

    public function test_non_admin_cannot_manage_social_links(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get(route('admin.social-links.index'))->assertForbidden();
        $this->actingAs($user)->get(route('admin.social-links.create'))->assertForbidden();
        $this->actingAs($user)->post(route('admin.social-links.store'), [
            'platform' => 'facebook',
            'url' => 'https://example.com/facebook',
        ])->assertForbidden();
    }

    public function test_social_link_validation_rejects_bad_platform_and_urls(): void
    {
        $payload = [
            'platform' => 'facebook',
            'label_ar' => 'فيسبوك',
            'label_en' => 'Facebook',
            'url' => 'https://example.com/facebook',
            'sort_order' => 0,
            'is_active' => 1,
        ];

        foreach (['javascript:alert(1)', 'data:text/html,<script>alert(1)</script>', 'example.com'] as $url) {
            $this->actingAs($this->admin)
                ->from(route('admin.social-links.create'))
                ->post(route('admin.social-links.store'), array_merge($payload, ['url' => $url]))
                ->assertSessionHasErrors('url');
        }

        $this->actingAs($this->admin)
            ->from(route('admin.social-links.create'))
            ->post(route('admin.social-links.store'), array_merge($payload, ['platform' => 'myspace']))
            ->assertSessionHasErrors('platform');

        $this->assertDatabaseCount('social_links', 0);
    }

    public function test_footer_shows_only_active_links_in_order_and_is_hidden_when_empty(): void
    {
        app()->setLocale('ar');

        $this->get(route('home'))->assertOk()->assertDontSee('data-social-links', false);

        $first = SocialLink::factory()->create([
            'platform' => 'facebook',
            'label_ar' => 'رابط-أ-١',
            'label_en' => 'Link-A-1',
            'url' => 'https://example.com/first',
            'sort_order' => 20,
            'is_active' => true,
        ]);

        $second = SocialLink::factory()->create([
            'platform' => 'instagram',
            'label_ar' => 'رابط-ب-٢',
            'label_en' => 'Link-B-2',
            'url' => 'https://example.com/second',
            'sort_order' => 10,
            'is_active' => true,
        ]);

        SocialLink::factory()->create([
            'platform' => 'youtube',
            'label_ar' => 'رابط-مخفي-٣',
            'label_en' => 'Link-Hidden-3',
            'url' => 'https://example.com/hidden',
            'sort_order' => 1,
            'is_active' => false,
        ]);

        $response = $this->get(route('home'))->assertOk();

        $response->assertSee('data-social-links', false);
        $response->assertSeeInOrder(['رابط-ب-٢', 'رابط-أ-١']);
        $response->assertDontSee('رابط-مخفي-٣');
        $response->assertSee('href="https://example.com/second"', false);
        $response->assertSee('target="_blank"', false);
        $response->assertSee('rel="noopener noreferrer"', false);

        $this->assertTrue($second->is_active);
        $this->assertTrue($first->is_active);
    }

    public function test_footer_uses_the_current_locale_for_labels(): void
    {
        SocialLink::factory()->create([
            'platform' => 'facebook',
            'label_ar' => 'فيسبوك-عربي',
            'label_en' => 'Facebook-English',
            'url' => 'https://example.com/facebook',
            'is_active' => true,
        ]);

        app()->setLocale('ar');
        $this->get(route('home'))->assertOk()->assertSee('فيسبوك-عربي')->assertDontSee('Facebook-English');

        app()->setLocale('en');
        $this->get(route('home'))->assertOk()->assertSee('Facebook-English')->assertDontSee('فيسبوك-عربي');
    }

    public function test_footer_cache_is_invalidated_on_create_update_and_delete(): void
    {
        app()->setLocale('ar');

        $this->assertSame([], SocialLink::cachedFooterLinks());
        $this->assertTrue(Cache::has(SocialLink::FOOTER_CACHE_KEY));

        $link = SocialLink::factory()->create([
            'platform' => 'facebook',
            'label_ar' => 'قديم-فريد',
            'label_en' => 'Old',
            'url' => 'https://example.com/old',
            'is_active' => true,
        ]);

        $this->assertSame(1, count(SocialLink::cachedFooterLinks()));

        $this->get(route('home'))->assertOk()->assertSee('قديم-فريد');

        $link->update([
            'label_ar' => 'جديد-فريد',
            'label_en' => 'New',
            'url' => 'https://example.com/new',
        ]);

        $this->assertFalse(Cache::has(SocialLink::FOOTER_CACHE_KEY));
        $this->get(route('home'))->assertOk()->assertSee('جديد-فريد')->assertDontSee('قديم-فريد');

        $link->delete();

        $this->assertFalse(Cache::has(SocialLink::FOOTER_CACHE_KEY));
        $this->get(route('home'))->assertOk()->assertDontSee('data-social-links', false);
    }

    public function test_admin_can_move_social_links_up_and_down_and_cache_is_cleared(): void
    {
        $first = SocialLink::factory()->create([
            'platform' => 'facebook',
            'url' => 'https://example.com/first',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        $second = SocialLink::factory()->create([
            'platform' => 'instagram',
            'url' => 'https://example.com/second',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        $this->get(route('home'))->assertOk();
        $this->assertTrue(Cache::has(SocialLink::FOOTER_CACHE_KEY));

        $this->actingAs($this->admin)
            ->from(route('admin.social-links.index'))
            ->post(route('admin.social-links.move', ['socialLink' => $first, 'direction' => 'down']))
            ->assertRedirect(route('admin.social-links.index'));

        $this->assertSame(2, $first->fresh()->sort_order);
        $this->assertSame(1, $second->fresh()->sort_order);
        $this->assertFalse(Cache::has(SocialLink::FOOTER_CACHE_KEY));

        $this->actingAs($this->admin)
            ->from(route('admin.social-links.index'))
            ->post(route('admin.social-links.move', ['socialLink' => $first, 'direction' => 'up']))
            ->assertRedirect(route('admin.social-links.index'));

        $this->assertSame(1, $first->fresh()->sort_order);
        $this->assertSame(2, $second->fresh()->sort_order);
    }
}
