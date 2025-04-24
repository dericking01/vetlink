<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admins = [
            [
                'name' => 'Derrick',
                'email' => 'barakaurio@yahoo.com',
                'phone' => '255750279003',
                'role' => 'admin',
                'email_verified_at' => now(),
                'password' => Hash::make('LoginPass123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('admins')->insert($admins);
    }
}
