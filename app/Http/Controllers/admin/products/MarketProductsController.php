<?php

namespace App\Http\Controllers\admin\products;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MarketProduct;
use App\Models\ProductCategory;
use App\Models\ServiceCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MarketProductsController extends Controller
{

    public function list()
    {
        $market_products = MarketProduct::get();
        $productCategories = ProductCategory::where('CatID', '!=', 1000)->where('status', 'Active')->get();
        $serviceCategories = ServiceCategory::where('CatID', '!=', 1000)->where('status', 'Active')->get();
        return view('admin.products.market-products', compact('market_products', 'productCategories', 'serviceCategories'));
    }

    // public function update(Request $request, $id)
    // {
    //     $market_products = MarketProduct::find($request->id);

    //     $market_products->status = $request->status;
    //     $market_products->isApproved = $request->isApproved;
    //     $market_products->reason = $request->description;
    //     dd($request);
    //     $market_products->save();

    //     Toastr::success('Product updated successfully ✔');
    //     return back();
    // }

    public function update(Request $request, $id)
    {
    // Define validation rules
        $rules = [
            'status' => 'required',
            'isApproved' => 'required',
            'description' => 'required_if:isApproved,Rejected',
        ];

        $messages = [
            'description.required_if' => 'Please specify the reason for rejection.',
        ];

        // Validate the request data
        $request->validate($rules,$messages);

        // If the validation fails, redirect back with an error message
        if ($request->isApproved == 'Rejected' && empty($request->description)) {
            return redirect()->back()
                ->with('toast_error', 'Please specify the reason for rejection.');
        }

        // If the validation passes, continue with updating the product
        $market_products = MarketProduct::find($request->id);

        $market_products->status = $request->status;
        $market_products->isApproved = $request->isApproved;

        // Only set 'reason' if 'isApproved' is 'Rejected'
        if ($request->isApproved == 'Rejected') {
            $market_products->reason = $request->description;
        }

        // dd($request);

        $market_products->save();

        Toastr::success('Product updated successfully ✔');
        return back();
    }

    public function destroy(Request $request)
    {
        $market_products = MarketProduct::find($request->id);
        if($market_products->isApproved == 'Approved'){
            Toastr::error('You cannot delete approved product');
            return back();
        }

        $market_products->delete();
        Toastr::success('Product successfully deleted!');
        return back();
    }

    public function details($id)
    {
        $product = MarketProduct::where('id', $id)->first();
        return view('admin.products.market-product-details', compact('product'));
    }


}
