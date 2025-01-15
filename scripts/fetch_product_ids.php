<?php

use Illuminate\Support\Facades\DB;

// Include Laravel's autoloader and bootstrap the app
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Resolve the kernel to make Laravel's facades work
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Path to your CSV file
$csvFilePath = __DIR__ . '/../storage/products.csv';

// Check if the file exists
if (!file_exists($csvFilePath)) {
    die("CSV file not found: $csvFilePath\n");
}

// Read the CSV file
$products = array_map('str_getcsv', file($csvFilePath));
$results = [];

foreach ($products as $product) {
    $productName = $product[0]; // Assuming the name is in the first column
    $productRecord = DB::table('admin_products')->where('name', $productName)->first();

    if ($productRecord) {
        $results[] = [
            'name' => $productName,
            'id' => $productRecord->id,
        ];
    } else {
        $results[] = [
            'name' => $productName,
            'id' => 'Not Found',
        ];
    }
}

// Output file path
$outputFile = __DIR__ . '/../storage/product_ids.csv';
$handle = fopen($outputFile, 'w');
fputcsv($handle, ['Product Name', 'ID']);
foreach ($results as $result) {
    fputcsv($handle, $result);
}
fclose($handle);

echo "Product IDs saved to: $outputFile\n";
