<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', $settings['site_name'] ?? 'إرث الشام')</title>
@if(!empty($settings['favicon']))<link rel="icon" href="{{ $settings['favicon'] }}">@endif
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script>tailwind.config={theme:{extend:{fontFamily:{cairo:['Cairo','sans-serif']},colors:{brand:{50:'#faf6ee',100:'#f3e9db',500:'#c0954f',600:'#2b1f18',700:'#1c130d',gold:'#c0954f'}}}}}</script>
<style>html{scroll-behavior:smooth}body{font-family:'Cairo',sans-serif}.hero-gradient{background:linear-gradient(rgba(43,31,24,.82),rgba(43,31,24,.72)),url('{{ asset('images/hero-erth-alsham.jpg') }}') no-repeat center/cover}.tourism-bg{background:linear-gradient(rgba(43,31,24,.88),rgba(43,31,24,.78)),url('{{ asset('images/hero-erth-alsham.jpg') }}') no-repeat center/cover}#properties,#sections,#tourism,#contact,#about,#vision,#services,#process,#why,#clients,#taglines{scroll-margin-top:6rem}@media (prefers-reduced-motion:reduce){html{scroll-behavior:auto}}</style>
</head>
<body class="bg-[#faf6ef] text-[#4a3a2d] antialiased">
<header class="sticky top-0 z-50 bg-[#f7efe4]/95 backdrop-blur-md shadow-sm border-b border-[#e3d5be]">
<div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
<a href="{{ route('home') }}" class="flex items-center gap-3">
@if(!empty($settings['logo']))<img src="{{ $settings['logo'] }}" class="w-12 h-12 rounded-xl object-cover">@else
<div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-brand-600 to-brand-gold flex items-center justify-center text-white"><i class="fa-solid fa-monument text-2xl"></i></div>@endif
<div><span class="text-2xl font-black text-[#2b1f18]">{{ $settings['site_name'] ?? 'إرث الشام' }}</span>
<span class="block text-xs font-semibold text-[#7a6a56]">{{ $settings['site_tagline'] ?? '' }}</span></div></a>
<nav class="hidden md:flex items-center gap-8 font-semibold text-[#5b4636]">
<a href="{{ route('home') }}#properties" class="hover:text-[#9a7434]">العقارات</a>
<a href="{{ route('home') }}#tourism" class="hover:text-[#9a7434]">الدليل السياحي</a>
<a href="{{ route('home') }}#contact" class="hover:text-[#9a7434]">اتصل بنا</a>
</nav>
<div class="flex items-center gap-3">
<button id="mobileNavBtn" type="button" class="md:hidden w-11 h-11 rounded-xl bg-[#ecdfcb] text-[#2b1f18] flex items-center justify-center" aria-controls="mobileNav" aria-expanded="false" aria-label="فتح قائمة التنقل"><i class="fa-solid fa-bars"></i></button>
@auth
@if(auth()->user()->isAdmin())<a href="{{ route('admin.properties.index') }}" class="bg-brand-gold text-[#2b1f18] px-4 py-2 rounded-xl font-bold text-sm hover:brightness-105">لوحة التحكم</a>@endif
<form method="POST" action="{{ route('logout') }}">@csrf<button class="bg-white border border-[#d9c6a8] text-[#2b1f18] px-4 py-2 rounded-xl font-bold text-sm hover:bg-[#ecdfcb]">خروج</button></form>
@else
<a href="{{ route('login') }}" class="bg-[#2b1f18] text-[#f7efe4] hover:bg-[#3d2c1f] px-4 py-2.5 rounded-xl font-bold"><i class="fa-solid fa-user ml-1"></i> دخول</a>
@endauth
</div></div>
<nav id="mobileNav" class="md:hidden hidden border-t border-[#e3d5be] bg-[#f7efe4] px-4 py-3 space-y-1 font-semibold text-[#5b4636]">
<a href="{{ route('home') }}#properties" class="block px-3 py-2.5 rounded-xl hover:bg-[#ecdfcb] hover:text-[#9a7434]">العقارات</a>
<a href="{{ route('home') }}#tourism" class="block px-3 py-2.5 rounded-xl hover:bg-[#ecdfcb] hover:text-[#9a7434]">الدليل السياحي</a>
<a href="{{ route('home') }}#contact" class="block px-3 py-2.5 rounded-xl hover:bg-[#ecdfcb] hover:text-[#9a7434]">اتصل بنا</a>
</nav></header>
@if(session('success'))
<div class="fixed bottom-6 left-6 z-50 bg-[#2b1f18] text-[#f7efe4] border border-brand-gold/40 px-6 py-3 rounded-2xl" id="toast"><i class="fa-solid fa-circle-check text-brand-gold"></i> {{ session('success') }}</div>
<script>setTimeout(()=>document.getElementById('toast')?.remove(),3500)</script>
@endif
@yield('content')
@php
$socialLinks = \App\Models\SocialLink::cachedFooterLinks();
@endphp
<footer class="bg-[#2b1f18] text-[#cbb596] py-12 px-4 border-t border-[#c0954f]/30">
<div class="max-w-7xl mx-auto grid {{ !empty($socialLinks) ? 'md:grid-cols-4' : 'md:grid-cols-3' }} gap-8 mb-8">
<div><span class="text-xl font-black text-[#f7efe4]">{{ $settings['site_name'] ?? 'إرث الشام' }}</span>
<p class="text-sm mt-2">{{ $settings['footer_text'] ?? '' }}</p></div>
<div><h4 class="text-brand-gold font-black mb-4">روابط</h4>
<a href="{{ route('home') }}#properties" class="text-sm hover:text-brand-gold">العقارات</a></div>
<div><h4 class="text-brand-gold font-black mb-4">تواصل</h4>
@if(!empty($settings['whatsapp']))
<a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$settings['whatsapp']) }}" class="text-brand-gold hover:underline text-sm"><i class="fa-brands fa-whatsapp"></i> واتساب</a>
@endif
</div>
@if(!empty($socialLinks))
<div data-social-links>
<h4 class="text-brand-gold font-black mb-4">تابعنا</h4>
<div class="flex flex-wrap gap-2">
@foreach($socialLinks as $link)
@php
$label = app()->getLocale() === 'ar'
    ? ($link['label_ar'] ?: ($link['label_en'] ?: \Illuminate\Support\Str::headline($link['platform'])))
    : ($link['label_en'] ?: ($link['label_ar'] ?: \Illuminate\Support\Str::headline($link['platform'])));
@endphp
<a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $label }}" title="{{ $label }}" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-brand-gold text-[#cbb596] hover:text-[#2b1f18] flex items-center justify-center transition">
@include('partials.social-icon', ['platform' => $link['platform']])
</a>
@endforeach
</div>
</div>
@endif
</div>
<div class="text-center text-xs text-[#9c8763] border-t border-[#c0954f]/20 pt-8">{{ $settings['footer_copyright'] ?? '' }}</div>
</footer>
<script>
(() => {
  const button = document.getElementById('mobileNavBtn');
  const menu = document.getElementById('mobileNav');
  if (!button || !menu) return;

  const setOpen = (open) => {
    menu.classList.toggle('hidden', !open);
    button.setAttribute('aria-expanded', open ? 'true' : 'false');
  };

  button.addEventListener('click', () => setOpen(menu.classList.contains('hidden')));
  menu.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setOpen(false)));
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') setOpen(false);
  });
})();
</script>
</body></html>
