<?php $__env->startSection('title', 'إضافة عقار'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-6">
  <div>
    <h2 class="text-2xl font-black">إضافة عقار جديد</h2>
    <p class="text-sm text-gray-500 font-semibold mt-1">املأ البيانات التالية وسيظهر العقار في الموقع فوراً</p>
  </div>
  <a href="<?php echo e(route('admin.properties.index')); ?>" class="inline-flex items-center gap-2 bg-white border px-4 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50"><i class="fa-solid fa-arrow-right text-gray-400"></i> رجوع</a>
</div>
<form id="propertyForm" data-ajax-form method="POST" action="<?php echo e(route('admin.properties.store')); ?>" enctype="multipart/form-data" class="space-y-5 max-w-3xl">
  <?php echo csrf_field(); ?>
  <?php echo $__env->make('admin.properties._form', ['property' => null, 'defaultPhone' => $defaultPhone ?? '', 'sections' => $sections ?? collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-brand-600 hover:bg-brand-500 text-white py-3.5 rounded-2xl font-black shadow"><i class="fa-solid fa-floppy-disk"></i> حفظ العقار</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\syrian-real-estate\resources\views\admin\properties\create.blade.php ENDPATH**/ ?>