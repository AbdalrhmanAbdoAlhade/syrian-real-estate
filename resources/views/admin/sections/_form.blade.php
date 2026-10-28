@php $isEdit = isset($section) && $section; @endphp

<div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
  <div class="px-6 py-4 border-b bg-gray-50/60 flex items-center gap-2">
    <span class="w-8 h-8 rounded-xl bg-brand-600 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-layer-group"></i></span>
    <h3 class="font-black">بيانات القسم</h3>
  </div>
  <div class="p-6 grid sm:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-black mb-1.5">الاسم بالعربية <span class="text-brand-600">*</span></label>
      <input type="text" name="name_ar" value="{{ old('name_ar', $section->name_ar ?? '') }}" required placeholder="مثال: شقق"
        class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('name_ar') border-red-400 @enderror">
      @error('name_ar')<p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i>{{ $message }}</p>@enderror
    </div>
    <div>
      <label class="block text-sm font-black mb-1.5">الاسم بالإنجليزية <span class="text-brand-600">*</span></label>
      <input type="text" name="name_en" dir="ltr" value="{{ old('name_en', $section->name_en ?? '') }}" required placeholder="Apartments"
        class="w-full border rounded-xl px-4 py-2.5 text-sm text-left focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('name_en') border-red-400 @enderror">
      @error('name_en')<p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i>{{ $message }}</p>@enderror
    </div>
  </div>
</div>
