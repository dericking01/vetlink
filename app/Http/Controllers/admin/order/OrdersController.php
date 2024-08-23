<?php

namespace App\Http\Controllers\admin\order;

use App\Events\OrderCompleted;
use App\Events\ProductQuantityDeducted;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\AdminProduct;
use App\Models\Agent;
use App\Models\Branch;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ServiceCategory;
use Brian2694\Toastr\Facades\Toastr;
use Brian2694\Toastr\Toastr as ToastrToastr;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function pendingOrderindex()
    {
        // $orders = Orders::where('status', 'Pending')->get();
        $orders = Orders::with('orderItems')
                        ->where(function ($query) {
                            $query->where(function ($q) {
                                    $q->where('status', 'Completed')
                                    ->where('isDelivered', false);
                                })
                                ->orWhere(function ($q) {
                                    $q->where('status', 'Pending')
                                    ->where('isDelivered', true);
                                })
                                ->orWhere(function ($q) {
                                    $q->where('status', 'Pending')
                                    ->where('isDelivered', false);
                                });
                        })
                        ->latest()
                        ->get();
        $branches = Branch::latest()->where('status','active')->get();
        // dd($orders);
        $selectedBranchIds = [];

        foreach ($orders as $order) {
            $selectedBranchIds[$order->id] = $order->branch_id;
        }
        // dd($selectedBranchIds);

        return view('admin.order.pending-orders', compact('orders','branches','selectedBranchIds'));
    }

    public function completedOrderindex()
    {
        // $orders = Orders::where('status', 'Completed')->get();
        $orders = Orders::with('orderItems')->where('status', 'Completed')->where('isDelivered', true)->latest()->get();
        $branches = Branch::latest()->where('status','active')->latest()->get();
        $selectedBranchIds = [];

        foreach ($orders as $order) {
            $selectedBranchIds[$order->id] = $order->branch_id;
        }
        // dd($selectedBranchIds);

        return view('admin.order.completed-orders', compact('orders','branches','selectedBranchIds'));
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

        return view('admin.order.rejected-orders', compact('orders','branches','selectedBranchIds'));
    }

    public function partialOrderindex()
    {
        // $orders = Orders::where('status', 'Cancelled')->get();
        $orders = Orders::with('orderItems')->where('status', 'Partial')->latest()->get();
        $branches = Branch::latest()->where('status','active')->latest()->get();
        $selectedBranchIds = [];

        foreach ($orders as $order) {
            $selectedBranchIds[$order->id] = $order->branch_id;
        }
        // dd($selectedBranchIds);

        return view('admin.order.partial-orders', compact('orders','branches','selectedBranchIds'));
    }

    public function payPointOrderindex()
    {
        // $orders = Orders::where('status', 'Cancelled')->get();
        $orders = Orders::with('orderItems')->where('status', 'PayPoint')->latest()->get();
        $branches = Branch::latest()->where('status','active')->latest()->get();
        $selectedBranchIds = [];

        foreach ($orders as $order) {
            $selectedBranchIds[$order->id] = $order->branch_id;
        }
        // dd($selectedBranchIds);

        return view('admin.order.paypoints-orders', compact('orders','branches','selectedBranchIds'));
    }

    public function viewOrder($id)
    {
        $order = Orders::where('id', $id)->first();
        $orderItems = OrderItems::where('order_id', $order->id)->latest()->get();
        $products = $orderItems->pluck('productable');
        // dd($products);

        return view('admin.order.view-order', compact('order', 'orderItems', 'products'));
    }

    public function orderForm()
    {
        $agents = Agent::where('status','active')->latest()->get();
        $products = AdminProduct::where('status','active')->latest()->get();
        $branches = Branch::latest()->where('status','active')->get();
        $prod = AdminProduct::latest()->get();


        // dd('here');

        return view('admin.order.create-order',compact('agents','products','branches','prod'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric|min:0',
            'name' => 'required|array',
            'name.*' => 'exists:admin_products,id', // Ensure all selected products exist in the admin_products table
            'quantity' => 'required|array',
        ]);
        // Create the order
        $order = new Orders();

        $order->agent_id = $request->id;
        $order->status = 'Pending';
        $order->branch_id = $request->branch;
        $order->discount = $request->discount;
        $order->payment_method = $request->payment_method;
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

        Toastr::success('Order saved successfully!');
        return back();

    }

    // public function updateOrderOG(Request $request, $id)
    // {
    //     // Find the existing Order record
    //     $order = Orders::find($id);

    //     if (!$order) {
    //         Toastr::error('Order not found.');
    //         return back();
    //     }

    //     // Fetch the associated Agent
    //     $agent = $order->agent;

    //     if (!$agent) {
    //         Toastr::error('Agent not found.');
    //         return back();
    //     }

    //     // Check if the status is Partial and partial amount is provided
    //     if ($request->status === 'Partial') {
    //         if (is_null($request->partial_amount) || $request->partial_amount === '') {
    //             Toastr::error('Partial amount cannot be empty.');
    //             return back()->withInput();
    //         }

    //         // Check if partial amount is greater than total amount
    //         if ($request->partial_amount > $order->total_amount) {
    //             Toastr::error('Partial amount cannot be greater than the total amount.');
    //             return back()->withInput();
    //         }
    //     }

    //     // Check if the status is PayPoint and payPoint amount is provided
    //     if ($request->status === 'PayPoint') {
    //         if (is_null($request->PayPoint) || $request->PayPoint === '') {
    //             Toastr::error('Points amount cannot be empty.');
    //             return back()->withInput();
    //         }

    //         // Check if points amount is greater than total amount
    //         if ($request->PayPoint > $order->total_amount) {
    //             Toastr::error('Points amount cannot be greater than the total amount.');
    //             return back()->withInput();
    //         }

    //         // Check if the agent has enough points
    //         if ($request->PayPoint > $agent->points) {
    //             $toastr = resolve('toastr');
    //             $toastr->info('Sorry, Not enough points!!!');

    //             // Toastr::info('Sorry, Not enough points!!!');
    //             // return back()->withInput();
    //         }
    //     }
    //     dd($order);
    //     // Update the order with the new data
    //     $order->isDelivered = $request->isDelivered;
    //     $order->status = $request->status;
    //     $order->branch_id = $request->branch;
    //     $order->partial_amt = $request->status === 'Partial' ? $request->partial_amount : null;
    //     $order->PayPoint = $request->status === 'PayPoint' ? $request->PayPoint : null;

    //     // Save the updated order
    //     $order->save();

    //     // Deduct the used points from the agent's total points if PayPoint was used
    //     if ($request->status === 'PayPoint') {
    //         $agent->points -= $request->PayPoint;
    //         $agent->save();
    //     }

    //     // If the order is completed, dispatch the OrderCompleted event
    //     if ($order->status === 'Completed') {
    //         event(new OrderCompleted($order));
    //     }

    //     Toastr::success('Order successfully updated! ✔');
    //     return back();
    // }


    public function updateOrder(Request $request, $id)
    {
        // Find the existing Order record
        $order = Orders::find($id);

        if (!$order) {
            Toastr::error('Order not found.');
            return back();
        }

        // Fetch the associated Agent
        $agent = $order->agent;

        if (!$agent) {
            Toastr::error('Agent not found.');
            return back();
        }

        // Check if the status is Partial and partial amount is provided
        if ($request->status === 'Partial') {
            if (is_null($request->partial_amount) || $request->partial_amount === '') {
                Toastr::error('Partial amount cannot be empty.');
                return back()->withInput();
            }

            // Check if partial amount is greater than total amount
            if ($request->partial_amount > $order->total_amount) {
                Toastr::error('Partial amount cannot be greater than the total amount.');
                return back()->withInput();
            }
        }

        // Check if the status is PayPoint and payPoint amount is provided
        if ($request->status === 'PayPoint') {
            if (is_null($request->PayPoint) || $request->PayPoint === '') {
                Toastr::error('Points amount cannot be empty.');
                return back()->withInput();
            }

            // Check if point amount is greater than total amount
            if ($request->PayPoint > $order->total_amount) {
                Toastr::error('Points amount cannot be greater than the total amount.');
                return back()->withInput();
            }

            // Check if the agent has enough points
            if ($request->PayPoint > $agent->points) {
                // $toastr = resolve('toastr');
                // $toastr->info('Sorry, Not enough points!!!');

                Toastr::info('Sorry, Not enough points!!!');
                return back()->withInput();
            }

            // Check if Request Points equals Total amount
            if ($request->PayPoint == $order->total_amount) { // Using == for comparison to avoid type issues
                // Mark the order as completed
                $order->status = 'Completed';
                $order->save();

                // Deduct product quantity
                event(new ProductQuantityDeducted($order->orderItems));

                // Dispatch the OrderCompleted event
                event(new OrderCompleted($order));

                Toastr::success('Order FULLY PAID successfully! ✔');
            }

        }
        // dd($order);
        // Update the order with the new data
        $order->isDelivered = $request->isDelivered;
        $order->status = $request->status;
        $order->branch_id = $request->branch;
        // $order->discount = $request->discount;
        $order->payment_method = $request->payment_method;
        $order->partial_amt = $request->status === 'Partial' ? $request->partial_amount : null;
        $order->PayPoint = $request->status === 'PayPoint' ? $request->PayPoint : null;

        // Update the quantities of the order items
        $totalAmount = 0;

        foreach ($request->quantities as $orderItemId => $quantity) {
            $orderItem = OrderItems::findOrFail($orderItemId);

            // Update the quantity of each order item
            $orderItem->quantity = $quantity;
            $orderItem->save();

            // Recalculate the total amount
            $totalAmount += $quantity * $orderItem->price;
        }

        // Update the total amount in the order
        $order->total_amount = $totalAmount;
        // dd($order);
        // Save the updated order
        $order->save();

        // Deduct the used points from the agent's total points if PayPoint was used
        if ($request->status === 'PayPoint') {
            $agent->points -= $request->PayPoint;
            $agent->save();
        }

        // If the order is completed, dispatch the OrderCompleted event
        if ($order->status === 'Completed') {
            // Deduct product quantity
            event(new ProductQuantityDeducted($order->orderItems));
            // Dispatch the OrderCompleted event
            event(new OrderCompleted($order));
        }

        Toastr::success('Order successfully updated! ✔');
        return back();
    }

    public function updatePartialOrder(Request $request, $id)
    {
        // Find the existing Order record
        $order = Orders::find($id);

        if (!$order) {
            Toastr::error('Order not found.');
            return back();
        }

        // Check if  partial amount is provided
            if (is_null($request->partial_amount) || $request->partial_amount === '') {
                Toastr::error('Partial amount cannot be empty.');
                return back()->withInput();
            }

        // Check if partial amount is greater than total amount
            if ($request->partial_amount > $order->total_amount) {
                Toastr::error('Partial amount cannot be greater than the total amount.');
                return back()->withInput();
            }

        // Update the order with the new data
        $order->isDelivered = $request->isDelivered;
        $order->status = 'Partial';
        $order->branch_id = $request->branch;
        $order->partial_amt =$request->partial_amount;

        // Check if the partial amount is equal to the total amount
        if ($request->partial_amount == $order->total_amount) {
            if ($request->isDelivered == 1) {
                $order->status = 'Completed';
            } else {
                $order->status = 'Pending';
            }
        }

        // Save the updated order
        $order->save();

        // Dispatch the OrderCompleted event if necessary
        if ($order->status === 'Completed') {
            // Deduct product quantity
            event(new ProductQuantityDeducted($order->orderItems));
            // Dispatch the OrderCompleted event
            event(new OrderCompleted($order));
        }

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
