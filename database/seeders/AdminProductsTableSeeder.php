<?php

namespace Database\Seeders;

use App\Models\AdminProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class AdminProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the admin_products table before seeding
        AdminProduct::truncate();

        $faker = Faker::create();

       // Seed data for the admin_products table for admins with id 1 to 6
       for ($adminId = 1; $adminId <= 2; $adminId++) {
        $this->seedAdminProducts($adminId, $faker);
    }
    }

    /**
     * Seed admin_products data for a specific admin_id.
     *
     * @param int $adminId
     * @param \Faker\Generator $faker
     */
    private function seedAdminProducts(int $adminId, $faker): void
    {
        for ($i = 0; $i < 2; $i++) {
            AdminProduct::create([
                'admin_id' => $adminId,
                'name' => $faker->word,
            ]);
        }
    }
}
