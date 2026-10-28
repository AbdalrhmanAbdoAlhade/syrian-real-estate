
<style>
.erth-p-sec{padding:5rem 1rem}
.erth-p-wrap{max-width:72rem;margin:0 auto}
.erth-p-head{text-align:center;max-width:48rem;margin:0 auto 3.5rem}
.erth-p-kicker{display:inline-flex;align-items:center;gap:.5rem;font-size:.8rem;font-weight:900;letter-spacing:.06em;text-transform:uppercase;color:#c0954f;margin-bottom:.9rem}
.erth-p-kicker::before,.erth-p-kicker::after{content:'';width:2rem;height:1px;background:linear-gradient(90deg,transparent,#c0954f)}
.erth-p-kicker::after{background:linear-gradient(90deg,#c0954f,transparent)}
.erth-p-title{font-size:clamp(1.6rem,4vw,2.5rem);font-weight:900;line-height:1.4}
.erth-p-sub{margin-top:.9rem;font-size:1rem;line-height:1.9;opacity:.85}
/* من نحن */
.erth-p-about{background:#f7efe4}
.erth-p-about .erth-p-title{color:#2b1f18}
.erth-p-about .erth-p-sub{color:#5a4636}
.erth-p-grid2{display:grid;gap:1.5rem;grid-template-columns:1fr}
@media (min-width:900px){.erth-p-grid2{grid-template-columns:1fr 1fr}}
.erth-p-card{background:#fff;border:1px solid rgba(192,149,79,.35);border-radius:1.5rem;padding:2rem;box-shadow:0 10px 30px rgba(43,31,24,.06)}
.erth-p-card h3{font-size:1.15rem;font-weight:900;color:#2b1f18;margin-bottom:.75rem;display:flex;align-items:center;gap:.6rem}
.erth-p-card h3 i{color:#c0954f}
.erth-p-card p{color:#5a4636;line-height:2;font-size:.98rem}
.erth-p-vision-banner{margin-top:2rem;background:linear-gradient(135deg,#2b1f18,#3d2c1f);border:1px solid rgba(192,149,79,.5);border-radius:1.5rem;padding:2rem;text-align:center}
.erth-p-vision-banner .erth-p-tag{display:inline-block;background:rgba(192,149,79,.18);border:1px solid rgba(192,149,79,.55);color:#f7efe4;border-radius:999px;padding:.5rem 1.4rem;font-weight:800;font-size:.95rem;margin-bottom:1rem}
.erth-p-vision-banner strong{display:block;color:#c0954f;font-size:1.35rem;font-weight:900;letter-spacing:.02em}
.erth-p-vision-banner span{display:block;color:#f7efe4;opacity:.8;font-size:.9rem;margin-top:.5rem}
/* الرؤية والرسالة والقيم - بني داكن */
.erth-p-vrm{background:#2b1f18}
.erth-p-vrm .erth-p-title{color:#f7efe4}
.erth-p-vrm .erth-p-sub{color:#d9c9ad}
.erth-p-grid3{display:grid;gap:1.5rem;grid-template-columns:1fr}
@media (min-width:760px){.erth-p-grid3{grid-template-columns:repeat(3,1fr)}}
.erth-p-darkcard{background:rgba(247,239,228,.05);border:1px solid rgba(192,149,79,.4);border-radius:1.5rem;padding:2rem;transition:transform .25s,box-shadow .25s}
.erth-p-darkcard:hover{transform:translateY(-6px);box-shadow:0 18px 40px rgba(0,0,0,.35)}
.erth-p-darkcard .erth-p-icon{width:3.25rem;height:3.25rem;border-radius:.9rem;background:linear-gradient(135deg,#d8ae62,#c0954f);color:#2b1f18;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:1.25rem}
.erth-p-darkcard h3{color:#f7efe4;font-size:1.3rem;font-weight:900;margin-bottom:.75rem}
.erth-p-darkcard p{color:#d9c9ad;line-height:2;font-size:.97rem}
.erth-p-values{display:flex;flex-wrap:wrap;gap:.6rem;margin-top:1rem}
.erth-p-values li{list-style:none;background:rgba(192,149,79,.16);border:1px solid rgba(192,149,79,.45);color:#f7efe4;border-radius:999px;padding:.4rem 1rem;font-size:.85rem;font-weight:700}
/* الخدمات */
.erth-p-services{background:#f7efe4}
.erth-p-services .erth-p-title{color:#2b1f18}
.erth-p-services .erth-p-sub{color:#5a4636}
.erth-p-grid-serv{display:grid;gap:1.25rem;grid-template-columns:1fr}
@media (min-width:640px){.erth-p-grid-serv{grid-template-columns:repeat(2,1fr)}}
@media (min-width:1000px){.erth-p-grid-serv{grid-template-columns:repeat(3,1fr)}}
.erth-p-serv{background:#fff;border:1px solid rgba(192,149,79,.3);border-top:3px solid #c0954f;border-radius:1.25rem;padding:1.75rem;transition:transform .25s,box-shadow .25s}
.erth-p-serv:hover{transform:translateY(-5px);box-shadow:0 16px 34px rgba(43,31,24,.1)}
.erth-p-serv .erth-p-num{font-size:.8rem;font-weight:900;color:#c0954f;letter-spacing:.05em}
.erth-p-serv h3{color:#2b1f18;font-size:1.12rem;font-weight:900;margin:.5rem 0 .6rem}
.erth-p-serv p{color:#5a4636;line-height:1.95;font-size:.94rem}
/* خطوات (آلية العمل) */
.erth-p-steps{background:#fff}
.erth-p-steps .erth-p-title{color:#2b1f18}
.erth-p-steps .erth-p-sub{color:#5a4636}
.erth-p-steplist{display:grid;gap:1.25rem;grid-template-columns:1fr}
@media (min-width:640px){.erth-p-steplist{grid-template-columns:repeat(2,1fr)}}
@media (min-width:1000px){.erth-p-steplist{grid-template-columns:repeat(4,1fr)}}
.erth-p-step{position:relative;background:#f7efe4;border:1px solid rgba(192,149,79,.35);border-radius:1.25rem;padding:1.75rem 1.5rem}
.erth-p-step .erth-p-dot{width:2.75rem;height:2.75rem;border-radius:50%;background:#2b1f18;color:#c0954f;display:flex;align-items:center;justify-content:center;font-weight:900;font-size:1.1rem;margin-bottom:1rem;border:2px solid #c0954f}
.erth-p-step h3{color:#2b1f18;font-size:1.05rem;font-weight:900;margin-bottom:.5rem}
.erth-p-step p{color:#5a4636;line-height:1.9;font-size:.92rem}
/* لماذا إرث الشام */
.erth-p-why{background:#2b1f18}
.erth-p-why .erth-p-title{color:#f7efe4}
.erth-p-why .erth-p-sub{color:#d9c9ad}
.erth-p-whylist{display:grid;gap:1.25rem;grid-template-columns:1fr}
@media (min-width:760px){.erth-p-whylist{grid-template-columns:repeat(2,1fr)}}
@media (min-width:1050px){.erth-p-whylist{grid-template-columns:repeat(3,1fr)}}
.erth-p-why-item{display:flex;gap:1rem;background:rgba(247,239,228,.05);border:1px solid rgba(192,149,79,.35);border-radius:1.25rem;padding:1.5rem}
.erth-p-why-item i{color:#c0954f;font-size:1.3rem;margin-top:.25rem;flex-shrink:0}
.erth-p-why-item h3{color:#f7efe4;font-size:1.05rem;font-weight:900;margin-bottom:.4rem}
.erth-p-why-item p{color:#d9c9ad;line-height:1.9;font-size:.92rem}
/* عملاؤنا */
.erth-p-clients{background:#f7efe4}
.erth-p-clients .erth-p-title{color:#2b1f18}
.erth-p-clients .erth-p-sub{color:#5a4636}
.erth-p-clientgrid{display:grid;gap:1.25rem;grid-template-columns:repeat(2,1fr)}
@media (min-width:900px){.erth-p-clientgrid{grid-template-columns:repeat(5,1fr)}}
.erth-p-client{background:#fff;border:1px solid rgba(192,149,79,.3);border-radius:1.25rem;padding:1.5rem 1.25rem;text-align:center;transition:transform .25s,border-color .25s}
.erth-p-client:hover{transform:translateY(-5px);border-color:#c0954f}
.erth-p-client i{color:#c0954f;font-size:1.7rem;margin-bottom:.85rem}
.erth-p-client h3{color:#2b1f18;font-size:1.02rem;font-weight:900;margin-bottom:.5rem}
.erth-p-client p{color:#5a4636;line-height:1.8;font-size:.86rem}
/* الشعارات */
.erth-p-taglines{background:linear-gradient(135deg,#2b1f18 0%,#3d2c1f 100%);border-top:1px solid rgba(192,149,79,.3);border-bottom:1px solid rgba(192,149,79,.3)}
.erth-p-taggrid{display:grid;gap:1.25rem;grid-template-columns:1fr}
@media (min-width:700px){.erth-p-taggrid{grid-template-columns:repeat(2,1fr)}}
@media (min-width:1050px){.erth-p-taggrid{grid-template-columns:repeat(4,1fr)}}
.erth-p-tagitem{background:rgba(247,239,228,.05);border:1px solid rgba(192,149,79,.4);border-radius:1.25rem;padding:1.75rem 1.5rem;text-align:center}
.erth-p-tagitem .erth-p-taglabel{display:block;color:#c0954f;font-size:.8rem;font-weight:900;letter-spacing:.06em;margin-bottom:.7rem}
.erth-p-tagitem p{color:#f7efe4;font-size:1.1rem;font-weight:800;line-height:1.7}
</style>


<section id="about" class="erth-p-sec erth-p-about">
  <div class="erth-p-wrap">
    <div class="erth-p-head">
      <span class="erth-p-kicker">من نحن</span>
      <h2 class="erth-p-title">إرث الشام للعقارات والتطوير</h2>
      <p class="erth-p-sub">ERTH AL SHAM — REAL ESTATE &amp; DEVELOPMENT</p>
    </div>
    <div class="erth-p-grid2">
      <div class="erth-p-card">
        <h3><i class="fa-solid fa-building-columns"></i> من نحن</h3>
        <p>إرث الشام شركة متخصصة في الخدمات العقارية والتطوير، تقدم حلولاً متكاملة في بيع وشراء الأراضي والعقارات، وتأجير الوحدات المفروشة وغير المفروشة، إضافة إلى أعمال الإكساء والتشطيب والتسليم الجاهز.</p>
      </div>
      <div class="erth-p-card">
        <h3><i class="fa-solid fa-handshake-angle"></i> ما نؤمن به</h3>
        <p>نحن نؤمن أن نجاح الصفقة العقارية لا ينتهي عند توقيع العقد، بل يبدأ من وضوح التفاصيل، ودقة التنفيذ، والالتزام بما تم الاتفاق عليه مع العميل حتى استلامه النتيجة النهائية.</p>
      </div>
    </div>
    <div class="erth-p-vision-banner">
      <span class="erth-p-tag"><i class="fa-solid fa-star"></i> رؤيتنا في الخدمة</span>
      <strong>عقار موثوق - تنفيذ منضبط - تجربة واضحة</strong>
      <span>(من أول استشارة حتى التسليم النهائي)</span>
    </div>
  </div>
</section>


<section id="vision" class="erth-p-sec erth-p-vrm">
  <div class="erth-p-wrap">
    <div class="erth-p-head">
      <span class="erth-p-kicker">رؤيتنا</span>
      <h2 class="erth-p-title">الرؤية والرسالة والقيم</h2>
    </div>
    <div class="erth-p-grid3">
      <div class="erth-p-darkcard">
        <div class="erth-p-icon"><i class="fa-solid fa-eye"></i></div>
        <h3>الرؤية</h3>
        <p>أن تكون إرث الشام من العلامات العقارية الموثوقة والراقية في السوق السوري، وأن تبني سمعة طويلة الأمد تقوم على جودة الخدمة ووضوح التعامل.</p>
      </div>
      <div class="erth-p-darkcard">
        <div class="erth-p-icon"><i class="fa-solid fa-bullseye"></i></div>
        <h3>الرسالة</h3>
        <p>تقديم خدمات عقارية متكاملة تجمع بين الوساطة العقارية، إدارة التأجير، الاستثمار في الأراضي والعقارات، والإكساء والتسليم الجاهز.</p>
      </div>
      <div class="erth-p-darkcard">
        <div class="erth-p-icon"><i class="fa-solid fa-gem"></i></div>
        <h3>القيم</h3>
        <p>الأسس التي نعمل بها في كل تفاصيل تعاملنا مع عملائنا:</p>
        <ul class="erth-p-values">
          <li>الثقة</li><li>الأمانة</li><li>الالتزام</li><li>الجودة</li><li>الخصوصية</li><li>الدقة</li><li>احترام الوقت والميزانية</li>
        </ul>
      </div>
    </div>
  </div>
</section>


<section id="services" class="erth-p-sec erth-p-services">
  <div class="erth-p-wrap">
    <div class="erth-p-head">
      <span class="erth-p-kicker">خدماتنا</span>
      <h2 class="erth-p-title">حلول عقارية متكاملة</h2>
      <p class="erth-p-sub">من بيع وشراء العقارات إلى الإكساء والتسليم الجاهز.</p>
    </div>
    <div class="erth-p-grid-serv">
      <div class="erth-p-serv"><span class="erth-p-num">01</span><h3>بيع وشراء العقارات</h3><p>تسويق وبيع وشراء الفلل والشقق والمباني والعقارات الاستثمارية.</p></div>
      <div class="erth-p-serv"><span class="erth-p-num">02</span><h3>الأراضي والاستثمار</h3><p>البحث عن الأراضي والفرص العقارية المناسبة حسب الموقع والهدف الاستثماري.</p></div>
      <div class="erth-p-serv"><span class="erth-p-num">03</span><h3>التأجير</h3><p>إدارة وتسويق وتأجير الوحدات السكنية المفروشة وغير المفروشة.</p></div>
      <div class="erth-p-serv"><span class="erth-p-num">04</span><h3>الإكساء والتشطيب</h3><p>تنفيذ أعمال التشطيب عبر مقاولين متخصصين وفق مواصفات وعقود واضحة.</p></div>
      <div class="erth-p-serv"><span class="erth-p-num">05</span><h3>التسليم الجاهز</h3><p>تنسيق مراحل العمل حتى الوصول إلى عقار جاهز للاستخدام أو السكن.</p></div>
      <div class="erth-p-serv"><span class="erth-p-num">06</span><h3>إدارة تجربة العميل</h3><p>متابعة التفاصيل والتنسيق والتقارير ومراحل التسليم بصورة واضحة.</p></div>
    </div>
  </div>
</section>


<section id="process" class="erth-p-sec erth-p-steps">
  <div class="erth-p-wrap">
    <div class="erth-p-head">
      <span class="erth-p-kicker">آلية العمل</span>
      <h2 class="erth-p-title">كيف نعمل معك</h2>
      <p class="erth-p-sub">من أول استشارة حتى اعتماد النتيجة النهائية.</p>
    </div>
    <div class="erth-p-steplist">
      <div class="erth-p-step"><div class="erth-p-dot">1</div><h3>الاستشارة</h3><p>فهم هدف العميل واحتياجاته.</p></div>
      <div class="erth-p-step"><div class="erth-p-dot">2</div><h3>اختيار العقار</h3><p>اقتراح الخيارات المناسبة.</p></div>
      <div class="erth-p-step"><div class="erth-p-dot">3</div><h3>المعاينة</h3><p>زيارة العقار وتقييمه.</p></div>
      <div class="erth-p-step"><div class="erth-p-dot">4</div><h3>الاتفاق</h3><p>توضيح الشروط والتفاصيل.</p></div>
      <div class="erth-p-step"><div class="erth-p-dot">5</div><h3>التنفيذ</h3><p>في مشاريع الإكساء، يبدأ التنفيذ وفق العقد.</p></div>
      <div class="erth-p-step"><div class="erth-p-dot">6</div><h3>المراجعة</h3><p>فحص الأعمال ومطابقتها.</p></div>
      <div class="erth-p-step"><div class="erth-p-dot">7</div><h3>التسليم</h3><p>اعتماد النتيجة النهائية وفق نطاق العمل.</p></div>
    </div>
  </div>
</section>


<section id="why" class="erth-p-sec erth-p-why">
  <div class="erth-p-wrap">
    <div class="erth-p-head">
      <span class="erth-p-kicker">لماذا نحن</span>
      <h2 class="erth-p-title">لماذا إرث الشام؟</h2>
    </div>
    <div class="erth-p-whylist">
      <div class="erth-p-why-item"><i class="fa-solid fa-fingerprint"></i><div><h3>هوية واضحة</h3><p>علامة عقارية ذات حضور احترافي ومميز.</p></div></div>
      <div class="erth-p-why-item"><i class="fa-solid fa-layer-group"></i><div><h3>خدمات متكاملة</h3><p>من البيع والتأجير إلى الإكساء والتسليم.</p></div></div>
      <div class="erth-p-why-item"><i class="fa-solid fa-file-signature"></i><div><h3>عقود ومواصفات</h3><p>خصوصاً في أعمال التشطيب، تكون المتطلبات محددة قبل التنفيذ.</p></div></div>
      <div class="erth-p-why-item"><i class="fa-solid fa-clipboard-check"></i><div><h3>متابعة واستلام</h3><p>مراجعة الأعمال قبل اعتماد استلامها.</p></div></div>
      <div class="erth-p-why-item"><i class="fa-solid fa-magnifying-glass-plus"></i><div><h3>اهتمام بالتفاصيل</h3><p>لأن قيمة العقار تظهر في التفاصيل الصغيرة قبل الكبيرة.</p></div></div>
    </div>
  </div>
</section>


<section id="clients" class="erth-p-sec erth-p-clients">
  <div class="erth-p-wrap">
    <div class="erth-p-head">
      <span class="erth-p-kicker">عملاؤنا</span>
      <h2 class="erth-p-title">من نخدم</h2>
    </div>
    <div class="erth-p-clientgrid">
      <div class="erth-p-client"><i class="fa-solid fa-house-user"></i><h3>الملاك</h3><p>أصحاب العقارات الراغبون في البيع أو التأجير أو التطوير.</p></div>
      <div class="erth-p-client"><i class="fa-solid fa-family"></i><h3>المشترون</h3><p>الأفراد والعائلات الباحثون عن سكن مناسب.</p></div>
      <div class="erth-p-client"><i class="fa-solid fa-chart-line"></i><h3>المستثمرون</h3><p>الباحثون عن الأراضي والعقارات ذات الفرص الاستثمارية.</p></div>
      <div class="erth-p-client"><i class="fa-solid fa-person-digging"></i><h3>أصحاب المشاريع</h3><p>من يحتاجون إلى تجهيز أو تشطيب عقار بصورة متكاملة.</p></div>
      <div class="erth-p-client"><i class="fa-solid fa-building"></i><h3>الشركات</h3><p>المكاتب والشركات التي تبحث عن عقارات أو حلول تجهيز.</p></div>
    </div>
  </div>
</section>


<section id="taglines" class="erth-p-sec erth-p-taglines">
  <div class="erth-p-wrap">
    <div class="erth-p-head">
      <span class="erth-p-kicker">صوت العلامة</span>
      <h2 class="erth-p-title" style="color:#f7efe4">شعارات إرث الشام</h2>
    </div>
    <div class="erth-p-taggrid">
      <div class="erth-p-tagitem"><span class="erth-p-taglabel">عنوان عقاري</span><p>عقار يليق بمكانته.</p></div>
      <div class="erth-p-tagitem"><span class="erth-p-taglabel">تشطيب</span><p>ننفذ المواصفات كما تم الاتفاق عليها.</p></div>
      <div class="erth-p-tagitem"><span class="erth-p-taglabel">ثقة</span><p>كل تفصيل واضح قبل أن يبدأ التنفيذ.</p></div>
      <div class="erth-p-tagitem"><span class="erth-p-taglabel">تطوير</span><p>من الفكرة إلى المكان الجاهز.</p></div>
    </div>
  </div>
</section>
<?php /**PATH D:\syrian-real-estate\resources\views\partials\profile.blade.php ENDPATH**/ ?>