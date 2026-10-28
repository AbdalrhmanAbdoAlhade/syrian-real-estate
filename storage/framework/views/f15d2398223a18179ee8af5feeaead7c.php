<?php
  $isEdit = isset($property) && $property;
  $sections = $sections ?? collect();
  $selectedSections = collect(old('section_ids', $isEdit ? $property->sections->pluck('id')->all() : []))
      ->map(fn ($id) => (int) $id)
      ->all();
  $mediaItems = $isEdit ? $property->media : collect();
  $imageMaxKb = (int) config('media.images.max_size_kb', 5120);
  $videoMaxKb = (int) config('media.videos.max_size_kb', 51200);
  $imageMaxCount = (int) config('media.images.max_count', 10);
  $videoMaxCount = (int) config('media.videos.max_count', 3);
?>

<div id="formErrors" class="hidden bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl shadow-sm">
  <p class="font-black text-sm mb-2"><i class="fa-solid fa-triangle-exclamation ml-1"></i> يرجى تصحيح الأخطاء التالية:</p>
  <ul id="formErrorList" class="text-sm font-semibold list-disc pr-5 space-y-1"></ul>
</div>

<input type="hidden" name="is_active" value="0">

<div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
  <div class="px-6 py-4 border-b bg-gray-50/60 flex items-center gap-2">
    <span class="w-8 h-8 rounded-xl bg-brand-600 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-circle-info"></i></span>
    <h3 class="font-black">المعلومات الأساسية</h3>
  </div>
  <div class="p-6 grid sm:grid-cols-2 gap-4">
    <div class="sm:col-span-2">
      <label class="block text-sm font-black mb-1.5">عنوان العقار <span class="text-brand-600">*</span></label>
      <input type="text" name="title" value="<?php echo e(old('title', $property->title ?? '')); ?>" required placeholder="مثال: شقة فاخرة في المزة"
        class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label class="block text-sm font-black mb-1.5">المدينة <span class="text-brand-600">*</span></label>
      <select name="city" required class="w-full border rounded-xl px-4 py-2.5 text-sm bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__currentLoopData = ['دمشق','ريف دمشق','حلب','اللاذقية','طرطوس','حمص','حماة','درعا','إدلب','دير الزور']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($c); ?>" <?php if(old('city', $property->city ?? 'دمشق') == $c): echo 'selected'; endif; ?>><?php echo e($c); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label class="block text-sm font-black mb-1.5">الحي / المنطقة</label>
      <input type="text" name="district" value="<?php echo e(old('district', $property->district ?? '')); ?>" placeholder="مثال: المزة"
        class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label class="block text-sm font-black mb-1.5">الغرض <span class="text-brand-600">*</span></label>
      <div class="grid grid-cols-2 gap-2">
        <label class="cursor-pointer">
          <input type="radio" name="purpose" value="بيع" class="peer hidden" <?php if(old('purpose', $property->purpose ?? 'بيع') === 'بيع'): echo 'checked'; endif; ?>>
          <span class="flex items-center justify-center gap-2 border rounded-xl px-4 py-2.5 text-sm font-black peer-checked:bg-amber-50 peer-checked:border-amber-400 peer-checked:text-amber-700"><i class="fa-solid fa-tag"></i> بيع</span>
        </label>
        <label class="cursor-pointer">
          <input type="radio" name="purpose" value="إيجار" class="peer hidden" <?php if(old('purpose', $property->purpose ?? '') === 'إيجار'): echo 'checked'; endif; ?>>
          <span class="flex items-center justify-center gap-2 border rounded-xl px-4 py-2.5 text-sm font-black peer-checked:bg-blue-50 peer-checked:border-blue-400 peer-checked:text-blue-700"><i class="fa-solid fa-key"></i> إيجار</span>
        </label>
      </div>
      <?php $__errorArgs = ['purpose'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label class="block text-sm font-black mb-1.5">رقم الهاتف / واتساب</label>
      <input type="text" name="phone" dir="ltr" value="<?php echo e(old('phone', $property->phone ?? $defaultPhone ?? '')); ?>" placeholder="+963..."
        class="w-full border rounded-xl px-4 py-2.5 text-sm text-left focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['phone'];
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
  </div>
</div>

<div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
  <div class="px-6 py-4 border-b bg-gray-50/60 flex items-center gap-2">
    <span class="w-8 h-8 rounded-xl bg-brand-gold text-white flex items-center justify-center text-sm"><i class="fa-solid fa-money-bill-wave"></i></span>
    <h3 class="font-black">السعر والمواصفات</h3>
  </div>
  <div class="p-6 grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <div>
      <label class="block text-sm font-black mb-1.5">السعر بالدولار <span class="text-brand-600">*</span></label>
      <input type="number" step="0.01" min="0" name="price_usd" value="<?php echo e(old('price_usd', $property->price_usd ?? '')); ?>" required placeholder="50000"
        class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['price_usd'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <?php $__errorArgs = ['price_usd'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label class="block text-sm font-black mb-1.5">المساحة (م²) <span class="text-brand-600">*</span></label>
      <input type="number" min="1" name="area" value="<?php echo e(old('area', $property->area ?? '')); ?>" required placeholder="120"
        class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <?php $__errorArgs = ['area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label class="block text-sm font-black mb-1.5">الغرف <span class="text-brand-600">*</span></label>
      <input type="number" min="1" max="20" name="rooms" value="<?php echo e(old('rooms', $property->rooms ?? 3)); ?>" required
        class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['rooms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <?php $__errorArgs = ['rooms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label class="block text-sm font-black mb-1.5">الحمامات <span class="text-brand-600">*</span></label>
      <input type="number" min="1" max="10" name="bathrooms" value="<?php echo e(old('bathrooms', $property->bathrooms ?? 2)); ?>" required
        class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['bathrooms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <?php $__errorArgs = ['bathrooms'];
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
    <span class="w-8 h-8 rounded-xl bg-blue-500 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-layer-group"></i></span>
    <h3 class="font-black">الأقسام</h3>
  </div>
  <div class="p-6 space-y-3">
    <input type="hidden" name="sections_present" value="1">
    <label class="block text-sm font-black mb-1.5">أقسام العقار <span class="text-xs text-gray-400 font-semibold">(اختياري — يمكن اختيار أكثر من قسم)</span></label>
    <select name="section_ids[]" multiple size="6"
      class="w-full border rounded-xl px-4 py-2.5 text-sm bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['section_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <?php $__empty_1 = true; $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <option value="<?php echo e($section->id); ?>" <?php if(in_array((int) $section->id, $selectedSections, true)): echo 'selected'; endif; ?>>
          <?php echo e($section->name_ar); ?> — <?php echo e($section->name_en); ?>

        </option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <option value="" disabled>لا توجد أقسام بعد</option>
      <?php endif; ?>
    </select>
    <p class="text-xs text-gray-500 font-semibold">اضغط Ctrl (أو Cmd) لاختيار أكثر من قسم. <a href="<?php echo e(route('admin.sections.index')); ?>" class="text-brand-600 hover:underline">إدارة الأقسام</a></p>
    <?php $__errorArgs = ['section_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <?php $__errorArgs = ['section_ids.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>
</div>

<div class="bg-white rounded-2xl border shadow-sm overflow-hidden"
     id="mediaManager"
     data-image-exts="<?php echo e(implode(',', config('media.images.mimes', ['jpg','jpeg','png','webp','avif']))); ?>"
     data-video-exts="<?php echo e(implode(',', config('media.videos.mimes', ['mp4','webm','mov']))); ?>"
     data-image-max-kb="<?php echo e($imageMaxKb); ?>"
     data-video-max-kb="<?php echo e($videoMaxKb); ?>"
     data-image-max-count="<?php echo e($imageMaxCount); ?>"
     data-video-max-count="<?php echo e($videoMaxCount); ?>"
     data-existing-images="<?php echo e($isEdit ? $property->images->count() : 0); ?>"
     data-existing-videos="<?php echo e($isEdit ? $property->videos->count() : 0); ?>">
  <div class="px-6 py-4 border-b bg-gray-50/60 flex items-center gap-2">
    <span class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-photo-film"></i></span>
    <h3 class="font-black">صور وفيديو العقار</h3>
  </div>
  <div class="p-6 space-y-4">
    <?php if($isEdit): ?>
      <div>
        <div class="flex items-center justify-between gap-3 mb-2">
          <p class="text-sm font-black">الوسائط الحالية <span class="text-xs text-gray-400 font-semibold">(اسحب البطاقات لإعادة الترتيب)</span></p>
          <?php if($mediaItems->isNotEmpty()): ?><span class="text-xs font-bold text-gray-400"><?php echo e($mediaItems->count()); ?> عنصر</span><?php endif; ?>
        </div>
        <div id="existingMedia" class="grid grid-cols-2 sm:grid-cols-3 gap-3" data-reorder-url="<?php echo e(route('admin.properties.media.reorder', $property)); ?>">
          <?php $__empty_1 = true; $__currentLoopData = $mediaItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-gray-50 border rounded-2xl overflow-hidden cursor-move" draggable="true" data-media-id="<?php echo e($item->id); ?>">
              <div class="relative bg-gray-900 aspect-[4/3]">
                <?php if($item->type === 'image'): ?>
                  <img src="<?php echo e($item->url); ?>" alt="" loading="lazy" class="w-full h-full object-cover">
                <?php else: ?>
                  <video src="<?php echo e($item->url); ?>" controls preload="metadata" poster="<?php echo e($property->cover_url); ?>" class="w-full h-full object-cover"></video>
                <?php endif; ?>
                <?php if($item->is_cover): ?>
                  <span class="absolute top-2 right-2 bg-brand-gold text-gray-900 text-[11px] font-black px-2 py-1 rounded-full shadow"><i class="fa-solid fa-star ml-1"></i> الغلاف</span>
                <?php endif; ?>
                <span class="absolute top-2 left-2 bg-black/60 text-white text-[11px] font-bold px-2 py-1 rounded-full">
                  <?php echo e($item->type === 'image' ? 'صورة' : 'فيديو'); ?>

                </span>
              </div>
              <div class="p-2 flex items-center gap-2">
                <?php if($item->type === 'image' && ! $item->is_cover): ?>
                  <button type="button" data-media-action="cover" data-url="<?php echo e(route('admin.properties.media.cover', [$property, $item])); ?>"
                    class="flex-1 inline-flex items-center justify-center gap-1 bg-brand-gold/20 hover:bg-brand-gold/30 text-amber-800 px-2 py-1.5 rounded-lg text-[11px] font-black">
                    <i class="fa-solid fa-star"></i> تعيين غلاف
                  </button>
                <?php endif; ?>
                <button type="button" data-media-action="delete" data-url="<?php echo e(route('admin.properties.media.destroy', [$property, $item])); ?>"
                  class="flex-1 inline-flex items-center justify-center gap-1 bg-red-50 hover:bg-red-100 text-red-600 px-2 py-1.5 rounded-lg text-[11px] font-black">
                  <i class="fa-solid fa-trash"></i> حذف
                </button>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center bg-gray-50 border border-dashed rounded-2xl px-5 py-8">
              <p class="text-sm font-bold text-gray-400">لا توجد وسائط بعد. ارفع أول صورة وسيتم تعيينها كغلاف تلقائياً.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>

    <div>
      <label class="block text-sm font-black mb-1.5">إضافة صور / فيديوهات</label>
      <input type="file" name="media[]" id="mediaInput" multiple
        accept=".jpg,.jpeg,.png,.webp,.avif,.mp4,.webm,.mov,image/jpeg,image/png,image/webp,image/avif,video/mp4,video/webm,video/quicktime"
        class="w-full border border-dashed rounded-xl px-4 py-3 text-sm bg-gray-50 focus:ring-2 focus:ring-brand-500 <?php $__errorArgs = ['media'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <?php $__errorArgs = ['media.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <p class="text-xs text-gray-500 font-semibold mt-1.5">
        الصور: jpg, jpeg, png, webp, avif — حتى <?php echo e($imageMaxKb); ?> كيلوبايت للصورة، وبحد أقصى <?php echo e($imageMaxCount); ?> صور.
        <br>الفيديو: mp4, webm, mov — حتى <?php echo e($videoMaxKb); ?> كيلوبايت للفيديو، وبحد أقصى <?php echo e($videoMaxCount); ?> فيديوهات.
        <br>أول صورة تُرفع تصبح صورة الغلاف تلقائياً، ويمكنك تغييرها لاحقاً.
      </p>
      <?php $__errorArgs = ['media'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      <?php $__errorArgs = ['media.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div id="mediaPreviewList" class="hidden grid grid-cols-2 sm:grid-cols-3 gap-3"></div>

    <div id="mediaProgress" class="hidden bg-gray-50 border rounded-2xl p-4">
      <div class="flex items-center justify-between text-xs font-black text-gray-600 mb-2">
        <span>جارٍ الرفع...</span>
        <span id="mediaProgressText">0%</span>
      </div>
      <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
        <div id="mediaProgressBar" class="h-full w-0 bg-gradient-to-l from-brand-600 to-brand-gold transition-all"></div>
      </div>
    </div>
  </div>
</div>

<div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
  <div class="px-6 py-4 border-b bg-gray-50/60 flex items-center gap-2">
    <span class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-align-right"></i></span>
    <h3 class="font-black">الوصف والحالة</h3>
  </div>
  <div class="p-6 space-y-4">
    <div>
      <label class="block text-sm font-black mb-1.5">الوصف</label>
      <textarea name="description" rows="4" placeholder="اكتب وصفاً جذاباً للعقار..."
        class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('description', $property->description ?? '')); ?></textarea>
      <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <label class="flex items-center justify-between gap-4 bg-gray-50 border rounded-2xl px-5 py-4 cursor-pointer">
      <span class="flex items-center gap-3">
        <span class="w-10 h-10 rounded-xl <?php echo e(old('is_active', $property->is_active ?? true) ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-200 text-gray-400'); ?> flex items-center justify-center"><i class="fa-solid fa-eye"></i></span>
        <span><span class="block font-black text-sm">نشط (ظاهر في الموقع)</span><span class="block text-xs text-gray-500 font-semibold">إلغاء التحديد يخفي العقار عن الزوار</span></span>
      </span>
      <input type="checkbox" name="is_active" value="1" <?php if(old('is_active', $property->is_active ?? true)): echo 'checked'; endif; ?> class="w-6 h-6 accent-[#c53030]">
    </label>
    <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-xs font-bold"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>
</div>

<script>
(function () {
  const form = document.getElementById('propertyForm');
  const manager = document.getElementById('mediaManager');
  if (!manager) return;

  const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
  const errorBox = document.getElementById('formErrors');
  const errorList = document.getElementById('formErrorList');
  const input = document.getElementById('mediaInput');
  const previewList = document.getElementById('mediaPreviewList');
  const existingList = document.getElementById('existingMedia');
  const progressWrap = document.getElementById('mediaProgress');
  const progressBar = document.getElementById('mediaProgressBar');
  const progressText = document.getElementById('mediaProgressText');

  const imageExts = (manager.dataset.imageExts || '').split(',').filter(Boolean);
  const videoExts = (manager.dataset.videoExts || '').split(',').filter(Boolean);
  const imageMaxKb = Number(manager.dataset.imageMaxKb || 5120);
  const videoMaxKb = Number(manager.dataset.videoMaxKb || 51200);
  const imageMaxCount = Number(manager.dataset.imageMaxCount || 10);
  const videoMaxCount = Number(manager.dataset.videoMaxCount || 3);
  const existingImages = Number(manager.dataset.existingImages || 0);
  const existingVideos = Number(manager.dataset.existingVideos || 0);

  let selectedFiles = [];
  let previewUrls = [];
  let dragIndex = null;

  function extensionOf(name) {
    const parts = String(name || '').toLowerCase().split('.');
    return parts.length > 1 ? parts.pop() : '';
  }

  function isVideoFile(file) {
    return videoExts.includes(extensionOf(file.name)) || String(file.type || '').startsWith('video/');
  }

  function isImageFile(file) {
    return imageExts.includes(extensionOf(file.name)) || String(file.type || '').startsWith('image/');
  }

  function showErrors(errors) {
    if (!errorBox || !errorList) return;
    const messages = [];
    Object.keys(errors || {}).forEach(function (key) {
      const value = errors[key];
      if (Array.isArray(value)) {
        value.forEach(function (message) { messages.push(message); });
      } else if (value) {
        messages.push(value);
      }
    });

    errorList.innerHTML = '';
    messages.forEach(function (message) {
      const li = document.createElement('li');
      li.textContent = message;
      errorList.appendChild(li);
    });
    errorBox.classList.toggle('hidden', messages.length === 0);
    if (messages.length) errorBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }

  function clearErrors() {
    if (errorBox) errorBox.classList.add('hidden');
    if (errorList) errorList.innerHTML = '';
  }

  function showProgress(percent) {
    if (!progressWrap || !progressBar || !progressText) return;
    progressWrap.classList.remove('hidden');
    const value = Math.max(0, Math.min(100, Math.round(percent)));
    progressBar.style.width = value + '%';
    progressText.textContent = value + '%';
  }

  function hideProgress() {
    if (!progressWrap || !progressBar || !progressText) return;
    progressWrap.classList.add('hidden');
    progressBar.style.width = '0%';
    progressText.textContent = '0%';
  }

  function syncInputFiles() {
    if (!input) return;
    const transfer = new DataTransfer();
    selectedFiles.forEach(function (file) { transfer.items.add(file); });
    input.files = transfer.files;
  }

  function clearPreviews() {
    previewUrls.forEach(function (url) { URL.revokeObjectURL(url); });
    previewUrls = [];
    if (previewList) previewList.innerHTML = '';
  }

  function renderPreviews() {
    if (!previewList) return;
    clearPreviews();

    if (selectedFiles.length === 0) {
      previewList.classList.add('hidden');
      return;
    }

    previewList.classList.remove('hidden');

    selectedFiles.forEach(function (file, index) {
      const tile = document.createElement('div');
      tile.className = 'bg-gray-50 border rounded-2xl overflow-hidden cursor-move relative';
      tile.draggable = true;
      tile.dataset.previewIndex = String(index);

      const mediaWrap = document.createElement('div');
      mediaWrap.className = 'relative bg-gray-900 aspect-[4/3]';

      const url = URL.createObjectURL(file);
      previewUrls.push(url);

      if (isVideoFile(file)) {
        const video = document.createElement('video');
        video.src = url;
        video.controls = true;
        video.preload = 'metadata';
        video.className = 'w-full h-full object-cover';
        mediaWrap.appendChild(video);
      } else {
        const img = document.createElement('img');
        img.src = url;
        img.alt = '';
        img.className = 'w-full h-full object-cover';
        mediaWrap.appendChild(img);
      }

      const typeBadge = document.createElement('span');
      typeBadge.className = 'absolute top-2 left-2 bg-black/60 text-white text-[11px] font-bold px-2 py-1 rounded-full';
      typeBadge.textContent = isVideoFile(file) ? 'فيديو جديد' : 'صورة جديدة';
      mediaWrap.appendChild(typeBadge);

      const remove = document.createElement('button');
      remove.type = 'button';
      remove.className = 'absolute top-2 right-2 w-7 h-7 rounded-full bg-red-600 text-white text-xs font-black shadow';
      remove.innerHTML = '<i class="fa-solid fa-xmark"></i>';
      remove.addEventListener('click', function () {
        selectedFiles.splice(index, 1);
        syncInputFiles();
        renderPreviews();
      });
      mediaWrap.appendChild(remove);

      tile.appendChild(mediaWrap);
      previewList.appendChild(tile);
    });

    attachPreviewDrag();
  }

  function attachPreviewDrag() {
    if (!previewList) return;
    previewList.querySelectorAll('[data-preview-index]').forEach(function (tile) {
      tile.addEventListener('dragstart', function (event) {
        dragIndex = Number(tile.dataset.previewIndex);
        event.dataTransfer.effectAllowed = 'move';
      });

      tile.addEventListener('dragover', function (event) {
        event.preventDefault();
        event.dataTransfer.dropEffect = 'move';
      });

      tile.addEventListener('drop', function (event) {
        event.preventDefault();
        const targetIndex = Number(tile.dataset.previewIndex);
        if (dragIndex === null || dragIndex === targetIndex) return;

        const moved = selectedFiles.splice(dragIndex, 1)[0];
        selectedFiles.splice(targetIndex, 0, moved);
        dragIndex = null;
        syncInputFiles();
        renderPreviews();
      });
    });
  }

  if (input) {
    input.addEventListener('change', function () {
      clearErrors();
      const candidates = Array.from(input.files || []);
      const valid = [];
      let imageCount = existingImages;
      let videoCount = existingVideos;
      const messages = [];

      candidates.forEach(function (file) {
        if (isVideoFile(file)) {
          if (!videoExts.includes(extensionOf(file.name))) {
            messages.push('صيغة الفيديو غير مدعومة: ' + file.name);
            return;
          }
          if (file.size > videoMaxKb * 1024) {
            messages.push('حجم الفيديو يتجاوز الحد المسموح: ' + file.name);
            return;
          }
          videoCount++;
          if (videoCount > videoMaxCount) {
            messages.push('تجاوزت الحد الأقصى لعدد الفيديوهات (' + videoMaxCount + ').');
            return;
          }
          valid.push(file);
          return;
        }

        if (!isImageFile(file)) {
          messages.push('نوع الملف غير مدعوم: ' + file.name);
          return;
        }

        if (!imageExts.includes(extensionOf(file.name))) {
          messages.push('صيغة الصورة غير مدعومة: ' + file.name);
          return;
        }

        if (file.size > imageMaxKb * 1024) {
          messages.push('حجم الصورة يتجاوز الحد المسموح: ' + file.name);
          return;
        }

        imageCount++;
        if (imageCount > imageMaxCount) {
          messages.push('تجاوزت الحد الأقصى لعدد الصور (' + imageMaxCount + ').');
          return;
        }

        valid.push(file);
      });

      selectedFiles = valid;
      syncInputFiles();
      renderPreviews();

      if (messages.length) {
        showErrors({ media: messages });
      }
    });
  }

  if (existingList) {
    let draggedItem = null;

    existingList.querySelectorAll('[data-media-id]').forEach(function (item) {
      item.addEventListener('dragstart', function (event) {
        draggedItem = item;
        item.classList.add('opacity-50');
        event.dataTransfer.effectAllowed = 'move';
      });

      item.addEventListener('dragend', function () {
        item.classList.remove('opacity-50');
        draggedItem = null;
      });

      item.addEventListener('dragover', function (event) {
        event.preventDefault();
        if (!draggedItem || draggedItem === item) return;
        const rect = item.getBoundingClientRect();
        const after = (event.clientY - rect.top) > (rect.height / 2);
        existingList.insertBefore(draggedItem, after ? item.nextSibling : item);
      });
    });

    existingList.addEventListener('drop', function (event) {
      event.preventDefault();
      const url = existingList.dataset.reorderUrl;
      if (!url) return;

      const order = Array.from(existingList.querySelectorAll('[data-media-id]')).map(function (item) {
        return Number(item.dataset.mediaId);
      });

      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrf,
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ order: order })
      }).then(function (response) {
        if (!response.ok) throw new Error('reorder');
        window.location.reload();
      }).catch(function () {
        showErrors({ media: ['تعذر تحديث ترتيب الوسائط. أعد تحميل الصفحة وحاول مرة أخرى.'] });
      });
    });
  }

  if (manager) {
    manager.addEventListener('click', function (event) {
      const button = event.target.closest('[data-media-action]');
      if (!button) return;

      event.preventDefault();
      const action = button.dataset.mediaAction;
      const url = button.dataset.url;

      if (!url) return;

      if (action === 'delete' && !window.confirm('هل تريد حذف هذا الوسيط نهائياً؟')) {
        return;
      }

      clearErrors();
      button.disabled = true;

      fetch(url, {
        method: action === 'delete' ? 'DELETE' : 'PATCH',
        headers: {
          'X-CSRF-TOKEN': csrf,
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        }
      }).then(function (response) {
        return response.json().catch(function () { return {}; }).then(function (data) {
          if (!response.ok) {
            if (response.status === 422 && data.errors) {
              showErrors(data.errors);
            } else {
              showErrors({ media: [data.message || 'تعذر تنفيذ العملية.'] });
            }
            button.disabled = false;
            return;
          }
          window.location.reload();
        });
      }).catch(function () {
        button.disabled = false;
        showErrors({ media: ['تعذر الاتصال بالخادم.'] });
      });
    });
  }

  if (form) {
    form.addEventListener('submit', function (event) {
      if (!window.XMLHttpRequest || !window.FormData) return;

      event.preventDefault();
      clearErrors();

      const xhr = new XMLHttpRequest();
      xhr.open('POST', form.action, true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.setRequestHeader('Accept', 'application/json');
      xhr.setRequestHeader('X-CSRF-TOKEN', csrf);

      xhr.upload.addEventListener('progress', function (e) {
        if (e.lengthComputable) showProgress((e.loaded / e.total) * 100);
      });

      xhr.onload = function () {
        let data = {};
        try { data = JSON.parse(xhr.responseText || '{}'); } catch (e) { data = {}; }
        hideProgress();

        if (xhr.status >= 200 && xhr.status < 300) {
          if (data.redirect) {
            window.location.href = data.redirect;
          } else {
            window.location.reload();
          }
          return;
        }

        if (xhr.status === 422 && data.errors) {
          showErrors(data.errors);
        } else {
          showErrors({ general: [data.message || 'تعذر حفظ العقار. حاول مرة أخرى.'] });
        }
      };

      xhr.onerror = function () {
        hideProgress();
        showErrors({ general: ['تعذر الاتصال بالخادم.'] });
      };

      xhr.send(new FormData(form));
    });
  }
})();
</script>
<?php /**PATH D:\syrian-real-estate\resources\views\admin\properties\_form.blade.php ENDPATH**/ ?>