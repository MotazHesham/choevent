<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'               => 1,
                'name'             => 'Admin',
                'email'            => 'admin@admin.com',
                'password'         => bcrypt('password'),
                'remember_token'   => null,
                'mobile'           => '',
                'nationality'      => '',
                'company_register' => '',
                'employee_name'    => '',
                'identity_number'  => '',
            ],
        ];

        User::insert($users);
    }
}
