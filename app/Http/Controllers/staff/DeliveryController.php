<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\AdminProduct;
use App\Models\Agent;
use App\Models\Branch;
use App\Models\OrderItems;
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

    public function UpdateDeliveryStatus(Request $request, $id)
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

        Toastr::success('Delivery status updated! ✔');
        return back();
    }

    public function orderForm()
    {
        $agents = Agent::where('status','active')->latest()->get();
        $products = AdminProduct::where('status','active')->latest()->get();
        $branches = Branch::latest()->where('status','active')->get();
        $prod = AdminProduct::latest()->get();

        return view('staff.manage.order-man', compact('agents','products','branches','prod'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric|min:0',
            'name' => 'required|array',
            'name.*' => 'exists:admin_products,id', // Ensure all selected products exist in the admin_products table
            'quantity' => 'required|array',
        ]);

        // Validate all quantities before creating the order
        foreach ($request->name as $productId) {
            // Retrieve the product
            $product = AdminProduct::find($productId);

            if (!$product) {
                Toastr::warning("Product with ID {$productId} not found.");
                return back();
            }

            // Get the quantity for this product
            $quantity = $request->quantity[$productId];

            // Check if requested quantity exceeds available stock
            if ($quantity > $product->quantity) {
                Toastr::warning("{$product->name} is out of stock!");
                return back();
            }
        }

        // If all quantities are valid, proceed to create the order
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
        $totalAmount = $totalAmount - $request->discount;
        // dd($totalAmount);
        // Update total amount for the order
        $order->total_amount = $totalAmount;
        // dd($request);

        $order->save();

        Toastr::success('Order saved successfully!');
        return back();

    }
}
