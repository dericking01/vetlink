<?php

namespace App\Http\Controllers\admin\category;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $productCats = ProductCategory::get();
        return view('admin.category.product-category', compact('productCats'));
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'catName' => 'regex:/^[a-zA-Z\s]+$/|unique:product_categories,CatName',
        ], [
            'catName.regex' => 'Category name is not valid',
            'catName.unique' => 'Category has already been used!'
        ]);
        // Get the latest 'CatID' from the 'ProductCategory' table
        $latestCatID = ProductCategory::latest('CatID')->first();

        // Check if a record exists in the table
        if ($latestCatID) {
            // Increment the latest 'CatID' by 1
            $newCatID = $latestCatID->CatID + 1;
        } else {
            // If there are no existing records, start with a specific number (e.g., 1001)
            $newCatID = 1001; // You can adjust this starting value as needed
        }

        // Create a new 'ProductCategory' instance
        $prodCat = new ProductCategory();
        $prodCat->CatID = $newCatID;
        $prodCat->CatName = $request->catName;
        $prodCat->status = $request->catStatus;
        $prodCat->Description = $request->description;
        $prodCat->save();


        Toastr::success('Product category successfully added! ✔');
        return back();
    }

    public function editProduct($id)
    {
        $productCats = ProductCategory::findOrFail($id);
        return view('admin.category.edit-product', compact('productCats'));
    }

    public function update(Request $request, $id)
    {
        // Find the existing ProductCategory record
        $productCats = ProductCategory::findOrFail($id);

        // Validate the incoming request data
        $this->validate($request, [
            'catName' => 'required|regex:/^[a-zA-Z\s]+$/',
            'catStatus' => 'required'
        ], [
            'catName.required' => 'Category name is required',
            'catName.regex' => 'Category name is not valid',
            'catStatus.required' => 'Category status is required',
        ]);

        // Update the record with the new data
        $productCats->CatName = $request->catName;
        $productCats->Description = $request->description;
        $productCats->status = $request->catStatus;
        $productCats->save();

        Toastr::success('Product Category successfully updated! ✔');
        return back();
    }

    public function destroy(Request $request)
    {
        // dd($request->id);
        $prodcat = ProductCategory::find($request->id);

        if($prodcat->status == 'Active'){
            Toastr::error('You cannot delete active category');
            return back();
        }

        $prodcat->delete();
        Toastr::success('Product category successfully deleted! ✔');
        return back();
    }
}
