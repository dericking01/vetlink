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

    for ($i = 0; $i < 50; $i++) {
        $agentId = $faker->numberBetween(1, 30);
        $isDelivered = $faker->randomElement([false, true]);
        $status = $faker->randomElement(['Pending', 'Completed','Cancelled']);

        // Create the order
        $orderId = DB::table('orders')->insertGetId([
            'agent_id' => $agentId,
            'total_amount' => 0, // Initialize total_amount to 0
            'isDelivered' => $isDelivered,
            'status' => $status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Retrieve related order items for this order ID
        $orderItems = DB::table('order_items')->where('order_id', $orderId)->get();
        $totalAmount = 0;

        // Calculate the total amount based on order items
        foreach ($orderItems as $orderItem) {
            $totalAmount += $orderItem->amount;
        }

        // Update the total_amount for this order ID
        DB::table('orders')->where('id', $orderId)->update(['total_amount' => $totalAmount]);
    }
}


}
