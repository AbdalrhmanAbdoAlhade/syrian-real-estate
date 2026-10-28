<?php $__env->startSection('title', ($settings['site_name'] ?? 'إرث الشام').' - العقارات'); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.hero', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<section id="properties" class="max-w-7xl mx-auto px-4 py-20">
<div class="flex flex-wrap items-end justify-between gap-4 mb-6">
  <div>
    <span class="block text-sm font-black text-brand-500 mb-1">منصتنا</span>
    <h2 class="text-3xl font-black text-[#2b1f18]">شقق وفلل للبيع والإيجار</h2>
  </div>
  <?php if(request()->filled('section_id')): ?>
    <a href="<?php echo e(route('home')); ?>#properties" class="text-sm font-bold text-brand-600 hover:text-brand-500 underline"><i class="fa-solid fa-xmark ml-1"></i> مسح فلتر القسم</a>
  <?php endif; ?>
</div>

<?php if($sections->isNotEmpty()): ?>
<div id="sections" class="flex flex-wrap gap-2 mb-8">
  <a href="<?php echo e(route('home')); ?>#properties" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-black border <?php echo e(!request()->filled('section_id') ? 'bg-brand-600 text-[#f7efe4] border-brand-600' : 'bg-white text-[#5b4636] border-[#e3d5be] hover:border-brand-500 hover:text-brand-600'); ?>">
    كل الأقسام
  </a>
  <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('home', ['section_id' => $section->id])); ?>#properties" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-black border <?php echo e((string) request('section_id') === (string) $section->id ? 'bg-brand-600 text-[#f7efe4] border-brand-600' : 'bg-white text-[#5b4636] border-[#e3d5be] hover:border-brand-500 hover:text-brand-600'); ?>">
      <?php echo e($section->name); ?>

      <span class="text-[11px] px-2 py-0.5 rounded-full <?php echo e((string) request('section_id') === (string) $section->id ? 'bg-white/20' : 'bg-brand-100 text-brand-700'); ?>"><?php echo e($section->properties_count); ?></span>
    </a>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>

<?php if($properties->isEmpty()): ?>
<div class="text-center py-16 bg-white rounded-3xl border border-dashed border-[#e3d5be]"><p class="text-[#7a6a56]">لا توجد نتائج</p>
<a href="<?php echo e(route('home')); ?>" class="mt-4 inline-block bg-brand-600 text-[#f7efe4] px-6 py-2 rounded-xl hover:bg-brand-500">إلغاء الفلترة</a></div>
<?php else: ?>
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
<?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl border border-[#ece1d0] group">
<div class="relative h-60 overflow-hidden">
<img src="<?php echo e($prop->cover_url); ?>" loading="lazy" alt="<?php echo e($prop->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
<span class="absolute top-4 right-4 <?php echo e($prop->purpose==='بيع'?'bg-brand-600 text-[#f7efe4]':'bg-brand-gold text-[#2b1f18]'); ?> px-3 py-1 rounded-full text-xs font-black"><?php echo e($prop->purpose==='بيع'?'للبيع':'للإيجار'); ?></span>
<span class="absolute bottom-4 right-4 bg-[#2b1f18]/85 text-[#f7efe4] px-3 py-1.5 rounded-xl text-xs"><i class="fa-solid fa-location-dot text-brand-gold"></i> <?php echo e($prop->city); ?></span>
<?php if($prop->media->where('type', 'video')->isNotEmpty()): ?>
<span class="absolute bottom-4 left-4 bg-[#2b1f18]/85 text-[#f7efe4] px-2.5 py-1.5 rounded-xl text-xs font-bold"><i class="fa-solid fa-video"></i> فيديو</span>
<?php endif; ?>
</div>
<div class="p-6">
<?php if($prop->sections->isNotEmpty()): ?>
<div class="flex flex-wrap gap-1.5 mb-3">
  <?php $__currentLoopData = $prop->sections->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('home', ['section_id' => $section->id])); ?>#properties" class="bg-brand-100 text-brand-700 px-2.5 py-1 rounded-full text-[11px] font-black hover:bg-brand-500 hover:text-[#2b1f18]"><?php echo e($section->name); ?></a>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
