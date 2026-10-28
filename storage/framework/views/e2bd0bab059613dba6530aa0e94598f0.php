<?php $__env->startSection('title', 'إدارة العقارات'); ?>
<?php $__env->startSection('content'); ?>

<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
  <div>
    <h2 class="text-2xl font-black">إدارة العقارات</h2>
    <p class="text-sm text-gray-500 font-semibold mt-1">إجمالي <?php echo e($properties->total()); ?> عقار — إنشاء وتعديل وحذف من مكان واحد</p>
  </div>
  <div class="flex flex-wrap items-center gap-2">
    <form method="GET" action="<?php echo e(route('admin.properties.index')); ?>" class="flex items-center gap-2">
      <select name="section_id" onchange="this.form.submit()" class="border rounded-xl px-3 py-2.5 text-sm font-bold bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
        <option value="">كل الأقسام</option>
        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($section->id); ?>" <?php if((string) request('section_id') === (string) $section->id): echo 'selected'; endif; ?>><?php echo e($section->name_ar); ?> — <?php echo e($section->name_en); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <?php if(request()->filled('section_id')): ?>
        <a href="<?php echo e(route('admin.properties.index')); ?>" class="text-xs font-bold text-gray-500 hover:text-brand-600 px-2">مسح</a>
      <?php endif; ?>
    </form>
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="inline-flex items-center gap-2 bg-white border px-4 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50"><i class="fa-solid fa-gauge-high text-gray-400"></i> الرئيسية</a>
    <a href="<?php echo e(route('admin.properties.create')); ?>" class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-500 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow"><i class="fa-solid fa-plus"></i> إضافة عقار</a>
  </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm min-w-[980px]">
      <thead>
        <tr class="bg-gray-950 text-white text-xs">
          <th class="px-4 py-3.5 text-right font-black">صورة</th>
          <th class="px-4 py-3.5 text-right font-black">العنوان</th>
          <th class="px-4 py-3.5 text-right font-black">المدينة</th>
          <th class="px-4 py-3.5 text-right font-black">الأقسام</th>
          <th class="px-4 py-3.5 text-right font-black">الغرض</th>
          <th class="px-4 py-3.5 text-right font-black">السعر</th>
          <th class="px-4 py-3.5 text-right font-black">الحالة</th>
          <th class="px-4 py-3.5 text-right font-black">إجراءات</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr class="border-b last:border-0 hover:bg-brand-50/50 transition">
            <td class="px-4 py-3"><img src="<?php echo e($p->image_url); ?>" alt="" loading="lazy" class="w-16 h-12 object-cover rounded-xl border shadow-sm"></td>
            <td class="px-4 py-3 font-black"><?php echo e(Str::limit($p->title, 40)); ?><span class="block text-xs text-gray-400 font-semibold"><?php echo e($p->area); ?> م² • <?php echo e($p->rooms); ?> غرف • <?php echo e($p->media->count()); ?> وسائط</span></td>
            <td class="px-4 py-3 font-semibold"><?php echo e($p->city); ?><?php if($p->district): ?><span class="block text-xs text-gray-400"><?php echo e($p->district); ?></span><?php endif; ?></td>
            <td class="px-4 py-3">
              <div class="flex flex-wrap gap-1 max-w-[180px]">
                <?php $__empty_2 = true; $__currentLoopData = $p->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                  <span class="inline-flex bg-blue-50 text-blue-700 px-2 py-1 rounded-full text-[11px] font-black"><?php echo e($section->name_ar); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                  <span class="text-gray-300 font-black">—</span>
                <?php endif; ?>
              </div>
            </td>
            <td class="px-4 py-3"><span class="px-2.5 py-1 rounded-full text-xs font-black <?php echo e($p->purpose === 'بيع' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700'); ?>"><i class="fa-solid <?php echo e($p->purpose === 'بيع' ? 'fa-tag' : 'fa-key'); ?> ml-1"></i><?php echo e($p->purpose); ?></span></td>
            <td class="px-4 py-3 font-black text-brand-600 whitespace-nowrap">$<?php echo e(number_format($p->price_usd)); ?></td>
            <td class="px-4 py-3"><span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-black <?php echo e($p->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-200 text-gray-600'); ?>"><span class="w-1.5 h-1.5 rounded-full <?php echo e($p->is_active ? 'bg-emerald-500' : 'bg-gray-400'); ?>"></span><?php echo e($p->is_active ? 'نشط' : 'مخفي'); ?></span></td>
            <td class="px-4 py-3">
              <div class="flex items-center gap-2">
                <a href="<?php echo e(route('property.show', $p)); ?>" title="معاينة" class="w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-600"><i class="fa-solid fa-eye text-xs"></i></a>
                <a href="<?php echo e(route('admin.properties.edit', $p)); ?>" title="تعديل" class="w-9 h-9 rounded-xl bg-blue-50 hover:bg-blue-100 flex items-center justify-center text-blue-600"><i class="fa-solid fa-pen text-xs"></i></a>
                <form method="POST" action="<?php echo e(route('admin.properties.destroy', $p)); ?>" onsubmit="return confirm('هل أنت متأكد من حذف هذا العقار؟')">
                  <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                  <button title="حذف" class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-100 flex items-center justify-center text-red-600"><i class="fa-solid fa-trash text-xs"></i></button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="8" class="px-4 py-14 text-center">
              <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-100 flex items-center justify-center text-gray-300 text-2xl mb-3"><i class="fa-solid fa-building"></i></div>
              <p class="font-black text-gray-500">لا توجد عقارات بعد</p>
              <a href="<?php echo e(route('admin.properties.create')); ?>" class="inline-block mt-3 text-sm font-bold text-brand-600 hover:underline">أضف أول عقار الآن</a>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php if($properties->hasPages()): ?>
  <div class="mt-6 flex justify-center"><?php echo e($properties->links()); ?></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\syrian-real-estate\resources\views\admin\properties\index.blade.php ENDPATH**/ ?>