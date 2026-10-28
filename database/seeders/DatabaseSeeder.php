<?php
namespace Database\Seeders;
use App\Models\Property;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@irth-alsham.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);
        $defaults = [
            'site_name' => 'إرث الشام',
            'site_tagline' => 'العقارات والسياحة في سوريا',
            'footer_text' => 'المنصة العقارية والسياحية الأبرز في الجمهورية العربية السورية. نربط السوريين بوطنهم والمستثمرين بأفضل الفرص.',
            'footer_copyright' => 'جميع الحقوق محفوظة © ' . date('Y') . ' منصة إرث الشام العقارية والسياحية في سوريا.',
            'whatsapp' => '+963933000000',
            'phone' => '+963933000000',
            'default_phone' => '+963933000000',
            'exchange_rate' => '15000',
        ];
        foreach ($defaults as $k => $v) Setting::set($k, $v);

        $samples = [
            ['title'=>'شقة ديلوكس في أبو رمانة بإطلالة مميزة','city'=>'دمشق','district'=>'أبو رمانة','purpose'=>'بيع','price_usd'=>185000,'area'=>210,'rooms'=>4,'bathrooms'=>2,'description'=>'شقة ملكية طابق ثالث، كسوة سوبر ديلوكس حديثة بالكامل، تكييف مركزي، تدفئة مركزية، طابو اخضر نظامي وجاهزة للفراغ الفوري.','phone'=>'+963 944 123 456'],
            ['title'=>'شقة مفروشة بالكامل للإيجار السياحي في المالكي','city'=>'دمشق','district'=>'المالكي','purpose'=>'إيجار','price_usd'=>1200,'area'=>160,'rooms'=>3,'bathrooms'=>2,'description'=>'مخصصة للمغتربين ورجال الأعمال، إيجار شهري أو سنوي، فرش فخم طراز أوروبي.','phone'=>'+963 933 987 654'],
            ['title'=>'فيلا راقية مع حديقة خاصة في يعفور','city'=>'ريف دمشق','district'=>'يعفور','purpose'=>'بيع','price_usd'=>450000,'area'=>450,'rooms'=>6,'bathrooms'=>4,'description'=>'فيلا مستقلة ضمن تجمع سكني راقي ومسور، حديقة خاصة 300م، مسبح، كراج لعدة سيارات.','phone'=>'+963 955 333 222'],
            ['title'=>'شقة واسعة في الشهباء الجديدة','city'=>'حلب','district'=>'الشهباء','purpose'=>'بيع','price_usd'=>95000,'area'=>190,'rooms'=>3,'bathrooms'=>2,'description'=>'بناء حديث مصعد يعمل على مدار الساعة، طابو نظامي.','phone'=>'+963 988 111 222'],
            ['title'=>'شقة بحرية على الكورنيش الشمالي','city'=>'اللاذقية','district'=>'الشاطئ الأزرق','purpose'=>'إيجار','price_usd'=>700,'area'=>130,'rooms'=>2,'bathrooms'=>1,'description'=>'إطلالة بانورامية على البحر المتوسط، مفروشة بالكامل.','phone'=>'+963 991 555 444'],
            ['title'=>'شقة استثمارية قرب الكورنيش البحري','city'=>'طرطوس','district'=>'الكورنيش البحري','purpose'=>'بيع','price_usd'=>75000,'area'=>140,'rooms'=>3,'bathrooms'=>2,'description'=>'كسوة ممتازة، مناسبة للسكن أو الاستثمار السياحي.','phone'=>'+963 932 777 888'],
        ];
        foreach ($samples as $s) Property::create($s);
    }
}
