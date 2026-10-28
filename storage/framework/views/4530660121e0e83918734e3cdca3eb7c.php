<?php $__env->startSection('title', 'الأقسام'); ?>
<?php $__env->startSection('content'); ?>

<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
  <div>
    <h2 class="text-2xl font-black">الأقسام</h2>
    <p class="text-sm text-gray-500 font-semibold mt-1">إجمالي <?php echo e($sections->total()); ?> قسم — تُستخدم لتصنيف العقارات في لوحة التحكم والموقع</p>
  </div>
  <div class="flex gap-2">
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="inline-flex items-center gap-2 bg-white border px-4 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50"><i class="fa-solid fa-gauge-high text-gray-400"></i> الرئيسية</a>
    <a href="<?php echo e(route('admin.sections.create')); ?>" class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-500 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow"><i class="fa-solid fa-plus"></i> إضافة قسم</a>
  </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm min-w-[720px]">
      <thead>
        <tr class="bg-gray-950 text-white text-xs">
          <th class="px-5 py-3.5 text-right font-black">الاسم بالعربية</th>
          <th class="px-5 py-3.5 text-right font-black">الاسم بالإنجليزية</th>
          <th class="px-5 py-3.5 text-right font-black">عدد العقارات</th>
          <th class="px-5 py-3.5 text-right font-black">تاريخ الإنشاء</th>
          <th class="px-5 py-3.5 text-right font-black">إجراءات</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr class="border-b last:border-0 hover:bg-brand-50/50 transition">
            <td class="px-5 py-3.5 font-black"><?php echo e($section->name_ar); ?></td>
            <td class="px-5 py-3.5 font-semibold text-gray-600" dir="ltr" style="text-align:right"><?php echo e($section->name_en); ?></td>
            <td class="px-5 py-3.5">
              <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 px-2.5 py-1 rounded-full text-xs font-black">
                <i class="fa-solid fa-building"></i> <?php echo e($section->properties_count); ?>

              </span>
            </td>
            <td class="px-5 py-3.5 text-gray-500 font-semibold"><?php echo e($section->created_at->format('Y-m-d')); ?></td>
            <td class="px-5 py-3.5">
              <div class="flex items-center gap-2">
                <a href="<?php echo e(route('admin.sections.edit', $section)); ?>" title="تعديل" class="w-9 h-9 rounded-xl bg-blue-50 hover:bg-blue-100 flex items-center justify-center text-blue-600"><i class="fa-solid fa-pen text-xs"></i></a>
                <form method="POST" action="<?php echo e(route('admin.sections.destroy', $section)); ?>" onsubmit="return confirm('هل أنت متأكد من حذف هذا القسم؟ سيتم فصله عن العقارات دون حذفها.')">
                  <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                  <button title="حذف" class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-100 flex items-center justify-center text-red-600"><i class="fa-solid fa-trash text-xs"></i></button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="5" class="px-5 py-14 text-center">
              <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-100 flex items-center justify-center text-gray-300 text-2xl mb-3"><i class="fa-solid fa-layer-group"></i></div>
              <p class="font-black text-gray-500">لا توجد أقسام بعد</p>
              <a href="<?php echo e(route('admin.sections.create')); ?>" class="inline-block mt-3 text-sm font-bold text-brand-600 hover:underline">أضف أول قسم الآن</a>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php if($sections->hasPages()): ?>
  <div class="mt-6 flex justify-center"><?php echo e($sections->links()); ?></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\syrian-real-estate\resources\views\admin\sections\index.blade.php ENDPATH**/ ?>