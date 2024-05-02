<?php

namespace App\Http\Controllers\staff\order;

use App\Events\OrderCompleted;
use App\Http\Controllers\Controller;
use App\Models\AdminProduct;
use App\Models\Agent;
use App\Models\Branch;
use App\Models\OrderItems;
use App\Models\Orders;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class StaffOrdersController extends Controller
{
    public function pendingOrderindex()
    {
        // $orders = Orders::where('status', 'Pending')->get();
        $orders = Orders::with('orderItems')->where('status', 'Pending')->latest()->get();
        $branches = Branch::latest()->where('status','active')->get();
        // dd($orders);
        $selectedBranchIds = [];

        foreach ($orders as $order) {
            $selectedBranchIds[$order->id] = $order->branch_id;
        }
        // dd($selectedBranchIds);

        return view('staff.manage.pending-orders', compact('orders','branches','selectedBranchIds'));
    }

    public function completedOrderindex()
    {
        // $orders = Orders::where('status', 'Completed')->get();
        $orders = Orders::with('orderItems')->where('status', 'Completed')->latest()->get();
        $branches = Branch::latest()->where('status','active')->latest()->get();
        $selectedBranchIds = [];

        foreach ($orders as $order) {
            $selectedBranchIds[$order->id] = $order->branch_id;
        }
        // dd($selectedBranchIds);

        return view('staff.manage.completed-orders', compact('orders','branches','selectedBranchIds'));
    }

    public function rejectedOrderindex()
    {
        // $orders = Orders::where('status', 'Cancelled')->get();
        $orders = Orders::with('orderItems')->where('status', 'Cancelled')->latest()->get();
        $branches = Branch::latest()->where('status','active')->latest()->get();
        $selectedBranchIds = [];

        foreach ($orders as $order) {
            $selectedBranchIds[$order->id] = $order->branch_id;
        }
        // dd($selectedBranchIds);

        return view('staff.manage.rejected-orders', compact('orders','branches','selectedBranchIds'));
    }

    public function viewOrder($id)
    {
        $order = Orders::where('id', $id)->first();
        $orderItems = OrderItems::where('order_id', $order->id)->latest()->get();
        $products = $orderItems->pluck('productable');
        // dd($products);

        return view('staff.manage.view-order', compact('order', 'orderItems', 'products'));
    }

    public function orderForm()
    {
        $agents = Agent::where('status','active')->latest()->get();
        $products = AdminProduct::where('status','active')->latest()->get();
        $branches = Branch::latest()->where('status','active')->get();
        $prod = AdminProduct::latest()->get();


        // dd('here');

        return view('staff.manage.create-order',compact('agents','products','branches','prod'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric|min:0',
            'name' => 'required|array',
            'name.*' => 'exists:admin_products,id', // Ensure all selected products exist in the admin_products table
            'quantity' => 'required|array',
            'status' => 'required|in:Completed,Pending',
        ]);
        // Create the order
        $order = new Orders();

        $order->agent_id = $request->id;
        $order->status = $request->status;
        $order->branch_id = $request->branch;
        $order->isDelivered = false;
        // dd($order);
        $order->save();


        // Calculate total amount and create order items
        $totalAmount = 0;

        foreach ($request->name as $productId) {
            $quantity = $request->quantity[$productId];
            $product = AdminProduct::findOrFail($productId);

            // Create order item for each product
            $orderItem = new OrderItems();
            $orderItem->order_id = $order->id;
            $orderItem->agent_id = $request->id;
            $orderItem->productable_id = $productId;
            $orderItem->productable_type = 'App\Models\AdminProduct';
            $orderItem->quantity = $quantity;
            $orderItem->price = $product->price; // Assuming price is retrieved from AdminProduct model
            // dd($orderItem);
            $orderItem->save();


            // Update total amount
            $totalAmount += $quantity * $product->price;
        }

        // Update total amount for the order
        $order->total_amount = $totalAmount;
        // dd($request);

        $order->save();

        // Dispatch the OrderCompleted event
        event(new OrderCompleted($order));

        Toastr::success('Order saved successfully!');
        return back();

    }

    public function updateOrder(Request $request, $id)
    {
        //  Find the existing ProductCategory record
            $order = Orders::where('id', $id)->first();
        // $order = Orders::find($request->id);

        // Find the existing Order record
        // $order = Orders::findOrFail($id);
        //  dd($order);

        // Update the record with the new data
        $order->isDelivered = $request->isDelivered;
        $order->status = $request->status;
        $order->branch_id = $request->branch;

        $order->save();

        // Dispatch the OrderCompleted event
        event(new OrderCompleted($order));

        Toastr::success('Order successfully updated! ✔');
        return back();
    }



    public function destroyOrder(Request $request)
    {
        $orderId = $request->input('id'); // Assuming 'orderId' is the name of the input field containing the order ID

        $order = Orders::find($orderId); // Use 'Order' instead of 'Orders'
        // dd($order);

        if ($order) {
            if ($order->isDelivered) {
                Toastr::error('Cannot delete a delivered order.');
            } else {
                $order->delete();
                Toastr::success('Order successfully deleted!');
            }
        } else {
            Toastr::error('Order not found or already deleted.');
        }

        return back();
    }
}