<?php $__env->startSection('title', 'لوحة التحكم'); ?>
<?php $__env->startSection('content'); ?>

<div class="flex flex-wrap items-center justify-between gap-4 mb-8">
  <div>
    <h2 class="text-2xl sm:text-3xl font-black">مرحباً، <?php echo e(auth()->user()->name); ?> 👋</h2>
    <p class="text-gray-500 font-semibold text-sm mt-1">نظرة سريعة على نشاط منصة إرث الشام العقارية</p>
  </div>
  <div class="flex gap-2">
    <a href="<?php echo e(route('admin.properties.create')); ?>" class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-500 text-white px-5 py-3 rounded-xl font-bold text-sm shadow">
      <i class="fa-solid fa-plus"></i> إضافة عقار
    </a>
    <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center gap-2 bg-white border hover:bg-gray-50 px-5 py-3 rounded-xl font-bold text-sm shadow-sm">
      <i class="fa-solid fa-eye text-gray-400"></i> عرض الموقع
    </a>
  </div>
</div>

<div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
  <div class="bg-white rounded-2xl shadow-sm border p-5 flex items-center gap-4">
    <div class="w-13 h-13 min-w-[52px] min-h-[52px] rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center text-2xl"><i class="fa-solid fa-building"></i></div>
    <div><p class="text-2xl font-black"><?php echo e($stats['total']); ?></p><p class="text-xs font-bold text-gray-500">إجمالي العقارات</p></div>
  </div>
  <div class="bg-white rounded-2xl shadow-sm border p-5 flex items-center gap-4">
    <div class="min-w-[52px] min-h-[52px] rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl"><i class="fa-solid fa-circle-check"></i></div>
    <div><p class="text-2xl font-black"><?php echo e($stats['active']); ?></p><p class="text-xs font-bold text-gray-500">عقار نشط</p></div>
  </div>
  <div class="bg-white rounded-2xl shadow-sm border p-5 flex items-center gap-4">
    <div class="min-w-[52px] min-h-[52px] rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl"><i class="fa-solid fa-tag"></i></div>
    <div><p class="text-2xl font-black"><?php echo e($stats['for_sale']); ?></p><p class="text-xs font-bold text-gray-500">للبيع</p></div>
  </div>
  <div class="bg-white rounded-2xl shadow-sm border p-5 flex items-center gap-4">
    <div class="min-w-[52px] min-h-[52px] rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl"><i class="fa-solid fa-key"></i></div>
    <div><p class="text-2xl font-black"><?php echo e($stats['for_rent']); ?></p><p class="text-xs font-bold text-gray-500">للإيجار</p></div>
  </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">
  <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b bg-gray-50/60">
      <h3 class="font-black"><i class="fa-solid fa-clock-rotate-left text-brand-600 ml-2"></i> أحدث العقارات</h3>
      <a href="<?php echo e(route('admin.properties.index')); ?>" class="text-sm font-bold text-brand-600 hover:underline">عرض الكل</a>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr class="border-b last:border-0 hover:bg-gray-50/70 transition">
            <td class="px-5 py-3"><img src="<?php echo e($p->image_url); ?>" alt="" class="w-16 h-12 object-cover rounded-xl border"></td>
            <td class="px-3 py-3 font-bold"><?php echo e(Str::limit($p->title, 35)); ?><span class="block text-xs text-gray-400 font-semibold"><?php echo e($p->city); ?> • $<?php echo e(number_format($p->price_usd)); ?></span></td>
            <td class="px-3 py-3"><span class="px-2.5 py-1 rounded-full text-xs font-black <?php echo e($p->purpose === 'بيع' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700'); ?>"><?php echo e($p->purpose); ?></span></td>
            <td class="px-3 py-3"><span class="px-2.5 py-1 rounded-full text-xs font-black <?php echo e($p->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-200 text-gray-600'); ?>"><?php echo e($p->is_active ? 'نشط' : 'مخفي'); ?></span></td>
            <td class="px-5 py-3 text-left whitespace-nowrap">
              <a href="<?php echo e(route('admin.properties.edit', $p)); ?>" class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 font-bold text-xs bg-blue-50 px-3 py-1.5 rounded-lg"><i class="fa-solid fa-pen"></i> تعديل</a>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr><td class="px-6 py-10 text-center text-gray-400 font-bold">لا توجد عقارات بعد — <a href="<?php echo e(route('admin.properties.create')); ?>" class="text-brand-600">أضف أول عقار</a></td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="space-y-6">
    <div class="bg-gray-950 text-white rounded-2xl p-6 shadow-sm relative overflow-hidden">
      <div class="absolute -left-8 -top-8 w-32 h-32 rounded-full bg-brand-600/30 blur-2xl"></div>
      <div class="absolute -right-8 -bottom-8 w-32 h-32 rounded-full bg-brand-gold/30 blur-2xl"></div>
      <h3 class="font-black mb-1 relative">إجراءات سريعة</h3>
      <p class="text-xs text-gray-400 font-semibold mb-4 relative">اختصارات لأكثر المهام استخداماً</p>
      <div class="space-y-2 relative">
        <a href="<?php echo e(route('admin.properties.create')); ?>" class="flex items-center gap-3 bg-white/10 hover:bg-white/15 px-4 py-3 rounded-xl text-sm font-bold"><i class="fa-solid fa-plus text-brand-gold"></i> إضافة عقار جديد</a>
        <a href="<?php echo e(route('admin.settings.index')); ?>" class="flex items-center gap-3 bg-white/10 hover:bg-white/15 px-4 py-3 rounded-xl text-sm font-bold"><i class="fa-solid fa-gear text-brand-gold"></i> إعدادات الموقع</a>
        <a href="<?php echo e(route('admin.admins.index')); ?>" class="flex items-center gap-3 bg-white/10 hover:bg-white/15 px-4 py-3 rounded-xl text-sm font-bold"><i class="fa-solid fa-user-shield text-brand-gold"></i> إدارة المشرفين</a>
      </div>
    </div>
    <div class="bg-white rounded-2xl border shadow-sm p-6">
      <h3 class="font-black mb-4"><i class="fa-solid fa-chart-pie text-brand-600 ml-2"></i> حالة النشر</h3>
      <?php $pct = $stats['total'] > 0 ? round($stats['active'] / $stats['total'] * 100) : 0; ?>
      <div class="flex items-center justify-between text-xs font-bold text-gray-500 mb-2"><span>العقارات النشطة</span><span><?php echo e($pct); ?>%</span></div>
      <div class="h-3 rounded-full bg-gray-100 overflow-hidden mb-4"><div class="h-full rounded-full bg-gradient-to-l from-brand-600 to-brand-gold" style="width: <?php echo e($pct); ?>%"></div></div>
      <div class="flex items-center justify-between text-xs font-bold"><span class="text-emerald-600"><i class="fa-solid fa-eye ml-1"></i> <?php echo e($stats['active']); ?> ظاهر</span><span class="text-gray-400"><i class="fa-solid fa-eye-slash ml-1"></i> <?php echo e($stats['hidden']); ?> مخفي</span></div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\syrian-real-estate\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>