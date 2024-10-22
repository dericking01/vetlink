<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BranchProduct;
use App\Models\ProductStock;

class MigrateBranchProductsToProductStock extends Command
{
    // The name and signature of the console command.
    protected $signature = 'migrate:branch-products-to-product-stock';

    // The console command description.
    protected $description = 'Migrate records from branch_products to product_stock by summing quantities';

    // Execute the console command.
    public function handle()
    {
        // Retrieve all records from branch_products grouped by admin_product_id and branch_id
        $branchProducts = BranchProduct::all()->groupBy(function ($item) {
            return $item->admin_product_id . '-' . $item->branch_id;
        });

        foreach ($branchProducts as $groupedKey => $products) {
            // Extract admin_product_id and branch_id from the grouped key
            [$adminProductId, $branchId] = explode('-', $groupedKey);

            // Sum the quantities of the grouped records
            $totalQuantity = $products->sum('quantity');

            // Check if a record already exists in the product_stock table
            $productStock = ProductStock::where('admin_product_id', $adminProductId)
                                        ->where('branch_id', $branchId)
                                        ->first();

            if ($productStock) {
                // If record exists, increment the total_quantity and available_quantity
                $productStock->total_quantity += $totalQuantity;
                $productStock->available_quantity += $totalQuantity;
                $productStock->save();
            } else {
                // If no existing record, create a new entry in product_stock
                ProductStock::create([
                    'admin_product_id' => $adminProductId,
                    'branch_id' => $branchId,
                    'total_quantity' => $totalQuantity,
                    'available_quantity' => $totalQuantity,
                ]);
            }
        }

        // Output success message
        $this->info('Records migrated from branch_products to product_stock successfully!');
    }
}
