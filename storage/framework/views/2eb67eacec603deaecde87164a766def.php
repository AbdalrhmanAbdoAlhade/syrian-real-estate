<?php $__env->startSection('title', 'إعدادات الموقع'); ?>
<?php $__env->startSection('content'); ?>

<div class="mb-6">
  <h2 class="text-2xl font-black">إعدادات الموقع</h2>
  <p class="text-sm text-gray-500 font-semibold mt-1">الاسم، التواصل، سعر الصرف، والشعارات</p>
</div>

<form method="POST" action="<?php echo e(route('admin.settings.update')); ?>" enctype="multipart/form-data" class="space-y-5 max-w-3xl">
  <?php echo csrf_field(); ?>

  <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-50/60 flex items-center gap-2">
      <span class="w-8 h-8 rounded-xl bg-brand-600 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-globe"></i></span>
      <h3 class="font-black">الهوية العامة</h3>
    </div>
    <div class="p-6 grid sm:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-black mb-1.5">اسم الموقع <span class="text-brand-600">*</span></label>
        <input type="text" name="site_name" value="<?php echo e(old('site_name', $settings['site_name'])); ?>" required class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['site_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__errorArgs = ['site_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div>
        <label class="block text-sm font-black mb-1.5">الشعار الفرعي</label>
        <input type="text" name="site_tagline" value="<?php echo e(old('site_tagline', $settings['site_tagline'])); ?>" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['site_tagline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__errorArgs = ['site_tagline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div class="sm:col-span-2">
        <label class="block text-sm font-black mb-1.5">نص الترويسة (يظهر أعلى الموقع)</label>
        <input type="text" name="header_text" value="<?php echo e(old('header_text', $settings['header_text'] ?? '')); ?>" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['header_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__errorArgs = ['header_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div class="sm:col-span-2">
        <label class="block text-sm font-black mb-1.5">نص الفوتر</label>
        <textarea name="footer_text" rows="2" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('footer_text', $settings['footer_text'])); ?></textarea>
        <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div class="sm:col-span-2">
        <label class="block text-sm font-black mb-1.5">حقوق النشر</label>
        <input type="text" name="footer_copyright" value="<?php echo e(old('footer_copyright', $settings['footer_copyright'])); ?>" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['footer_copyright'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__errorArgs = ['footer_copyright'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-50/60 flex items-center gap-2">
      <span class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-phone"></i></span>
      <h3 class="font-black">التواصل والعملة</h3>
    </div>
    <div class="p-6 grid sm:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-black mb-1.5">واتساب عام</label>
        <input type="text" dir="ltr" name="whatsapp" value="<?php echo e(old('whatsapp', $settings['whatsapp'])); ?>" placeholder="+963..." class="w-full border rounded-xl px-4 py-2.5 text-sm text-left focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['whatsapp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__errorArgs = ['whatsapp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div>
        <label class="block text-sm font-black mb-1.5">هاتف عام</label>
        <input type="text" dir="ltr" name="phone" value="<?php echo e(old('phone', $settings['phone'] ?? '')); ?>" placeholder="+963..." class="w-full border rounded-xl px-4 py-2.5 text-sm text-left focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div>
        <label class="block text-sm font-black mb-1.5">هاتف افتراضي للعقارات الجديدة</label>
        <input type="text" dir="ltr" name="default_phone" value="<?php echo e(old('default_phone', $settings['default_phone'])); ?>" class="w-full border rounded-xl px-4 py-2.5 text-sm text-left focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['default_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__errorArgs = ['default_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div>
        <label class="block text-sm font-black mb-1.5">سعر الصرف (ليرة / دولار)</label>
        <input type="number" min="1" name="exchange_rate" value="<?php echo e(old('exchange_rate', $settings['exchange_rate'])); ?>" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['exchange_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__errorArgs = ['exchange_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-50/60 flex items-center gap-2">
      <span class="w-8 h-8 rounded-xl bg-brand-gold text-white flex items-center justify-center text-sm"><i class="fa-solid fa-image"></i></span>
      <h3 class="font-black">الشعار والأيقونة</h3>
    </div>
    <div class="p-6 grid sm:grid-cols-2 gap-4">
      <div class="border border-dashed rounded-2xl p-4 bg-gray-50/50">
        <label class="block text-sm font-black mb-1.5">الشعار (Logo)</label>
        <input type="file" name="logo" accept="image/*,.svg" class="w-full text-sm">
        <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php if($settings['logo']): ?><img src="<?php echo e($settings['logo']); ?>" alt="الشعار" class="mt-3 h-16 object-contain bg-white border rounded-xl px-3 py-1"><?php endif; ?>
      </div>
      <div class="border border-dashed rounded-2xl p-4 bg-gray-50/50">
        <label class="block text-sm font-black mb-1.5">أيقونة الموقع (Favicon)</label>
        <input type="file" name="favicon" accept="image/*,.ico,.svg" class="w-full text-sm">
        <?php $__errorArgs = ['favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php if($settings['favicon']): ?><img src="<?php echo e($settings['favicon']); ?>" alt="الأيقونة" class="mt-3 h-10 w-10 object-contain bg-white border rounded-xl p-1"><?php endif; ?>
      </div>
    </div>
  </div>

  <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-brand-600 hover:bg-brand-500 text-white py-3.5 rounded-2xl font-black shadow"><i class="fa-solid fa-floppy-disk"></i> حفظ الإعدادات</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\syrian-real-estate\resources\views\admin\settings\index.blade.php ENDPATH**/ ?>