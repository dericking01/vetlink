<?php

namespace App\Http\Controllers\staff\products;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminProduct;
use Illuminate\Http\Request;

class StaffProductsController extends Controller
{
    //list products
    public function index()
    {
        $products = AdminProduct::latest()->get();
        $admins = Admin::latest()->get();

        return view('staff.products.listproducts', compact('products','admins'));
    }
}
