<?php

namespace Database\Seeders;

use App\Models\MarketProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class OrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderIds = DB::table('orders')->pluck('id')->toArray();
        $faker = Faker::create(); // Ensure Faker is properly initiated

        for ($i = 0; $i < 400; $i++) {
            $quantity = $faker->numberBetween(1, 100);
            $price = $faker->randomFloat(2, 10000, 100000);
            $amount = $quantity * $price; // Calculate the amount

            $orderId = $faker->randomElement($orderIds);

            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'productable_id' => $faker->numberBetween(1, 35),
                'agent_id' => $faker->numberBetween(1, 30),
                'productable_type' => $faker->randomElement(['App\\Models\\AdminProduct']),
                'quantity' => $quantity,
                'price' => $price,
                'amount' => $amount,
                'sab_commission' => $amount * 0.02,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Calculate total amount for each order and update orders table
        foreach ($orderIds as $orderId) {
            $totalAmount = DB::table('order_items')->where('order_id', $orderId)->sum('amount');
            DB::table('orders')->where('id', $orderId)->update(['total_amount' => $totalAmount]);
        }
    }


}
