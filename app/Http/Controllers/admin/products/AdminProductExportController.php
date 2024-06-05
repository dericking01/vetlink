<?php

namespace App\Http\Controllers\admin\products;

use App\Exports\AdminProductsExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

        Excel::import(new ProductsImport, $request->file('file'));

        Toastr::success('Products Imported successfully!');
        return back();

        // return redirect()->back()->with('success', 'Products imported successfully.');
    }
}
