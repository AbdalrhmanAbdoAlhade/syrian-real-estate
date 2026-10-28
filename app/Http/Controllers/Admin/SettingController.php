<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index() {
        $settings = [
            'site_name' => Setting::get('site_name', 'إرث الشام'),
            'site_tagline' => Setting::get('site_tagline', 'العقارات والسياحة في سوريا'),
            'header_text' => Setting::get('header_text', ''),
            'footer_text' => Setting::get('footer_text', 'المنصة العقارية والسياحية الأبرز في الجمهورية العربية السورية.'),
            'footer_copyright' => Setting::get('footer_copyright', 'جميع الحقوق محفوظة © ' . date('Y') . ' منصة إرث الشام.'),
            'whatsapp' => Setting::get('whatsapp', ''),
            'phone' => Setting::get('phone', ''),
            'default_phone' => Setting::get('default_phone', ''),
            'exchange_rate' => Setting::get('exchange_rate', '15000'),
            'logo' => Setting::getLogoUrl(),
            'favicon' => Setting::getFaviconUrl(),
        ];
        return view('admin.settings.index', compact('settings'));
    }
    public function update(Request $request) {
        $request->validate([
            'site_name' => 'required|string|max:100',
            'site_tagline' => 'nullable|string|max:200',
            'header_text' => 'nullable|string|max:500',
            'footer_text' => 'nullable|string|max:500',
            'footer_copyright' => 'nullable|string|max:300',
            'whatsapp' => 'nullable|string|max:30',
            'phone' => 'nullable|string|max:30',
            'default_phone' => 'nullable|string|max:30',
            'exchange_rate' => 'nullable|numeric|min:1',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'favicon' => 'nullable|file|mimes:ico,png,jpg,jpeg,svg,webp|max:1024',
        ]);
        foreach (['site_name','site_tagline','header_text','footer_text','footer_copyright','whatsapp','phone','default_phone','exchange_rate'] as $key) {
            if ($request->has($key)) Setting::set($key, $request->input($key));
        }
        if ($request->hasFile('logo')) {
            $old = Setting::get('logo');
            if ($old) Storage::disk('public')->delete($old);
            Setting::set('logo', $request->file('logo')->store('settings', 'public'));
        }
        if ($request->hasFile('favicon')) {
            $old = Setting::get('favicon');
            if ($old) Storage::disk('public')->delete($old);
            Setting::set('favicon', $request->file('favicon')->store('settings', 'public'));
        }
        return back()->with('success', 'تم حفظ الإعدادات بنجاح');
    }
}
