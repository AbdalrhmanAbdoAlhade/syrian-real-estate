<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo $__env->yieldContent('title', 'لوحة التحكم'); ?> - إرث الشام</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script>
tailwind.config = {
  theme: {
    extend: {
      fontFamily: { cairo: ['Cairo', 'sans-serif'] },
      colors: { brand: { 50: '#fdf8f6', 100: '#fbe8e6', 500: '#c53030', 600: '#9b2c2c', 700: '#742a2a', gold: '#d69e2e' } }
    }
  }
};
</script>
<style>
body { font-family: 'Cairo', sans-serif; }
.sidebar-link { transition: all .2s; }
.sidebar-link:hover, .sidebar-link.active { background: rgba(255,255,255,.08); border-color: #d69e2e; }
input:focus, select:focus, textarea:focus { outline: none; }
</style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

<div class="min-h-screen lg:flex">

  <!-- Sidebar (desktop) -->
  <aside class="hidden lg:flex flex-col w-72 shrink-0 bg-gray-950 text-gray-300 min-h-screen sticky top-0 h-screen">
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 px-6 h-20 border-b border-white/10">
      <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-brand-600 to-brand-gold flex items-center justify-center text-white shrink-0">
        <i class="fa-solid fa-monument text-xl"></i>
      </div>
      <div>
        <span class="block text-lg font-black text-white leading-tight">إرث الشام</span>
        <span class="block text-xs text-gray-400">لوحة التحكم</span>
      </div>
    </a>
    <nav class="flex-1 px-4 py-6 space-y-1.5 text-sm font-bold">
      <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl border border-transparent <?php echo e(request()->routeIs('admin.dashboard') ? 'active text-white' : ''); ?>">
        <i class="fa-solid fa-gauge-high w-5 text-center text-brand-gold"></i> الرئيسية
      </a>
      <a href="<?php echo e(route('admin.properties.index')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl border border-transparent <?php echo e(request()->routeIs('admin.properties.*') ? 'active text-white' : ''); ?>">
        <i class="fa-solid fa-building w-5 text-center text-brand-gold"></i> العقارات
      </a>
      <a href="<?php echo e(route('admin.properties.create')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl border border-transparent">
        <i class="fa-solid fa-plus w-5 text-center text-brand-gold"></i> إضافة عقار
      </a>
      <a href="<?php echo e(route('admin.sections.index')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl border border-transparent <?php echo e(request()->routeIs('admin.sections.*') ? 'active text-white' : ''); ?>">
        <i class="fa-solid fa-layer-group w-5 text-center text-brand-gold"></i> الأقسام
      </a>
      <a href="<?php echo e(route('admin.social-links.index')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl border border-transparent <?php echo e(request()->routeIs('admin.social-links.*') ? 'active text-white' : ''); ?>">
        <i class="fa-solid fa-share-nodes w-5 text-center text-brand-gold"></i> روابط التواصل
      </a>
      <a href="<?php echo e(route('admin.settings.index')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl border border-transparent <?php echo e(request()->routeIs('admin.settings.*') ? 'active text-white' : ''); ?>">
        <i class="fa-solid fa-gear w-5 text-center text-brand-gold"></i> إعدادات الموقع
      </a>
      <a href="<?php echo e(route('admin.admins.index')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl border border-transparent <?php echo e(request()->routeIs('admin.admins.*') ? 'active text-white' : ''); ?>">
        <i class="fa-solid fa-user-shield w-5 text-center text-brand-gold"></i> المشرفين
      </a>
    </nav>
    <div class="px-4 pb-6 space-y-2">
      <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/5 hover:bg-white/10 text-sm font-bold">
        <i class="fa-solid fa-eye w-5 text-center text-emerald-400"></i> عرض الموقع
      </a>
      <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button class="w-full flex items-center gap-3 px-4 py-3 rounded-xl bg-brand-600 hover:bg-brand-500 text-white text-sm font-bold">
          <i class="fa-solid fa-right-from-bracket w-5 text-center"></i> تسجيل الخروج
        </button>
      </form>
    </div>
  </aside>

  <!-- Main column -->
  <div class="flex-1 min-w-0">

    <!-- Topbar -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md shadow-sm border-b border-gray-100">
      <div class="px-4 sm:px-8 h-20 flex items-center justify-between gap-4">
        <div class="flex items-center gap-3">
          <button id="mobileMenuBtn" class="lg:hidden w-11 h-11 rounded-xl bg-gray-100 flex items-center justify-center">
            <i class="fa-solid fa-bars"></i>
          </button>
          <div class="lg:hidden flex items-center gap-2">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-brand-600 to-brand-gold flex items-center justify-center text-white">
              <i class="fa-solid fa-monument"></i>
            </div>
            <span class="font-black">إرث الشام</span>
          </div>
          <h1 class="hidden lg:block text-xl font-black"><?php echo $__env->yieldContent('title', 'لوحة التحكم'); ?></h1>
        </div>
        <div class="flex items-center gap-3">
          <a href="<?php echo e(route('home')); ?>" class="hidden sm:inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 px-4 py-2.5 rounded-xl text-sm font-bold">
            <i class="fa-solid fa-eye text-gray-500"></i> عرض الموقع
          </a>
          <div class="flex items-center gap-2 bg-brand-50 border border-brand-100 px-3 py-2 rounded-xl">
            <div class="w-8 h-8 rounded-full bg-brand-600 text-white flex items-center justify-center font-black text-sm">
              <?php echo e(mb_substr(auth()->user()->name ?? 'م', 0, 1)); ?>

            </div>
            <span class="text-sm font-bold hidden sm:block"><?php echo e(auth()->user()->name); ?></span>
          </div>
        </div>
      </div>
      <!-- Mobile nav -->
      <nav id="mobileMenu" class="lg:hidden hidden px-4 pb-4 flex flex-wrap gap-2 text-sm font-bold">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="bg-gray-100 px-4 py-2 rounded-xl"><i class="fa-solid fa-gauge-high ml-1"></i> الرئيسية</a>
        <a href="<?php echo e(route('admin.properties.index')); ?>" class="bg-gray-100 px-4 py-2 rounded-xl"><i class="fa-solid fa-building ml-1"></i> العقارات</a>
        <a href="<?php echo e(route('admin.properties.create')); ?>" class="bg-gray-100 px-4 py-2 rounded-xl"><i class="fa-solid fa-plus ml-1"></i> إضافة عقار</a>
        <a href="<?php echo e(route('admin.sections.index')); ?>" class="bg-gray-100 px-4 py-2 rounded-xl"><i class="fa-solid fa-layer-group ml-1"></i> الأقسام</a>
        <a href="<?php echo e(route('admin.social-links.index')); ?>" class="bg-gray-100 px-4 py-2 rounded-xl"><i class="fa-solid fa-share-nodes ml-1"></i> روابط التواصل</a>
        <a href="<?php echo e(route('admin.settings.index')); ?>" class="bg-gray-100 px-4 py-2 rounded-xl"><i class="fa-solid fa-gear ml-1"></i> الإعدادات</a>
        <a href="<?php echo e(route('admin.admins.index')); ?>" class="bg-gray-100 px-4 py-2 rounded-xl"><i class="fa-solid fa-user-shield ml-1"></i> المشرفين</a>
      </nav>
    </header>

    <main class="px-4 sm:px-8 py-8 max-w-7xl mx-auto">
      <?php if(session('success')): ?>
        <div class="mb-6 flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl shadow-sm">
          <i class="fa-solid fa-circle-check text-emerald-500 text-xl mt-0.5"></i>
          <span class="font-bold text-sm leading-relaxed"><?php echo e(session('success')); ?></span>
        </div>
      <?php endif; ?>
      <?php if(session('error')): ?>
        <div class="mb-6 flex items-start gap-3 bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl shadow-sm">
          <i class="fa-solid fa-circle-exclamation text-red-500 text-xl mt-0.5"></i>
          <span class="font-bold text-sm leading-relaxed"><?php echo e(session('error')); ?></span>
        </div>
      <?php endif; ?>
      <?php if($errors->any()): ?>
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl shadow-sm">
          <p class="font-black text-sm mb-2"><i class="fa-solid fa-triangle-exclamation ml-1"></i> يرجى تصحيح الأخطاء التالية:</p>
          <ul class="text-sm font-semibold list-disc pr-5 space-y-1">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php echo $__env->yieldContent('content'); ?>

      <footer class="mt-12 text-center text-xs text-gray-400 font-semibold">
        منصة إرث الشام — لوحة التحكم © <?php echo e(date('Y')); ?>

      </footer>
    </main>
  </div>
</div>

<script>
document.getElementById('mobileMenuBtn')?.addEventListener('click', () => {
  document.getElementById('mobileMenu')?.classList.toggle('hidden');
});
</script>
</body>
</html>
<?php /**PATH D:\syrian-real-estate\resources\views\layouts\admin.blade.php ENDPATH**/ ?>