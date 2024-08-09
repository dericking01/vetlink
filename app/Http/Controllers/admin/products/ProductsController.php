<?php

namespace App\Http\Controllers\admin\products;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminProduct;
use App\Models\Branch;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = AdminProduct::latest()->get();
        $admins = Admin::latest()->get();
        $branches = Branch::latest()->where('status','active')->get();

        return view('admin.products.admin-products', compact('products','admins','branches'));
    }

    public function store(Request $request)
    {

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
        $product = new AdminProduct();
        $product->name = $request->name;
        $product->branch_id = $request->branch;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
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
}
