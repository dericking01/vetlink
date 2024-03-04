<?php

namespace App\Http\Controllers\admin\products;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ServiceCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SabProductsController extends Controller
{
    public function list()
    {
        $products = Product::latest()->get();
        $productCategories = ProductCategory::where('CatID', '!=', 1000)->where('status', 'Active')->get();
        $serviceCategories = ServiceCategory::where('CatID', '!=', 1000)->where('status', 'Active')->get();
        return view('admin.products.sab-products', compact('products', 'productCategories', 'serviceCategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'regex:/^[a-zA-Z\s]+$/',
            'price' => 'numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'wholesale_minimum_qty' => 'required|numeric|min:0',
            'description' => 'required',
            'image' => 'mimes:jpg,png|max:2048',
        ]);

        if (isset($request->image)) {
            $img = FileHelper::uploadFile('upload', 'catalog', $request->image);
        } else {
            $img = '1.jpg';
        }
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->service_category_id = $request->service_category_id;
        $product->product_category_id = $request->product_category_id;
        $product->seller_id = 1;
        $product->discount = $request->discount;
        $product->quantity = $request->quantity;
        $product->wholesale_minimum_qty = $request->wholesale_minimum_qty;
        $product->description = $request->description;
        $product->image = $img;
        $product->status = $request->status;
        $product->save();

        Toastr::success('Product saved successfully!');
        return back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'quantity' => 'required',
            'wholesale_minimum_qty' => 'required',
            'description' => 'required',
        ]);

        $product =  Product::find($id);

        if (isset($request->image)) {
            $img = FileHelper::updateFile('upload', 'catalog', $product->image, $request->image);
        } else {
            $img = $product->image;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->service_category_id = $request->service_category_id;
        $product->product_category_id = $request->product_category_id;
        $product->discount = $request->discount;
        $product->quantity = $request->quantity;
        $product->wholesale_minimum_qty = $request->wholesale_minimum_qty;
        $product->description = $request->description;
        $product->image = $img;
        $product->status = $request->status;
        $product->save();

        Toastr::success('Product updated successfully!');
        return back();
    }

    public function destroy(Request $request)
    {
        $product = Product::find($request->id);

        if($product->status == true){
            Toastr::error('You cannot delete active product');
            return back();
        }
        $product->delete();
        Toastr::success('Product successfully deleted!');
        return back();
    }

    public function details($id)
    {
        $product = Product::where('id', $id)->first();
        return view('admin.products.sab-product-details', compact('product'));
    }

}
