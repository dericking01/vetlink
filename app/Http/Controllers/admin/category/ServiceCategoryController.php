<?php

namespace App\Http\Controllers\admin\category;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $service_Categories = ServiceCategory::get();
        return view('admin.category.service-category', compact('service_Categories'));
    }

    public function storeServCat(Request $request)
    {
        $this->validate($request, [
            'catName' => 'required|regex:/^[a-zA-Z\s]+$/|unique:service_categories,CatName',
        ], [
            'catName.regex' => 'category name entered is invalid',
            'catName.unique' => 'Category has already been used!'
        ]);

        // dd($request);

        $latestCatID = ServiceCategory::latest('CatID')->first();
        // Check if a record exists in the table
        if ($latestCatID) {
            // Increment the latest 'CatID' by 1
            $newCatID = $latestCatID->CatID + 1;
        } else {
            // If there are no existing records, start with a specific number (e.g., 1001)
            $newCatID = 1001; // You can adjust this starting value as needed
        }


        $service_Categories = new ServiceCategory();
        $service_Categories->CatID = $newCatID;
        $service_Categories->catName = $request->catName;
        $service_Categories->status = $request->status;
        $service_Categories->Description = $request->description;

        $service_Categories->save();

        Toastr::success('Service category successfully added!');
        return back();
    }

    public function update(Request $request, $id)
    {

        $service_Categories = ServiceCategory::findOrFail($id);

        $this->validate($request, [
            'catName' => 'required|regex:/^[a-zA-Z\s]+$/',
            // 'catStatus' => 'required', // sasa hapa mlikua mnavalidate upuuzi gani? wakati attribute name ni status? Bangi i
            'status' => 'required',
        ], [
            'catName.required' => 'Category name is required',
            'catName.regex' => 'Category name is not valid',
            // 'catStatus.required' => 'Category status is required', // sasa hapa mlikua mnavalidate upuuzi gani? wakati attribute name ni status?
            'status.required' => 'Category status is required',
        ]);

        // dd($request->status);

        // Update the record with the new data
        $service_Categories->CatName = $request->catName;
        $service_Categories->Description = $request->description;
        $service_Categories->status = $request->status;
        $service_Categories->save();

        Toastr::success('Service Category successfully updated!');
        return back();
    }

    public function destroy(Request $request)
    {
        // dd($request->id);

        $service_Categories = ServiceCategory::find($request->id);

        if($service_Categories->status == 'Active'){
            Toastr::error('You cannot delete active category');
            return back();
        }

        $service_Categories->delete();
        Toastr::success('Service successfully deleted!');
        return back();
    }
}
