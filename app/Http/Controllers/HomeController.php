<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Section;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with(['media', 'images', 'videos', 'cover', 'sections'])
            ->where('is_active', true);
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        if ($request->filled('purpose') && in_array($request->purpose, ['بيع', 'إيجار'])) {
            $query->where('purpose', $request->purpose);
        }
        if ($request->filled('max_price')) {
            $query->where('price_usd', '<=', (float) $request->max_price);
        }

        $sectionIds = $request->input('section_ids', $request->input('section_id'));
        if ($sectionIds !== null && $sectionIds !== '' && $sectionIds !== []) {
            $query->inSection($sectionIds);
        }

        $properties = $query->latest()->get();
        $sections = Section::withCount(['properties' => fn ($query) => $query->where('is_active', true)])
            ->orderBy('name_ar')
            ->get();
        $settings = $this->getSettings();

        return view('home', compact('properties', 'settings', 'sections'));
    }

    public function show(Property $property)
    {
        if (! $property->is_active) {
            abort(404);
        }
        $property->load(['media', 'images', 'videos', 'cover', 'sections']);
        $settings = $this->getSettings();

        return view('property-show', compact('property', 'settings'));
    }

    private function getSettings(): array
    {
        return [
            'site_name' => Setting::get('site_name', 'إرث الشام'),
            'site_tagline' => Setting::get('site_tagline', 'منصتك العقارية الموثوقة في سورية'),
            'logo' => Setting::getLogoUrl(),
            'favicon' => Setting::getFaviconUrl(),
            'header_text' => Setting::get('header_text', ''),
            'footer_text' => Setting::get('footer_text', 'نقدم لك أفضل الخيارات العقارية في سورية مع خدمة عملاء مميزة.'),
            'footer_copyright' => Setting::get('footer_copyright', 'جميع الحقوق محفوظة © '.date('Y').' إرث الشام للاستثمار العقاري.'),
            'whatsapp' => Setting::get('whatsapp', ''),
            'phone' => Setting::get('phone', ''),
            'exchange_rate' => (float) Setting::get('exchange_rate', 15000),
        ];
    }
}
