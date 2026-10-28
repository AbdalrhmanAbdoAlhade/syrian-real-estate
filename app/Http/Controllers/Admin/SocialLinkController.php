<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialLink\StoreSocialLinkRequest;
use App\Http\Requests\SocialLink\UpdateSocialLinkRequest;
use App\Models\SocialLink;
use Illuminate\Support\Facades\DB;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::orderBy('sort_order')
            ->orderBy('id')
            ->paginate(50);

        return view('admin.social-links.index', compact('socialLinks'));
    }

    public function create()
    {
        return view('admin.social-links.create');
    }

    public function store(StoreSocialLinkRequest $request)
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        SocialLink::create($data);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'تم إضافة رابط التواصل بنجاح.');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-links.edit', compact('socialLink'));
    }

    public function update(UpdateSocialLinkRequest $request, SocialLink $socialLink)
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        $socialLink->update($data);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'تم تحديث رابط التواصل بنجاح.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return redirect()->route('admin.social-links.index')
            ->with('success', 'تم حذف رابط التواصل.');
    }

    public function toggle(SocialLink $socialLink)
    {
        $socialLink->update(['is_active' => ! $socialLink->is_active]);

        return redirect()->route('admin.social-links.index')
            ->with('success', $socialLink->is_active ? 'تم تفعيل الرابط.' : 'تم تعطيل الرابط.');
    }

    public function move(SocialLink $socialLink, string $direction)
    {
        if (! in_array($direction, ['up', 'down'], true)) {
            abort(404);
        }

        $links = SocialLink::orderBy('sort_order')->orderBy('id')->get()->values();
        $index = $links->search(fn (SocialLink $link): bool => $link->is($socialLink));

        if ($index === false) {
            abort(404);
        }

        $target = $direction === 'up' ? $index - 1 : $index + 1;

        if ($target < 0 || $target >= $links->count()) {
            return redirect()->route('admin.social-links.index')
                ->with('error', 'لا يمكن تحريك الرابط أكثر في هذا الاتجاه.');
        }

        $moving = $links->splice($index, 1)->first();
        $links->splice($target, 0, [$moving]);

        DB::transaction(function () use ($links): void {
            foreach ($links as $position => $link) {
                $link->sort_order = $position + 1;
                $link->save();
            }
        });

        return redirect()->route('admin.social-links.index')
            ->with('success', 'تم تحديث ترتيب الروابط.');
    }
}
