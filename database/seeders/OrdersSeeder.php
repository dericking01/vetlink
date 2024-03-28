<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $faker = Faker::create();

    // Retrieve all existing order IDs
    $orderIds = DB::table('orders')->pluck('id')->toArray();

    // Check if there are any orders available
    if (count($orderIds) === 0) {
        // Handle the case when there are no orders available
        // You may throw an exception, log a message, or handle it according to your application's logic
        return;
    }

    foreach ($orderIds as $orderId) {
        // Generate a random number of order items for each order
        $numOrderItems = $faker->numberBetween(1, 5);

        for ($i = 0; $i < $numOrderItems; $i++) {
            $productableId = $faker->numberBetween(1, 100);
            $agentId = $faker->numberBetween(1, 30);
            $quantity = $faker->numberBetween(1, 100);
            $price = $faker->randomFloat(2, 10, 1000);
            $amount = $quantity * $price;
            $sabCommission = $amount * 0.02; // Assuming 2% commission

            // Create the order item
            DB::table('order_items')->insert([
                'order_id' => $orderId, // Assign the current order ID
                'productable_id' => $productableId,
                'agent_id' => $agentId,
                'productable_type' => 'App\Models\AdminProduct', // Adjust as needed
                'quantity' => $quantity,
                'price' => $price,
                'amount' => $amount,
                'sab_commission' => $sabCommission,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}


}
