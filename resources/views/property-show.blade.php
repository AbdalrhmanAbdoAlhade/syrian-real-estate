@extends('layouts.frontend')
@section('title', $property->title)
@section('content')
@php
  $cover = $property->cover;
  $galleryImages = collect([$cover])->filter()
      ->concat($property->images->where('is_cover', false))
      ->values();
  $galleryVideos = $property->videos;
@endphp
<div class="max-w-5xl mx-auto px-4 py-12">
<div class="bg-white rounded-3xl overflow-hidden shadow-xl">
  <div class="grid md:grid-cols-2">
    <div class="relative h-80 md:h-full min-h-[320px] bg-gray-900">
      @if($galleryImages->isNotEmpty())
        <img id="mainGalleryImage" src="{{ $galleryImages->first()->url }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
      @else
        <img id="mainGalleryImage" src="{{ $property->cover_url }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
      @endif
      <span class="absolute bottom-4 right-4 {{ $property->purpose==='بيع'?'bg-brand-600 text-[#f7efe4]':'bg-brand-gold text-[#2b1f18]' }} px-4 py-1.5 rounded-xl font-bold text-sm">{{ $property->purpose==='بيع'?'للبيع':'للإيجار' }}</span>
    </div>
    <div class="bg-gray-50 p-4">
      @if($galleryImages->isNotEmpty())
        <div class="grid grid-cols-3 gap-2">
          @foreach($galleryImages as $index => $media)
            <button type="button" data-gallery-src="{{ $media->url }}" class="relative rounded-xl overflow-hidden border-2 {{ $index === 0 ? 'border-brand-500' : 'border-transparent' }} gallery-thumb">
              <img src="{{ $media->url }}" loading="lazy" alt="{{ $property->title }}" class="w-full h-24 object-cover">
              @if($media->is_cover)
                <span class="absolute top-1 right-1 bg-brand-gold text-gray-900 text-[10px] font-black px-1.5 py-0.5 rounded-full"><i class="fa-solid fa-star"></i> الغلاف</span>
              @endif
            </button>
          @endforeach
        </div>
      @else
        <div class="h-full flex items-center justify-center text-center text-gray-400 font-bold text-sm p-6">لا توجد صور لهذا العقار بعد</div>
      @endif
    </div>
  </div>

  <div class="p-8 space-y-6">
    <span class="text-brand-600 font-bold text-sm"><i class="fa-solid fa-location-dot"></i> {{ $property->city }} @if($property->district)- {{ $property->district }}@endif</span>
    <h1 class="text-3xl font-black">{{ $property->title }}</h1>

    @if($property->sections->isNotEmpty())
      <div class="flex flex-wrap gap-2">
        @foreach($property->sections as $section)
          <a href="{{ route('home', ['section_id' => $section->id]) }}#properties" class="inline-flex items-center gap-1.5 bg-brand-100 text-brand-700 hover:bg-brand-500 hover:text-[#2b1f18] px-3 py-1.5 rounded-full text-xs font-black">
            <i class="fa-solid fa-layer-group"></i> {{ $section->name }}
          </a>
        @endforeach
      </div>
    @endif

    <div class="grid grid-cols-3 gap-4 bg-gray-50 p-4 rounded-2xl text-center">
      <div><span class="text-xs text-gray-400 block">المساحة</span><span class="font-black">{{ $property->area }} م²</span></div>
      <div><span class="text-xs text-gray-400 block">الغرف</span><span class="font-black">{{ $property->rooms }}</span></div>
      <div><span class="text-xs text-gray-400 block">الحمامات</span><span class="font-black">{{ $property->bathrooms }}</span></div>
    </div>

    <p class="text-gray-600">{{ $property->description }}</p>

    @if($galleryVideos->isNotEmpty())
      <div class="border-t pt-6">
        <h3 class="text-xl font-black mb-4"><i class="fa-solid fa-video text-brand-600 ml-2"></i> فيديوهات العقار</h3>
        <div class="grid md:grid-cols-2 gap-4">
          @foreach($galleryVideos as $video)
            <div class="bg-gray-900 rounded-2xl overflow-hidden">
              <video src="{{ $video->url }}" controls preload="metadata" poster="{{ $property->cover_url }}" class="w-full h-56 object-cover"></video>
            </div>
          @endforeach
        </div>
      </div>
    @endif

    <div class="flex flex-wrap justify-between items-center gap-4 border-t pt-4">
      <span class="text-2xl font-black text-brand-600">${{ number_format($property->price_usd) }}</span>
      <div class="flex gap-3">
        @if($property->phone)
          <a href="tel:{{ $property->phone }}" class="bg-brand-gold text-[#2b1f18] hover:brightness-105 px-6 py-3 rounded-xl font-bold"><i class="fa-solid fa-phone"></i> اتصال</a>
          <a href="{{ $property->whatsapp_link }}" class="bg-brand-600 text-white px-6 py-3 rounded-xl font-bold"><i class="fa-brands fa-whatsapp"></i> واتساب</a>
        @endif
      </div>
    </div>
  </div>
</div>
<a href="{{ route('home') }}" class="block text-center mt-6 text-brand-600 font-bold">← العودة</a>
</div>

<script>
document.querySelectorAll('[data-gallery-src]').forEach(function (button) {
  button.addEventListener('click', function () {
    const image = document.getElementById('mainGalleryImage');
    if (image) image.src = button.dataset.gallerySrc;

    document.querySelectorAll('.gallery-thumb').forEach(function (thumb) {
      thumb.classList.remove('border-brand-500');
      thumb.classList.add('border-transparent');
    });
    button.classList.remove('border-transparent');
    button.classList.add('border-brand-500');
  });
});
</script>
@endsection
