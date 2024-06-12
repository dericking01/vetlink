<?php

namespace App\Http\Controllers\admin\products;

use App\Exports\AdminProductsExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class AdminProductExportController extends Controller
{
    public function export()
    {
        return Excel::download(new AdminProductsExport, 'admin_products.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        try {
            Excel::import(new ProductsImport, $request->file('file'));
            Toastr::success('Products Imported successfully!');
        } catch (ValidationException $e) {
            $failures = $e->failures();
            $errorMessage = 'Error importing products:';
            foreach ($failures as $failure) {
                $errorMessage .= "<br>" . 'Row ' . $failure->row() . ': ' . implode(',', $failure->errors());
            }
            Toastr::error($errorMessage);
        } catch (\Exception $e) {
            Toastr::error('An error occurred while importing products: ' . $e->getMessage());
        }

        return back();
    }
}
