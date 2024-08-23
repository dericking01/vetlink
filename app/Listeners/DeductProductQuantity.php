<?php

namespace App\Listeners;

use App\Events\ProductQuantityDeducted;
use App\Models\AdminProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
            $product = AdminProduct::find($orderItem->productable_id);

            if ($product) {
                $product->quantity -= $orderItem->quantity;
                $product->save();
            }
        }
    }
}
