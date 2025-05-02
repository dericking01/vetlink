<?php

namespace App\Imports;

use App\Models\AdminProduct;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\ProductBatch;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class ProductsImport implements ToCollection, WithHeadingRow
{
    protected $missingBranches = [];
    protected $importedCount = 0;

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $adminId = auth('admin')->user()->id;

        foreach ($rows as $row) {
            // Check if expire_date is empty or null, and set to null if it is
            $expireDate = null;

            // Check if the expire_date is numeric (Excel date format)
            if (is_numeric($row['expire_date']) && !empty($row['expire_date'])) {
                // Convert Excel numeric date to DateTime object
                $expireDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['expire_date']);
            } else {
                // Attempt to parse string dates (like 'JUNE 2025')
                try {
                    $expireDate = Carbon::parse($row['expire_date']);
                } catch (\Exception $e) {
                    // Handle invalid date format, log error or set expireDate to null
                    $expireDate = null;
                }
            }

            // Convert numeric values from string to int/float
            $quantity = is_numeric($row['quantity']) ? (int) $row['quantity'] : null;
            $price = is_numeric($row['price']) ? (float) $row['price'] : null;
            $buying_price = is_numeric($row['buying_price']) ? (float) $row['buying_price'] : null;

            // Check for missing product name and log error
            if (empty($row['product_name'])) {
                Log::error("Product name is missing in row: " . json_encode($row));
                continue; // Skip the row if no product name
            }

            try{
                DB::beginTransaction();

                $productBatch = new ProductBatch;

                $cleanedName = strtolower(trim(preg_replace('/\s+/', ' ', $row['product_name'])));
                $existingProduct = AdminProduct::whereRaw('LOWER(TRIM(REPLACE(name, "  ", " "))) = ?', [$cleanedName])->first();

                if($existingProduct){
                    $existingProduct->update([
                        //'admin_id' => $adminId, // Use the authenticated admin's ID
                        'name' => $row['product_name'],
                        'quantity' => $quantity + $existingProduct->quantity,
                        'units' => $row['units'], // set to null if empty
                        'expire_date' => $expireDate,
                        'price' => $price,
                        'buying_price' => $buying_price,
                        'description' => $row['description'],
                        'status' => !empty($row['status']) ? $row['status'] : 'active', // Default to 'active' if status is null or empty
                        'image' => null
                    ]);
                    $existingProduct->save();

                    $productBatch->product_id = $existingProduct->id;
                    $productBatch->admin_id = $adminId;
                    $productBatch->quantity = $quantity;
                    $productBatch->buying_price = $buying_price;
                    $productBatch->expiry_date = $expireDate;
                    $productBatch->save();

                    Log::info("Updated existing product: {$existingProduct->name}", [
                        'batch_id' => $productBatch->id,
                        'product_id' => $existingProduct->id,
                        'admin_id' => $adminId,
                        'quantity_added' => $quantity,
                        'new_total_quantity' => $existingProduct->quantity + $quantity,
                        'buying_price' => $buying_price,
                        'expiry_date' => $expireDate?->format('Y-m-d'),
                    ]);
                    

                }else{
                    $newProduct = AdminProduct::create([
                        'admin_id' => $adminId, // Use the authenticated admin's ID
                        'name' => $row['product_name'],
                        'quantity' => $quantity,
                        'units' => $row['units'], // set to null if empty
                        'expire_date' => $expireDate,
                        'price' => $price,
                        'buying_price' => $buying_price,
                        'description' => $row['description'],
                        'status' => !empty($row['status']) ? $row['status'] : 'active', // Default to 'active' if status is null or empty
                        'image' => null
                    ]);

                    $productBatch->product_id = $newProduct->id;
                    $productBatch->admin_id = $adminId;
                    $productBatch->quantity = $quantity;
                    $productBatch->buying_price = $buying_price;
                    $productBatch->expiry_date = $expireDate;
                    $productBatch->save();

                    Log::info("Created new product: {$newProduct->name}", [
                        'batch_id' => $productBatch->id,
                        'product_id' => $newProduct->id,
                        'admin_id' => $adminId,
                        'quantity' => $quantity,
                        'buying_price' => $buying_price,
                        'expiry_date' => $expireDate?->format('Y-m-d'),
                    ]);
                    
    
                }


                DB::commit();
                $this->importedCount++; // Increment the count of imported products



            }catch(\Exception $e){
                DB::rollBack();
                Log::error('Failed to deduct product quantity: ' . $e->getMessage());
            }
        }
    }

    /**
     * Get the array of missing branch names.
     *
     * @return array
     */
    public function getMissingBranches()
    {
        return $this->missingBranches;
    }

    /**
     * Get the count of imported products.
     *
     * @return int
     */
    public function getImportedCount()
    {
        return $this->importedCount;
    }
}
