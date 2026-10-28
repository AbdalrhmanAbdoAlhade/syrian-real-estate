<?php $__env->startSection('title', 'تعديل قسم'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-6">
  <div>
    <h2 class="text-2xl font-black">تعديل القسم</h2>
    <p class="text-sm text-gray-500 font-semibold mt-1"><?php echo e($section->name_ar); ?> — <?php echo e($section->name_en); ?></p>
  </div>
  <a href="<?php echo e(route('admin.sections.index')); ?>" class="inline-flex items-center gap-2 bg-white border px-4 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50"><i class="fa-solid fa-arrow-right text-gray-400"></i> رجوع</a>
</div>
<form method="POST" action="<?php echo e(route('admin.sections.update', $section)); ?>" class="space-y-5 max-w-2xl">
  <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
  <?php echo $__env->make('admin.sections._form', ['section' => $section], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-gray-950 hover:bg-gray-800 text-white py-3.5 rounded-2xl font-black shadow"><i class="fa-solid fa-pen-to-square"></i> تحديث القسم</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\syrian-real-estate\resources\views\admin\sections\edit.blade.php ENDPATH**/ ?>