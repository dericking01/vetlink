<?php

namespace App\Listeners;

use App\Events\ProductQuantityDeducted;
use App\Models\AdminProduct;
use App\Models\BranchProduct;
use App\Models\ProductStock;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
        try{
        DB::beginTransaction();

            foreach ($event->orderItems as $orderItem) {
                // Retrieve the order that this order item belongs to
                $order = $orderItem->order;
    
                // Get the branch ID from the order
                $branchId = $order->branch_id;
    
                // Retrieve the product ID (from the admin_products table)
                $productId = $orderItem->deductable_id;
    
                // Find the specific product in the branch_products table
                $branchProduct = ProductStock::where('branch_id', $branchId)
                    ->where('admin_product_id', $productId)
                    ->lockForUpdate()
                    ->first();

                
                // dd($orderItem->quantity);
    
                // If the branch product exists, deduct the quantity
                if ($branchProduct) {
                    $branchProduct->available_quantity -= $orderItem->quantity;
    
                    // Ensure the quantity doesn't go below zero
                    if ($branchProduct->available_quantity < 0) {
                        Log::warning("Reset branch product quantity with id {$productId} to zero(0) from {$branchProduct->available_quantity}");
                        $branchProduct->available_quantity = 0;
                    }

    
                    $branchProduct->save();
                    Log::info("Deducted {$orderItem->quantity} from branch_id: {$branchId} for admin_product_id: {$productId}");
                } else {
                    // Handle if there's no stock for the product in the branch
                    Log::warning("BranchProduct not found for branch_id: {$branchId} and admin_product_id: {$productId}");
                }



                //Also deduct quantity from Warehouse level, globally
                $warehouseProduct = AdminProduct::where('id',$productId)->lockForUpdate()->first();

                //Check if the product exists in warehouse
                if($warehouseProduct){
                    $warehouseProduct->quantity -= $orderItem->quantity;

                    //Ensure the quantity doesn't go below zero
                    if($warehouseProduct->quantity < 0){
                        Log::warning("Reset admin product quantity with id {$productId} to zero(0) from {$warehouseProduct->quantity}");
                        $warehouseProduct->quantity = 0;
                    }
                    
                    $warehouseProduct->save();
                    Log::info("Deducted {$orderItem->quantity} from admin products with admin_product_id: {$productId}");

                }else{
                    Log::warning("AdminProduct not found for admin_product_id: {$productId}");
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('Failed to deduct product quantity: ' . $e->getMessage());
        }
       
    }

}
