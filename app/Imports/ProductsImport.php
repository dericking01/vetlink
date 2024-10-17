<?php

namespace App\Imports;

use App\Models\AdminProduct;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
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

            // Check for missing product name and log error
            if (empty($row['product_name'])) {
                Log::error("Product name is missing in row: " . json_encode($row));
                continue; // Skip the row if no product name
            }

            AdminProduct::create([
                'admin_id' => $adminId, // Use the authenticated admin's ID
                'name' => $row['product_name'],
                'quantity' => $quantity,
                'units' => $row['units'], // set to null if empty
                'expire_date' => $expireDate,
                'price' => $price,
                'description' => $row['description'],
                'status' => !empty($row['status']) ? $row['status'] : 'active', // Default to 'active' if status is null or empty
                'image' => null
            ]);

            $this->importedCount++; // Increment the count of imported products
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
