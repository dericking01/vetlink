<?php

namespace App\Http\Controllers\seller\orders;

use App\Http\Controllers\Controller;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ServiceCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersManagementController extends Controller
{
    public function pendingOrdersindex()
    {
        $user = auth('seller')->user();
        $orders = Orders::where('status', 'Pending')
                            ->whereHas('orderItems', function($query) use ($user) {
                                        $query->where('seller_id', $user->id);
                            })
                            ->with('orderItems')
                            ->get();

        foreach ($orders as $order) {
            $authenticatedSellerOrderItems = $order->orderItems()
                ->where('seller_id', auth('seller')->user()->id) // Filtering by the authenticated seller ID
                ->get();
        
            $totalAmountForSeller = $authenticatedSellerOrderItems->sum('amount');
            $totalQtyForSeller = $authenticatedSellerOrderItems->sum('quantity'); // Assuming the quantity column name is 'quantity'
            $totalCommissionForSeller = $authenticatedSellerOrderItems->sum('sab_commission');
        
            $order->totalAmountForSeller = $totalAmountForSeller - $totalCommissionForSeller;
            $order->totalQtyForSeller = $totalQtyForSeller;
            $order->totalCommissionForSeller = $totalCommissionForSeller;
        }
        return view('seller.orders.pending-orders', compact('orders'));
    }

    public function completedOrdersindex()
    {
        $user = auth('seller')->user();
        $orders = Orders::where('status', 'Completed')
                            ->whereHas('orderItems', function($query) use ($user) {
                                        $query->where('seller_id', $user->id);
                            })
                            ->with('orderItems')
                            ->get();

        foreach ($orders as $order) {
            $authenticatedSellerOrderItems = $order->orderItems()
                ->where('seller_id', auth('seller')->user()->id) // Filtering by the authenticated seller ID
                ->get();
        
            $totalAmountForSeller = $authenticatedSellerOrderItems->sum('amount');
            $totalQtyForSeller = $authenticatedSellerOrderItems->sum('quantity'); // Assuming the quantity column name is 'quantity'
            $totalCommissionForSeller = $authenticatedSellerOrderItems->sum('sab_commission');
        
            $order->totalAmountForSeller = $totalAmountForSeller - $totalCommissionForSeller;
            $order->totalQtyForSeller = $totalQtyForSeller;
            $order->totalCommissionForSeller = $totalCommissionForSeller;
        }
                            


        // dd($amountSum);
        return view('seller.orders.completed-orders', compact('orders'));
    }

    public function rejectedOrdersindex()
    {
        $user = auth('seller')->user();
        $orders = Orders::where('status', 'Cancelled')
                            ->whereHas('orderItems', function($query) use ($user) {
                                        $query->where('seller_id', $user->id);
                            })
                            ->with('orderItems')
                            ->get();

        foreach ($orders as $order) {
            $authenticatedSellerOrderItems = $order->orderItems()
                ->where('seller_id', auth('seller')->user()->id) // Filtering by the authenticated seller ID
                ->get();
        
            $totalAmountForSeller = $authenticatedSellerOrderItems->sum('amount');
            $totalQtyForSeller = $authenticatedSellerOrderItems->sum('quantity'); // Assuming the quantity column name is 'quantity'
            $totalCommissionForSeller = $authenticatedSellerOrderItems->sum('sab_commission');
        
            $order->totalAmountForSeller = $totalAmountForSeller - $totalCommissionForSeller;
            $order->totalQtyForSeller = $totalQtyForSeller;
            $order->totalCommissionForSeller = $totalCommissionForSeller;
        }
        return view('seller.orders.rejected-orders', compact('orders'));
    }

    public function viewOrder($id)
    {
        $user = auth('seller')->user();
        $order = Orders::where('id', $id)->first();
        $orderItems = OrderItems::where('order_id', $order->id)
                                ->where('seller_id', $user->id)
                                ->get();
        $products = $orderItems->pluck('productable');

        return view('seller.orders.view-order', compact('order', 'orderItems', 'products'));
    }

    public function paidOrders()
    {
        $user = auth('seller')->user();
        $invoices = Invoice::where('status', '=', 'Paid')
                            ->whereIn('orders_id', function($query) use ($user) {
                                $query->select('order_id')
                                        ->from('order_items')
                                        ->where('seller_id', $user->id);
        })
                            ->get();
        return view('seller.orders.paid-orders', compact('invoices'));
    }

    public function unPaidOrders()
    {
        $user = auth('seller')->user();
        $invoices = Invoice::where('status', '!=', 'Paid')
                            ->whereIn('orders_id', function($query) use ($user) {
                                $query->select('order_id')
                                        ->from('order_items')
                                        ->where('seller_id', $user->id);
        })
                            ->get();
        return view('seller.orders.unpaid-orders', compact('invoices'));
    }


}
