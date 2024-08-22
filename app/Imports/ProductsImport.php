<?php

namespace App\Imports;

use App\Models\AdminProduct;
use App\Models\Branch;
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
            // Look up the branch by name
            $branch = Branch::where('branch_name', $row['branch_name'])->first();

            if ($branch) {
                            // Check if expire_date is empty or null, and set to null if it is
            $expireDate = null;
            if (!empty($row['expire_date'])) {
                $expireDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['expire_date']);
            }

            // Prepare the data for insertion
            // $data = [
            //     'admin_id' => $adminId, // Use the authenticated admin's ID
            //     'branch_id' => $branch->id, // Use the branch ID from the database
            //     'name' => $row['product_name'],
            //     'quantity' => $row['quantity'],
            //     'units' => $row['units'], // ?? '-', Provide a default if null
            //     'expire_date' => $expireDate,
            //     'price' => $row['price'],
            //     'description' => $row['description'],
            //     'status' => $row['status'],
            //     'image' => NULL
            // ];

            // // Debug the data before saving it to the database
            // // dd($data);

            // Save the data to the database
            // AdminProduct::create($data);

                AdminProduct::create([
                    'admin_id' => $adminId, // Use the authenticated admin's ID
                    'branch_id' => $branch->id, // Use the branch ID from the database
                    'name' => $row['product_name'],
                    'quantity' => $row['quantity'],
                    'units' => $row['units'], // set to null if empty
                    'expire_date' => $expireDate,
                    'price' => $row['price'],
                    'description' => $row['description'],
                    'status' => $row['status'],
                    'image' => NULL
                ]);
                $this->importedCount++; // Increment the count of imported products
            } else {
                // Log missing branch
                $this->missingBranches[] = $row['branch_name'];
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

