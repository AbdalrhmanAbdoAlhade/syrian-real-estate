@extends('layouts.admin')
@section('title', 'إعدادات الموقع')
@section('content')

<div class="mb-6">
  <h2 class="text-2xl font-black">إعدادات الموقع</h2>
  <p class="text-sm text-gray-500 font-semibold mt-1">الاسم، التواصل، سعر الصرف، والشعارات</p>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-5 max-w-3xl">
  @csrf

  <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-50/60 flex items-center gap-2">
      <span class="w-8 h-8 rounded-xl bg-brand-600 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-globe"></i></span>
      <h3 class="font-black">الهوية العامة</h3>
    </div>
    <div class="p-6 grid sm:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-black mb-1.5">اسم الموقع <span class="text-brand-600">*</span></label>
        <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" required class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('site_name') border-red-400 @enderror">
        @error('site_name')<p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-black mb-1.5">الشعار الفرعي</label>
        <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline']) }}" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('site_tagline') border-red-400 @enderror">
        @error('site_tagline')<p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>@enderror
      </div>
      <div class="sm:col-span-2">
        <label class="block text-sm font-black mb-1.5">نص الترويسة (يظهر أعلى الموقع)</label>
        <input type="text" name="header_text" value="{{ old('header_text', $settings['header_text'] ?? '') }}" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('header_text') border-red-400 @enderror">
        @error('header_text')<p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>@enderror
      </div>
      <div class="sm:col-span-2">
        <label class="block text-sm font-black mb-1.5">نص الفوتر</label>
        <textarea name="footer_text" rows="2" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('footer_text') border-red-400 @enderror">{{ old('footer_text', $settings['footer_text']) }}</textarea>
        @error('footer_text')<p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>@enderror
      </div>
      <div class="sm:col-span-2">
        <label class="block text-sm font-black mb-1.5">حقوق النشر</label>
        <input type="text" name="footer_copyright" value="{{ old('footer_copyright', $settings['footer_copyright']) }}" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('footer_copyright') border-red-400 @enderror">
        @error('footer_copyright')<p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>@enderror
      </div>
    </div>
  </div>

  <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-50/60 flex items-center gap-2">
      <span class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-phone"></i></span>
      <h3 class="font-black">التواصل والعملة</h3>
    </div>
    <div class="p-6 grid sm:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-black mb-1.5">واتساب عام</label>
        <input type="text" dir="ltr" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp']) }}" placeholder="+963..." class="w-full border rounded-xl px-4 py-2.5 text-sm text-left focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('whatsapp') border-red-400 @enderror">
        @error('whatsapp')<p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-black mb-1.5">هاتف عام</label>
        <input type="text" dir="ltr" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" placeholder="+963..." class="w-full border rounded-xl px-4 py-2.5 text-sm text-left focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('phone') border-red-400 @enderror">
        @error('phone')<p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-black mb-1.5">هاتف افتراضي للعقارات الجديدة</label>
        <input type="text" dir="ltr" name="default_phone" value="{{ old('default_phone', $settings['default_phone']) }}" class="w-full border rounded-xl px-4 py-2.5 text-sm text-left focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('default_phone') border-red-400 @enderror">
        @error('default_phone')<p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm font-black mb-1.5">سعر الصرف (ليرة / دولار)</label>
        <input type="number" min="1" name="exchange_rate" value="{{ old('exchange_rate', $settings['exchange_rate']) }}" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('exchange_rate') border-red-400 @enderror">
        @error('exchange_rate')<p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>@enderror
      </div>
    </div>
  </div>

  <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-50/60 flex items-center gap-2">
      <span class="w-8 h-8 rounded-xl bg-brand-gold text-white flex items-center justify-center text-sm"><i class="fa-solid fa-image"></i></span>
      <h3 class="font-black">الشعار والأيقونة</h3>
    </div>
    <div class="p-6 grid sm:grid-cols-2 gap-4">
      <div class="border border-dashed rounded-2xl p-4 bg-gray-50/50">
        <label class="block text-sm font-black mb-1.5">الشعار (Logo)</label>
        <input type="file" name="logo" accept="image/*,.svg" class="w-full text-sm">
        @error('logo')<p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>@enderror
        @if($settings['logo'])<img src="{{ $settings['logo'] }}" alt="الشعار" class="mt-3 h-16 object-contain bg-white border rounded-xl px-3 py-1">@endif
      </div>
      <div class="border border-dashed rounded-2xl p-4 bg-gray-50/50">
        <label class="block text-sm font-black mb-1.5">أيقونة الموقع (Favicon)</label>
        <input type="file" name="favicon" accept="image/*,.ico,.svg" class="w-full text-sm">
        @error('favicon')<p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>@enderror
        @if($settings['favicon'])<img src="{{ $settings['favicon'] }}" alt="الأيقونة" class="mt-3 h-10 w-10 object-contain bg-white border rounded-xl p-1">@endif
      </div>
    </div>
  </div>

  <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-brand-600 hover:bg-brand-500 text-white py-3.5 rounded-2xl font-black shadow"><i class="fa-solid fa-floppy-disk"></i> حفظ الإعدادات</button>
</form>
@endsection
