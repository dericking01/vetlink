<?php

namespace App\Imports;

use App\Models\AdminProduct;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $adminId = auth('admin')->user()->id;

        foreach ($rows as $row) {
            AdminProduct::create([
                'admin_id' => $adminId, // Use the authenticated admin's ID
                'name' => $row['name'],
                'quantity' => $row['quantity'],
                'price' => $row['price'],
                'description' => $row['description'],
                'status' => $row['status'],
                'image' => NULL
            ]);
        }
    }
}
