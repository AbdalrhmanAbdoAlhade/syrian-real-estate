<?php
  $isEdit = isset($socialLink) && $socialLink;
  $platforms = [
    'facebook' => ['فيسبوك', 'Facebook'],
    'instagram' => ['إنستغرام', 'Instagram'],
    'x' => ['إكس', 'X'],
    'youtube' => ['يوتيوب', 'YouTube'],
    'tiktok' => ['تيك توك', 'TikTok'],
    'whatsapp' => ['واتساب', 'WhatsApp'],
    'telegram' => ['تلغرام', 'Telegram'],
    'linkedin' => ['لينكد إن', 'LinkedIn'],
    'snapchat' => ['سناب شات', 'Snapchat'],
    'website' => ['موقع إلكتروني', 'Website'],
    'other' => ['أخرى', 'Other'],
  ];
?>

<div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
  <div class="px-6 py-4 border-b bg-gray-50/60 flex items-center gap-2">
    <span class="w-8 h-8 rounded-xl bg-brand-600 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-share-nodes"></i></span>
    <h3 class="font-black">بيانات الرابط</h3>
  </div>
  <div class="p-6 grid sm:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-black mb-1.5">المنصة <span class="text-brand-600">*</span></label>
      <select name="platform" required class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['platform'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__currentLoopData = $platforms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $labels): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($value); ?>" <?php if(old('platform', $socialLink->platform ?? 'facebook') === $value): echo 'selected'; endif; ?>><?php echo e($labels[0]); ?> — <?php echo e($labels[1]); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <?php $__errorArgs = ['platform'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
      <label class="block text-sm font-black mb-1.5">الرابط <span class="text-brand-600">*</span></label>
      <input type="url" name="url" dir="ltr" required value="<?php echo e(old('url', $socialLink->url ?? '')); ?>" placeholder="https://example.com/page" class="w-full border rounded-xl px-4 py-2.5 text-sm text-left focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <p class="text-[11px] text-gray-400 font-semibold mt-1">يُقبل http أو https فقط.</p>
      <?php $__errorArgs = ['url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
      <label class="block text-sm font-black mb-1.5">العنوان بالعربية</label>
      <input type="text" name="label_ar" value="<?php echo e(old('label_ar', $socialLink->label_ar ?? '')); ?>" placeholder="مثال: صفحتنا على فيسبوك" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['label_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <?php $__errorArgs = ['label_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
      <label class="block text-sm font-black mb-1.5">العنوان بالإنجليزية</label>
      <input type="text" name="label_en" dir="ltr" value="<?php echo e(old('label_en', $socialLink->label_en ?? '')); ?>" placeholder="Our Facebook page" class="w-full border rounded-xl px-4 py-2.5 text-sm text-left focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['label_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <?php $__errorArgs = ['label_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
      <label class="block text-sm font-black mb-1.5">الترتيب</label>
      <input type="number" name="sort_order" min="0" step="1" value="<?php echo e(old('sort_order', $socialLink->sort_order ?? 0)); ?>" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="flex items-center gap-3 pt-6">
      <input type="checkbox" id="is_active" name="is_active" value="1" <?php if(old('is_active', $socialLink->is_active ?? true)): echo 'checked'; endif; ?> class="w-5 h-5 rounded border-gray-300 text-brand-600 focus:ring-brand-500">
      <label for="is_active" class="text-sm font-black cursor-pointer">مفعّل ويظهر في تذييل الموقع</label>
    </div>
  </div>
</div>
<?php /**PATH D:\syrian-real-estate\resources\views\admin\social-links\_form.blade.php ENDPATH**/ ?>