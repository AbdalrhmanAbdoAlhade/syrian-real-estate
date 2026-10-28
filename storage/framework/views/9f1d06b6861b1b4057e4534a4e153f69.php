
<section class="erth-hero" dir="rtl">
<style>
.erth-hero{position:relative;overflow:hidden;background:#2b1f18;isolation:isolate}
.erth-hero-bg{position:absolute;inset:0;z-index:-2;background:url('<?php echo e(asset('images/hero-erth-alsham.jpg')); ?>') no-repeat center center/cover}
.erth-hero-bg::after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,rgba(43,31,24,.78) 0%,rgba(43,31,24,.62) 45%,rgba(43,31,24,.88) 100%)}
.erth-hero-inner{position:relative;z-index:1;max-width:72rem;margin:0 auto;padding:5.5rem 1rem 4.5rem;text-align:center}
.erth-hero-badge{display:inline-flex;align-items:center;gap:.5rem;background:rgba(192,149,79,.16);border:1px solid rgba(192,149,79,.55);color:#f7efe4;padding:.5rem 1.25rem;border-radius:999px;font-size:.875rem;font-weight:700;letter-spacing:.02em;backdrop-filter:blur(4px)}
.erth-hero-badge i{color:#c0954f}
.erth-hero-title{margin-top:1.75rem;font-weight:900;line-height:1.35}
.erth-hero-title .erth-hero-line{display:block}
.erth-hero-line-cream{color:#f7efe4;font-size:clamp(1.75rem,5.5vw,3.5rem)}
.erth-hero-line-gold{font-size:clamp(1.9rem,6vw,3.9rem);background:linear-gradient(135deg,#f0d49a 0%,#c0954f 45%,#9a7238 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent;padding-bottom:.15em}
.erth-hero-divider{display:flex;align-items:center;justify-content:center;gap:.75rem;max-width:22rem;margin:1.75rem auto 1.25rem}
.erth-hero-divider::before,.erth-hero-divider::after{content:'';flex:1;height:1px;background:linear-gradient(90deg,transparent,#c0954f)}
.erth-hero-divider::after{background:linear-gradient(90deg,#c0954f,transparent)}
.erth-hero-divider span{width:.6rem;height:.6rem;background:#c0954f;transform:rotate(45deg);box-shadow:0 0 8px rgba(192,149,79,.8)}
.erth-hero-slogan{color:#f7efe4;font-size:clamp(1.05rem,2.6vw,1.5rem);font-weight:700;letter-spacing:.03em;text-shadow:0 2px 12px rgba(0,0,0,.55)}
.erth-hero-card{margin-top:2.5rem;background:rgba(43,31,24,.72);border:1px solid rgba(192,149,79,.55);border-radius:1.25rem;padding:1.25rem;backdrop-filter:blur(8px);box-shadow:0 18px 45px rgba(0,0,0,.45)}
.erth-hero-form{display:grid;gap:.75rem;grid-template-columns:1fr}
@media (min-width:640px){.erth-hero-form{grid-template-columns:repeat(2,1fr)}}
@media (min-width:1024px){.erth-hero-form{grid-template-columns:repeat(5,1fr);align-items:end}}
.erth-hero-field{text-align:right}
.erth-hero-field label{display:block;font-size:.75rem;font-weight:700;color:#e7d6b4;margin-bottom:.35rem}
.erth-hero-field select,.erth-hero-field input{width:100%;background:rgba(247,239,228,.08);border:1px solid rgba(192,149,79,.45);color:#f7efe4;border-radius:.875rem;padding:.75rem .875rem;font-weight:600;font-family:inherit,outline:none;transition:border-color .2s,box-shadow .2s}
.erth-hero-field select:focus,.erth-hero-field input:focus{border-color:#c0954f;box-shadow:0 0 0 3px rgba(192,149,79,.25)}
.erth-hero-field select option{background:#2b1f18;color:#f7efe4}
.erth-hero-field input::placeholder{color:rgba(247,239,228,.55)}
.erth-hero-submit{width:100%;background:linear-gradient(135deg,#d8ae62,#c0954f 55%,#a97c3f);color:#2b1f18;border:none;border-radius:.875rem;padding:.85rem 1rem;font-weight:900;font-family:inherit;font-size:1rem;cursor:pointer;transition:filter .2s,transform .15s}
.erth-hero-submit:hover{filter:brightness(1.08)}
.erth-hero-submit:active{transform:translateY(1px)}
.erth-hero-actions{display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:1rem;margin-top:1.75rem}
.erth-hero-btn{display:inline-flex;align-items:center;gap:.55rem;border-radius:999px;padding:.8rem 2rem;font-weight:800;font-family:inherit;font-size:1rem;text-decoration:none;transition:all .2s}
.erth-hero-btn-gold{background:linear-gradient(135deg,#d8ae62,#c0954f 55%,#a97c3f);color:#2b1f18;box-shadow:0 10px 25px rgba(192,149,79,.35)}
.erth-hero-btn-gold:hover{filter:brightness(1.08);transform:translateY(-2px)}
.erth-hero-btn-outline{background:rgba(247,239,228,.07);border:1px solid rgba(247,239,228,.75);color:#f7efe4}
.erth-hero-btn-outline:hover{background:rgba(247,239,228,.15);transform:translateY(-2px)}
@media (max-width:639px){.erth-hero-inner{padding:4rem 1rem 3.5rem}.erth-hero-btn{padding:.7rem 1.5rem;font-size:.95rem;width:100%;justify-content:center}}
</style>

<div class="erth-hero-bg" aria-hidden="true"></div>

<div class="erth-hero-inner">
    <span class="erth-hero-badge"><i class="fa-solid fa-star"></i> منصة <?php echo e($settings['site_name'] ?? 'إرث الشام'); ?></span>

    <h1 class="erth-hero-title">
        <span class="erth-hero-line erth-hero-line-cream">ابحث عن منزلك في سوريا</span>
        <span class="erth-hero-line erth-hero-line-gold">من دمشق تبدأ الحكاية</span>
    </h1>

    <div class="erth-hero-divider" aria-hidden="true"><span></span></div>

    <p class="erth-hero-slogan">إرث أصيل، ومكان يورث</p>

    <?php
        // ضمان توفر قائمة الأقسام من قاعدة البيانات حتى لو لم تُمرَّر من الكنترولر
        if (! isset($sections)) {
            $sections = \App\Models\Section::orderBy('name_ar')->get();
        }
    ?>

    <div class="erth-hero-card">
        <form method="GET" action="<?php echo e(route('home')); ?>#properties" class="erth-hero-form">
            <div class="erth-hero-field">
                <label for="erth-hero-city">المدينة</label>
                <select id="erth-hero-city" name="city">
                    <option value="">الكل</option>
                    <?php $__currentLoopData = ['دمشق','ريف دمشق','حلب','اللاذقية','طرطوس','حمص','حماة']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($c); ?>" <?php if(request('city')==$c): echo 'selected'; endif; ?>><?php echo e($c); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="erth-hero-field">
                <label for="erth-hero-section">القسم</label>
                <select id="erth-hero-section" name="section_id">
                    <option value="">الكل</option>
                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($section->id); ?>" <?php if((string) request('section_id') === (string) $section->id): echo 'selected'; endif; ?>><?php echo e($section->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="erth-hero-field">
                <label for="erth-hero-purpose">الغرض</label>
                <select id="erth-hero-purpose" name="purpose">
                    <option value="">الكل</option>
                    <option value="بيع" <?php if(request('purpose')=='بيع'): echo 'selected'; endif; ?>>بيع</option>
                    <option value="إيجار" <?php if(request('purpose')=='إيجار'): echo 'selected'; endif; ?>>إيجار</option>
                </select>
            </div>
            <div class="erth-hero-field">
                <label for="erth-hero-max-price">أقصى سعر $</label>
                <input id="erth-hero-max-price" type="number" name="max_price" min="0" placeholder="الكل" value="<?php echo e(request('max_price')); ?>">
            </div>
            <div class="erth-hero-field">
                <button type="submit" class="erth-hero-submit"><i class="fa-solid fa-magnifying-glass"></i> بحث</button>
            </div>
        </form>
    </div>

    <div class="erth-hero-actions">
        <a href="#properties" class="erth-hero-btn erth-hero-btn-gold"><i class="fa-solid fa-building"></i> تصفح العقارات</a>
        <a href="#tourism" class="erth-hero-btn erth-hero-btn-outline"><i class="fa-solid fa-map-location-dot"></i> الدليل السياحي</a>
    </div>
</div>
</section>
<?php /**PATH D:\syrian-real-estate\resources\views\partials\hero.blade.php ENDPATH**/ ?>