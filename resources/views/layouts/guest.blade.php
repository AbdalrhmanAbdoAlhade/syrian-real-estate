<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'إرث الشام') }} — تسجيل الدخول</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script>tailwind.config={theme:{extend:{colors:{brand:{500:'#c53030',600:'#9b2c2c',gold:'#d69e2e'}}}}}</script>
  <style>body{font-family:'Cairo',sans-serif}</style>
  {{-- Vite build (optional enhancement; CDN above guarantees the page works even without a build) --}}
  @if(file_exists(public_path('build/manifest.json')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
</head>
<body class="text-gray-900 antialiased">
  <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10 bg-gradient-to-bl from-gray-950 via-gray-900 to-[#742a2a]">
    <a href="/" class="flex items-center gap-3 mb-8">
      <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-brand-600 to-brand-gold flex items-center justify-center text-white text-2xl shadow-lg">
        <i class="fa-solid fa-monument"></i>
      </div>
      <div>
        <span class="block text-2xl font-black text-white">إرث الشام</span>
        <span class="block text-xs font-semibold text-gray-400">منصة العقارات والسياحة في سوريا</span>
      </div>
    </a>
    <div class="w-full sm:max-w-md bg-white shadow-2xl overflow-hidden rounded-3xl px-7 py-8">
      {{ $slot }}
    </div>
    <a href="/" class="mt-6 text-sm font-bold text-gray-300 hover:text-white"><i class="fa-solid fa-arrow-right ml-1"></i> العودة إلى الموقع</a>
  </div>
</body>
</html>
