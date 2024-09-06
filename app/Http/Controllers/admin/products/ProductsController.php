<?php

namespace App\Http\Controllers\admin\products;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminProduct;
use App\Models\Branch;
use App\Models\BranchProduct;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = AdminProduct::where('status','active')->latest()->get();
        $admins = Admin::latest()->get();
        $branches = Branch::latest()->where('status','active')->get();

        return view('admin.products.admin-products', compact('products','admins','branches'));
    }

    public function warehouseIndex()
    {
        $products = AdminProduct::latest()->get();
        $admins = Admin::latest()->get();
        $branches = Branch::latest()->where('status','active')->get();
        $branchProducts = BranchProduct::with(['branch', 'adminProduct'])->latest()->get();

        return view('admin.products.warehouse', compact('products','admins','branches','branchProducts'));
    }

    public function store(Request $request)
    {
        // Convert the input text field to a date format
        $adminId = auth('admin')->user()->id;

        $this->validate($request, [
            // 'name' => 'regex:/^[a-zA-Z\s]+$/',
            // 'image' => 'mimes:jpg,png|max:2048',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);

        if (isset($request->image)) {
            $img = FileHelper::uploadFile('upload', 'catalog', $request->image);
        } else {
            $img = '1.jpg';
        }

        // Convert the input text field to a date format
        $expire_date = Carbon::parse($request->expire_date);

        $product = new AdminProduct();
        $product->name = $request->name;
        $product->branch_id = $request->branch;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->units = $request->units;
        $product->expire_date = $expire_date;
        $product->description = $request->description;
        $product->image = $img;
        $product->admin_id = $adminId;
        // dd($product);
        $product->save();

        Toastr::success('Product saved successfully!');
        return back();
    }

    public function update(Request $request, $id)
    {

        $adminId = auth('admin')->user()->id;

        $this->validate($request, [
            'name' => 'required',
            'quantity' => 'numeric|min:1',
            'price' => 'numeric|min:0',
            // 'description' => 'required|string',
        ]);

        $product =  AdminProduct::find($id);

        if (isset($request->image)) {
            $img = FileHelper::updateFile('upload', 'catalog', $product->image, $request->image);
        } else {
            $img = $product->image;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->units = $request->units;
        $product->expire_date = $request->expire_date;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->image = $img;
        $product->admin_id = $adminId;
        $product->branch_id = $request->branch;
        $product->save();

        Toastr::success('Product updated successfully!');
        return back();
    }

    public function destroy(Request $request)
    {
        $product = AdminProduct::find($request->id);

        $product->delete();
        Toastr::success('Product successfully deleted!');
        return back();
    }

    public function distributeProduct(Request $request)
    {
        // Debugging: dump the request data
        // dd($request->all());
        $this->validate($request, [
            'product' => 'required|exists:admin_products,id', // Ensure the selected product exists
            'branches' => 'required|array', // Ensure branches is an array
            'branches.*' => 'exists:branches,id', // Ensure all selected branches exist
            'quantities' => 'required|array', // Ensure quantities is an array
            'quantities.*' => 'nullable|numeric|min:1', // Allow nullable and filter out empty quantities
        ]);

        // Filter out empty or null quantities
        $quantities = array_filter($request->quantities, function ($quantity) {
            return !is_null($quantity) && $quantity > 0;
        });

        if (count($quantities) != count($request->branches)) {
            Toastr::error('All selected branches must have a valid quantity.');
            return back()->withInput();
        }

        $product = AdminProduct::findOrFail($request->product); // Get the selected product

        // Loop through selected branches and distribute the product
        foreach ($request->branches as $branchId) {
            $quantity = $request->quantities[$branchId];

            // Check if there's enough quantity in the warehouse (product's stock)
            if ($product->quantity < $quantity) {
                Toastr::error('Not enough quantity for ' . Branch::find($branchId)->branch_name);
                return back()->withInput();
            }

            // Deduct the quantity from the product stock
            $product->quantity -= $quantity;
            $product->save();

            // Create a record for distributed products (this might be a new model, depending on your setup)
            BranchProduct::create([
                'admin_product_id' => $product->id,
                'branch_id' => $branchId,
                'quantity' => $quantity,
            ]);
        }

        Toastr::success('Product successfully distributed to branches.');
        return back();
    }


}
