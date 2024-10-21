<?php

namespace App\Listeners;

use App\Events\ProductQuantityDeducted;
use App\Models\AdminProduct;
use App\Models\BranchProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class DeductProductQuantity
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ProductQuantityDeducted  $event
     * @return void
     */
    public function handle(ProductQuantityDeducted $event)
    {
        foreach ($event->orderItems as $orderItem) {
            // Retrieve the order that this order item belongs to
            $order = $orderItem->order;

            // Get the branch ID from the order
            $branchId = $order->branch_id;

            // Retrieve the product ID (from the admin_products table)
            $productId = $orderItem->deductable_id;

            // Find the specific product in the branch_products table
            $branchProduct = BranchProduct::where('branch_id', $branchId)
                ->where('admin_product_id', $productId)
                ->first();
            // dd($orderItem->quantity);

            // If the branch product exists, deduct the quantity
            if ($branchProduct) {
                $branchProduct->quantity -= $orderItem->quantity;

                // Ensure the quantity doesn't go below zero
                if ($branchProduct->quantity < 0) {
                    $branchProduct->quantity = 0;
                }

                $branchProduct->save();
            } else {
                // Handle if there's no stock for the product in the branch
                Log::warning("BranchProduct not found for branch_id: {$branchId} and admin_product_id: {$productId}");
            }
        }
    }

}
