<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Seed 8 branch names
        for ($i = 0; $i < 8; $i++) {
            DB::table('branches')->insert([
                'branch_name' => $faker->company,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