<h3 class="text-xl font-black text-[#2b1f18] mb-2"><?php echo e($prop->title); ?></h3>
<p class="text-[#7a6a56] text-sm mb-4"><?php echo e(Str::limit($prop->description,80)); ?></p>
<div class="grid grid-cols-3 gap-2 py-3 border-y border-[#ece1d0] text-xs font-bold text-center text-[#7a6a56] mb-4">
<div><?php echo e($prop->area); ?> م²</div><div><?php echo e($prop->rooms); ?> غرف</div><div><?php echo e($prop->bathrooms); ?> حمام</div>
</div>
<div class="flex justify-between items-center">
<span class="text-xl font-black text-brand-600">$<?php echo e(number_format($prop->price_usd)); ?></span>
<a href="<?php echo e(route('property.show',$prop)); ?>" class="bg-brand-600 hover:bg-brand-500 text-[#f7efe4] px-4 py-2 rounded-xl text-sm font-bold">التفاصيل</a>
</div></div></div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
</section>

<section id="tourism" class="tourism-bg text-[#f7efe4] py-24 px-4">
<div class="max-w-7xl mx-auto text-center mb-12">
<span class="bg-brand-gold text-[#2b1f18] font-black px-4 py-1.5 rounded-full text-xs">المغربين والسياحة</span>
<h2 class="text-3xl font-black text-[#f7efe4] mt-4">دليلك لاستكشاف سورية</h2>
</div>
<div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-8">
<div class="bg-[#2b1f18]/45 backdrop-blur rounded-3xl p-6 border border-brand-gold/35"><h3 class="text-xl font-black text-brand-gold mb-2">معالم سياحية</h3><p class="text-sm text-[#e7dcc9]">دمشق القديمة، قلعة حلب، شواطئ اللاذقية</p></div>
<div class="bg-[#2b1f18]/45 backdrop-blur rounded-3xl p-6 border border-brand-gold/35"><h3 class="text-xl font-black text-brand-gold mb-2">شراء قانوني</h3><p class="text-sm text-[#e7dcc9]">توكيل، طابو، تحويل أموال بأمان</p></div>
<div class="bg-[#2b1f18]/45 backdrop-blur rounded-3xl p-6 border border-brand-gold/35"><h3 class="text-xl font-black text-brand-gold mb-2">ضيافة</h3><p class="text-sm text-[#e7dcc9]">استقبال مطار، سيارات، شقق مفروشة</p></div>
</div></section>

<?php echo $__env->make('partials.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<section id="contact" class="bg-[#2b1f18] text-[#f7efe4] py-20 px-4 text-center">
<span class="block text-sm font-black text-brand-gold mb-2">ابقَ على تواصل</span>
<h2 class="text-3xl font-black mb-6">تواصل معنا</h2>
<div class="flex flex-wrap items-center justify-center gap-4">
<?php if(!empty($settings['whatsapp'])): ?>
<a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/','',$settings['whatsapp'])); ?>" class="inline-flex items-center gap-3 bg-brand-gold text-[#2b1f18] hover:brightness-105 px-8 py-4 rounded-2xl font-black"><i class="fa-brands fa-whatsapp text-2xl"></i> واتساب</a>
<?php endif; ?>
<?php if(!empty($settings['phone'])): ?>
<a href="tel:<?php echo e($settings['phone']); ?>" class="inline-flex items-center gap-3 border border-brand-gold/50 text-[#f7efe4] hover:bg-brand-gold/15 px-8 py-4 rounded-2xl font-bold"><i class="fa-solid fa-phone text-brand-gold"></i> اتصال هاتفي</a>
<?php endif; ?>
</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\syrian-real-estate\resources\views\home.blade.php ENDPATH**/ ?>