<?php
use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities=[
            [
                'id'=>1,
                'name'=>'الرياض'
            ],
            [
                'id'=>2,
                'name'=>'جدة'
            ],
            [
                'id'=>3,
                'name'=>'مكة المكرمة'
            ],
            [
                'id'=>4,
                'name'=>'المدينة المنورة'
            ],
            [
                'id'=>5,
                'name'=>'الإحساء'
            ],
            [
                'id'=>6,
                'name'=>'الدمام'
            ],
            [
                'id'=>7,
                'name'=>'الطائف'
            ],
            [
                'id'=>8,
                'name'=>'بريدة'
            ],
            [
                'id'=>9,
                'name'=>'تبوك'
            ],
            [
                'id'=>10,
                'name'=>'القطيف'
            ],

        ];
        City::insert($cities);
    }
}
