<?php

namespace App\Http\Controllers\seller\products;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\AdminProduct;
use App\Models\MarketProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Seller;
use App\Models\ServiceCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsManagementController extends Controller
{
    public function myProductsIndex()
    {
        $sellerId = auth('seller')->user()->id;


        // Retrieve the products of the logged-in seller
        $products = MarketProduct::where('seller_id', $sellerId)->where('isApproved', 'Approved')->latest()->get();
        $productNames = AdminProduct::latest()->get();
        $productCategories = ProductCategory::where('CatID', '!=', 1000)->where('status', 'Active')->get();
        $serviceCategories = ServiceCategory::where('CatID', '!=', 1000)->where('status', 'Active')->get();
        // $productCategories = ProductCategory::where('seller_id', $sellerId)->where('CatID', '!=', 1000)->where('status', 'Active')->get();
        // $serviceCategories = ServiceCategory::where('seller_id',$sellerId)->where('CatID', '!=', 1000)->where('status', 'Active')->get();

        return view('seller.products.myproducts', compact('products','productCategories','serviceCategories','sellerId','productNames'));
    }


    public function rejectedProducts()
    {
        $sellerId = auth('seller')->user()->id;

        $products = MarketProduct::where('seller_id', $sellerId)->where('isApproved', 'Rejected')->latest()->get();

        return view('seller.products.rejectedProducts', compact('products','sellerId'));
    }

    public function storeProduct(Request $request)
    {

        $sellerId = auth('seller')->user()->id;


        $this->validate($request, [
            // 'name' => 'regex:/^[a-zA-Z\s]+$/',
            'price' => 'numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'wholesale_minimum_qty' => 'required|numeric|min:0',
            'description' => 'required',
            'image' => 'mimes:jpg,png|max:2048',
        ]);

        // dd($request->all());

        if (isset($request->image)) {
            $img = FileHelper::uploadFile('upload', 'catalog', $request->image);
        } else {
            $img = '1.jpg';
        }
        $product = new MarketProduct();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->service_category_id = 1;
        $product->product_category_id = $request->product_category_id;
        $product->seller_id = $sellerId;
        $product->discount = $request->discount;
        $product->quantity = $request->quantity;
        $product->wholesale_minimum_qty = $request->wholesale_minimum_qty;
        $product->description = $request->description;
        $product->image = $img;
        $product->isApproved = 'Approved';
        $product->status = 'Available';

        // dd($product);

        $product->save();

        Toastr::success('Product added successfully!');
        return back();
    }

    public function update(Request $request, $id)
    {
        $sellerId = auth('seller')->user()->id;


        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'quantity' => 'required',
            'wholesale_minimum_qty' => 'required',
            'description' => 'required',
        ]);

        $product =  MarketProduct::find($id);

        if (isset($request->image)) {
            $img = FileHelper::updateFile('upload', 'catalog', $product->image, $request->image);
        } else {
            $img = $product->image;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->service_category_id = 1;
        $product->product_category_id = $request->product_category_id;
        $product->seller_id = $sellerId;
        $product->discount = $request->discount;
        $product->quantity = $request->quantity;
        $product->wholesale_minimum_qty = $request->wholesale_minimum_qty;
        $product->description = $request->description;
        $product->image = $img;
        $product->isApproved = 'Approved';
        $product->status = $request->status;

        // dd($product);

        $product->save();

        Toastr::success('Product updated successfully!');
        return back();
    }

    public function destroy(Request $request)
    {

        $product = MarketProduct::find($request->id);

        if($product->status == 'Available'){
            Toastr::error('You cannot delete an available product');
            return back();
        }
        $product->delete();
        Toastr::success('Product successfully deleted!');
        return back();
    }

    public function details($id)
    {
        $sellerId = auth('seller')->user()->id;

        $product = MarketProduct::where('id', $id)->where('seller_id', $sellerId)->latest()->first();
        // dd($product);

        return view('seller.products.product-details', compact('product','sellerId'));
    }
}
