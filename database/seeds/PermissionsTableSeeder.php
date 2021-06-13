<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'event_create',
            ],
            [
                'id'    => 18,
                'title' => 'event_edit',
            ],
            [
                'id'    => 19,
                'title' => 'event_show',
            ],
            [
                'id'    => 20,
                'title' => 'event_delete',
            ],
            [
                'id'    => 21,
                'title' => 'event_access',
            ],
            [
                'id'    => 22,
                'title' => 'category_create',
            ],
            [
                'id'    => 23,
                'title' => 'category_edit',
            ],
            [
                'id'    => 24,
                'title' => 'category_show',
            ],
            [
                'id'    => 25,
                'title' => 'category_delete',
            ],
            [
                'id'    => 26,
                'title' => 'category_access',
            ],
            [
                'id'    => 27,
                'title' => 'order_create',
            ],
            [
                'id'    => 28,
                'title' => 'order_edit',
            ],
            [
                'id'    => 29,
                'title' => 'order_show',
            ],
            [
                'id'    => 30,
                'title' => 'order_delete',
            ],
            [
                'id'    => 31,
                'title' => 'order_access',
            ],
            [
                'id'    => 32,
                'title' => 'offer_create',
            ],
            [
                'id'    => 33,
                'title' => 'offer_edit',
            ],
            [
                'id'    => 34,
                'title' => 'offer_show',
            ],
            [
                'id'    => 35,
                'title' => 'offer_delete',
            ],
            [
                'id'    => 36,
                'title' => 'offer_access',
            ],
            [
                'id'    => 37,
                'title' => 'article_create',
            ],
            [
                'id'    => 38,
                'title' => 'article_edit',
            ],
            [
                'id'    => 39,
                'title' => 'article_show',
            ],
            [
                'id'    => 40,
                'title' => 'article_delete',
            ],
            [
                'id'    => 41,
                'title' => 'article_access',
            ],
            [
                'id'    => 42,
                'title' => 'city_create',
            ],
            [
                'id'    => 43,
                'title' => 'city_edit',
            ],
            [
                'id'    => 44,
                'title' => 'city_show',
            ],
            [
                'id'    => 45,
                'title' => 'city_delete',
            ],
            [
                'id'    => 46,
                'title' => 'city_access',
            ],
            [
                'id'    => 47,
                'title' => 'booth_create',
            ],
            [
                'id'    => 48,
                'title' => 'booth_edit',
            ],
            [
                'id'    => 49,
                'title' => 'booth_show',
            ],
            [
                'id'    => 50,
                'title' => 'booth_delete',
            ],
            [
                'id'    => 51,
                'title' => 'booth_access',
            ],
            [
                'id'    => 52,
                'title' => 'booth_detail_create',
            ],
            [
                'id'    => 53,
                'title' => 'booth_detail_edit',
            ],
            [
                'id'    => 54,
                'title' => 'booth_detail_show',
            ],
            [
                'id'    => 55,
                'title' => 'booth_detail_delete',
            ],
            [
                'id'    => 56,
                'title' => 'booth_detail_access',
            ],
           
            [
                'id'    => 58,
                'title' => 'configration_edit',
            ],
            [
                'id'    => 59,
                'title' => 'configration_show',
            ],
            [
                'id'    => 61,
                'title' => 'configration_access',
            ],
            [
                'id'    => 62,
                'title' => 'coupon_create',
            ],
            [
                'id'    => 63,
                'title' => 'coupon_edit',
            ],
            [
                'id'    => 64,
                'title' => 'coupon_show',
            ],
            [
                'id'    => 65,
                'title' => 'coupon_delete',
            ],
            [
                'id'    => 66,
                'title' => 'coupon_access',
            ],
            [
                'id'    => 67,
                'title' => 'consultation_create',
            ],
            [
                'id'    => 68,
                'title' => 'consultation_edit',
            ],
            [
                'id'    => 69,
                'title' => 'consultation_show',
            ],
            [
                'id'    => 70,
                'title' => 'consultation_delete',
            ],
            [
                'id'    => 71,
                'title' => 'consultation_access',
            ],
            [
                'id'    => 72,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
