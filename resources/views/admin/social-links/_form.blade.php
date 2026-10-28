@php
  $isEdit = isset($socialLink) && $socialLink;
  $platforms = [
    'facebook' => ['فيسبوك', 'Facebook'],
    'instagram' => ['إنستغرام', 'Instagram'],
    'x' => ['إكس', 'X'],
    'youtube' => ['يوتيوب', 'YouTube'],
    'tiktok' => ['تيك توك', 'TikTok'],
    'whatsapp' => ['واتساب', 'WhatsApp'],
    'telegram' => ['تلغرام', 'Telegram'],
    'linkedin' => ['لينكد إن', 'LinkedIn'],
    'snapchat' => ['سناب شات', 'Snapchat'],
    'website' => ['موقع إلكتروني', 'Website'],
    'other' => ['أخرى', 'Other'],
  ];
@endphp

<div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
  <div class="px-6 py-4 border-b bg-gray-50/60 flex items-center gap-2">
    <span class="w-8 h-8 rounded-xl bg-brand-600 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-share-nodes"></i></span>
    <h3 class="font-black">بيانات الرابط</h3>
  </div>
  <div class="p-6 grid sm:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-black mb-1.5">المنصة <span class="text-brand-600">*</span></label>
      <select name="platform" required class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('platform') border-red-400 @enderror">
        @foreach($platforms as $value => $labels)
          <option value="{{ $value }}" @selected(old('platform', $socialLink->platform ?? 'facebook') === $value)>{{ $labels[0] }} — {{ $labels[1] }}</option>
        @endforeach
      </select>
      @error('platform')<p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i>{{ $message }}</p>@enderror
    </div>

    <div>
      <label class="block text-sm font-black mb-1.5">الرابط <span class="text-brand-600">*</span></label>
      <input type="url" name="url" dir="ltr" required value="{{ old('url', $socialLink->url ?? '') }}" placeholder="https://example.com/page" class="w-full border rounded-xl px-4 py-2.5 text-sm text-left focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('url') border-red-400 @enderror">
      <p class="text-[11px] text-gray-400 font-semibold mt-1">يُقبل http أو https فقط.</p>
      @error('url')<p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i>{{ $message }}</p>@enderror
    </div>

    <div>
      <label class="block text-sm font-black mb-1.5">العنوان بالعربية</label>
      <input type="text" name="label_ar" value="{{ old('label_ar', $socialLink->label_ar ?? '') }}" placeholder="مثال: صفحتنا على فيسبوك" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('label_ar') border-red-400 @enderror">
      @error('label_ar')<p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i>{{ $message }}</p>@enderror
    </div>

    <div>
      <label class="block text-sm font-black mb-1.5">العنوان بالإنجليزية</label>
      <input type="text" name="label_en" dir="ltr" value="{{ old('label_en', $socialLink->label_en ?? '') }}" placeholder="Our Facebook page" class="w-full border rounded-xl px-4 py-2.5 text-sm text-left focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('label_en') border-red-400 @enderror">
      @error('label_en')<p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i>{{ $message }}</p>@enderror
    </div>

    <div>
      <label class="block text-sm font-black mb-1.5">الترتيب</label>
      <input type="number" name="sort_order" min="0" step="1" value="{{ old('sort_order', $socialLink->sort_order ?? 0) }}" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('sort_order') border-red-400 @enderror">
      @error('sort_order')<p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i>{{ $message }}</p>@enderror
    </div>

    <div class="flex items-center gap-3 pt-6">
      <input type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $socialLink->is_active ?? true)) class="w-5 h-5 rounded border-gray-300 text-brand-600 focus:ring-brand-500">
      <label for="is_active" class="text-sm font-black cursor-pointer">مفعّل ويظهر في تذييل الموقع</label>
    </div>
  </div>
</div>
