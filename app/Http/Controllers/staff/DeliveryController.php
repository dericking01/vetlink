<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Orders;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        // dd('here');
        $orders = Orders::with('orderItems')->latest()->get();
        $branches = Branch::latest()->where('status','active')->latest()->get();
        $selectedBranchIds = [];

        foreach ($orders as $order) {
            $selectedBranchIds[$order->id] = $order->branch_id;
        }

        return view('staff.manage.delivery', compact('orders','branches','selectedBranchIds'));

    }

    public function updateOrder(Request $request, $id)
    {
        //  Find the existing order record
        $order = Orders::where('id', $id)->first();

        if (!$order) {
            Toastr::error('Order not found.');
            return back();
        }


        // Update the record with the new data
        $order->isDelivered = $request->isDelivered;
        // dd($order);
        // Save the updated order
        $order->save();

        // Dispatch the OrderCompleted event
        // event(new OrderCompleted($order));

        Toastr::success('Delivery status updated! ✔');
        return back();
    }
}
