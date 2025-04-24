<?php

namespace App\Listeners;

use App\Events\ProductQuantityRestored;
use App\Models\ProductStock;
use App\Models\AdminProduct;
use Illuminate\Support\Facades\Log;

class RestoreProductQuantity
{
    /**
     * Handle the event.
     */
    public function handle(ProductQuantityRestored $event)
    {
        foreach ($event->orderItems as $orderItem) {
            $order = $orderItem->order;
            $branchId = $order->branch_id;
            $productId = $orderItem->deductable_id;

            // Find the product stock entry
            $branchProduct = ProductStock::where('branch_id', $branchId)
                ->where('admin_product_id', $productId)
                ->first();

            if ($branchProduct) {
                $branchProduct->available_quantity += $orderItem->quantity;
                $branchProduct->save();
            } else {
                // Log a warning if no stock is found for the product
                Log::warning("Stock entry not found for branch_id: {$branchId}, admin_product_id: {$productId}");
            }

             // Restore to AdminProduct (global stock)
             $adminProduct = AdminProduct::find($productId);
             if ($adminProduct) {
                 $adminProduct->quantity += $quantity;
                 $adminProduct->save();
             } else {
                 Log::warning("Admin product not found for ID: {$productId}");
             }
        }
    }
}
