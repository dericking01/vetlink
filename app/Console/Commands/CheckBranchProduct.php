<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckBranchProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:branch-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all unique admin_product_id and branch_id combinations for duplicates in vetlink.branch_products';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all unique combinations of admin_product_id and branch_id
        $uniqueCombinations = DB::table('vetlink.branch_products')
            ->select('admin_product_id', 'branch_id')
            ->distinct()
            ->get();

        // Iterate through each unique combination
        foreach ($uniqueCombinations as $combination) {
            $adminProductId = $combination->admin_product_id;
            $branchId = $combination->branch_id;

            // Find records for the current combination
            $records = DB::table('vetlink.branch_products')
                ->where('admin_product_id', $adminProductId)
                ->where('branch_id', $branchId)
                ->get();

            $recordCount = $records->count();

            // Log and output results
            if ($recordCount > 1) {
                Log::warning("Duplicate records found for admin_product_id: {$adminProductId}, branch_id: {$branchId}. Count: {$recordCount}");
                $this->warn("Duplicate records found for admin_product_id: {$adminProductId}, branch_id: {$branchId}. Count: {$recordCount}");
            } else {
                Log::info("Unique record for admin_product_id: {$adminProductId}, branch_id: {$branchId}");
                $this->info("Unique record for admin_product_id: {$adminProductId}, branch_id: {$branchId}");
            }
        }

        $this->info("Completed checking for duplicates in vetlink.branch_products.");
    }
}
