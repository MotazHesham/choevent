<?php
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=[
            //event categories
            [
                'id'=>1,
                'name'=>'ترفيهية',
                'description'=>'نشاط ترفيهى ',
                'type'=>'activity'
            ],
            [
                'id'=>2,
                'name'=>'وطنية',
                'description'=>'أنشطة وطنية ',
                'type'=>'activity'
            ],
            [
                'id'=>3,
                'name'=>'ثقافية',
                'description'=>'نشاط ثقافى ',
                'type'=>'activity'
            ],
            [
                'id'=>4,
                'name'=>'رياضية',
                'description'=>'نشاط رياضى ',
                'type'=>'activity'
            ],
            [
                'id'=>5,
                'name'=>'تعليمية',
                'description'=>'نشاط تعليمى ',
                'type'=>'activity'
            ],
            //service categories
            [
                'id'=>6,
                'name'=>'لوجستي',
                'description'=>'خدمات لوجستية ',
                'type'=>'service'
            ],
            [
                'id'=>7,
                'name'=>'ميديا',
                'description'=>'خدمات الميديا من وحدات عرض وإضاءة ووحدات صوت ',
                'type'=>'service'
            ],
            [
                'id'=>8,
                'name'=>'تسويق',
                'description'=>'تسويق',
                'type'=>'service'
            ],
            [
                'id'=>9,
                'name'=>'قوة بشرية',
                'description'=>'قوة بشرية ',
                'type'=>'service'
            ],
            [
                'id'=>10,
                'name'=>'تقنى',
                'description'=>'خدمات تقنية ',
                'type'=>'service'
            ],
            [
                'id'=>11,
                'name'=>'عروض ترفيهية',
                'description'=>'عروض ترفيهية ',
                'type'=>'service'
            ],
            //news categories
            [
                'id'=>12,
                'name'=>'أخبار محلية',
                'description'=>'أخبار داخل المملكة ',
                'type'=>'news'
            ],
            [
                'id'=>13,
                'name'=>'أخبار ترفيهية',
                'description'=>'أخبار ترفيهية ',
                'type'=>'news'
            ],
            [
                'id'=>14,
                'name'=>'أخبار رياضية',
                'description'=>'أخبار رياضية ',
                'type'=>'news'
            ],
            [
                'id'=>15,
                'name'=>'أخبار عالمية',
                'description'=>'أخبار عالمية ',
                'type'=>'news'
            ]
        ];
        Category::insert($categories);
    }
}
