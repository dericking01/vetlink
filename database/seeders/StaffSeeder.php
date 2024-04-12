<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed three staff records with admin_id set to 1 and status set to 'active'
        DB::table('staffs')->insert([
            [
                'admin_id' => 1,
                'name' => 'Alex John',
                'email' => 'staff1@example.com',
                'phone' => '255876543214',
                'role' => 'staff',
                'status' => 'active',
                'location' => 'Location 1',
                'password' => Hash::make('staff2024'), // You can use any default password here
                // Add other fields as needed
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'admin_id' => 1,
                'name' => 'Mariam Peter',
                'email' => 'staff2@vetlink.com',
                'phone' => '255876543210',
                'role' => 'staff',
                'status' => 'active',
                'location' => 'Location 2',
                'password' => Hash::make('staff2024'), // You can use any default password here
                // Add other fields as needed
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'admin_id' => 1,
                'name' => 'Staff 3',
                'email' => 'staff3@example.com',
                'phone' => '255876543211',
                'role' => 'staff',
                'status' => 'active',
                'location' => 'Location 3',
                'password' => Hash::make('staff2024'), // You can use any default password here
                // Add other fields as needed
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more staff records if needed
        ]);
    }
}
