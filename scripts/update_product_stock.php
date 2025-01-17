<?php

use App\Models\ProductStock;
use Illuminate\Support\Facades\DB;

// Include Laravel's autoloader and bootstrap the app
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Resolve the kernel to make Laravel's facades work
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Path to your CSV file
$csvFilePath = __DIR__ . '/../storage/product_ids_ubungo.csv';

// Check if the file exists
if (!file_exists($csvFilePath)) {
    die("CSV file not found: $csvFilePath\n");
}

// Read and parse the CSV file
$csvData = array_map('str_getcsv', file($csvFilePath));
$header = array_shift($csvData); // Remove and save the header row

// Ensure the CSV has the required columns
if (!in_array('ID', $header) || !in_array('QTY', $header) || !in_array('branch_id', $header)) {
    die("CSV file does not contain the required columns: ID, QTY, branch_id.\n");
}

// Map CSV header to indices for flexible ordering
$columnMap = array_flip($header);

// Begin updating records
$updatedCount = 0;
foreach ($csvData as $row) {
    $id = $row[$columnMap['ID']];
    $qty = $row[$columnMap['QTY']];
    $branchId = $row[$columnMap['branch_id']];

    // Skip invalid or non-numeric IDs
    if (!is_numeric($id)) {
        continue;
    }

    // Convert ID and branch_id to integers
    $id = (int) $id;
    $branchId = (int) $branchId;

    // Find the product stock record
    $productStock = ProductStock::where('admin_product_id', $id)
        ->where('branch_id', $branchId)
        ->first();

    if ($productStock) {
        // Update the record
        $productStock->total_quantity = $qty;
        $productStock->available_quantity = $qty;
        $productStock->updated_at = now();
        $productStock->save();

        $updatedCount++;
    }
}

echo "Records updated successfully: $updatedCount\n";
