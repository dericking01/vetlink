<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\OrderItems;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{

    public function home()
    {
        $totalActiveAgents = Agent::where('status', 'Active')->count();
        $totalInactiveAgents = Agent::where('status', 'Inactive')->count();
        $totalAgents = Agent::where('deleted_at', null)->count();
        $totalOrders = Orders::where('deleted_at', null)->count();
        $totalItems = OrderItems::where('deleted_at', null)->count();
        $PendingOrders = Orders::where('status', 'Pending')->count();
        $CompletedOrders = Orders::where('status', 'Completed')->count();
        $RejectedOrders = Orders::where('status', 'Cancelled')->count();

        // Retrieve the sum of total_amount where status is 'Completed'
        $totalCompletedAmount = Orders::where('status', 'Completed')
                                        ->whereDate('created_at', Carbon::today())
                                        ->sum('total_amount');

        $totalSale = Orders::where('status', 'Completed')->sum('total_amount');

        // Retrieve daily sales data
        $dailySalesData = Orders::with('orderItems.productable')
            ->selectRaw('DATE(orders.created_at) as date, SUM(order_items.quantity * order_items.price) as total_sales')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Prepare data for Chart.js (daily)
        $dailyDates = $dailySalesData->pluck('date');
        $dailyTotalSales = $dailySalesData->pluck('total_sales');

        // Retrieve monthly sales data
        // Retrieve monthly sales data
        $monthlySalesData = Orders::with('orderItems.productable')
        ->selectRaw('DATE_FORMAT(orders.created_at, "%Y-%m") as month, SUM(order_items.quantity * order_items.price) as total_sales')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Prepare data for Chart.js (monthly)
        $monthlyDates = $monthlySalesData->pluck('month');
        $monthlyTotalSales = $monthlySalesData->pluck('total_sales');

        // Prepare last 7 months with names
        $lastMonths = [];
        $orderedMonthlySales = [];

        // Get the last 7 months with names
        for ($i = 0; $i < 7; $i++) {
            $month = date('F', strtotime("-$i month")); // Get full month name
            $lastMonths[] = $month; // Use month name
        }

        // Initialize sales data with zeros for each month
        foreach ($lastMonths as $month) {
            $orderedMonthlySales[$month] = 0; // Default to 0
        }

        // Fill the ordered sales data for existing months
        foreach ($monthlySalesData as $data) {
            // Convert month from 'Y-m' to 'F' (full month name)
            $monthName = date('F', strtotime($data->month)); // Get the month name
            $orderedMonthlySales[$monthName] = $data->total_sales; // Update sales for that month
        }

        // Convert to a list for Chart.js
        $orderedMonthlySales = array_values($orderedMonthlySales); // Get only the values for the chart


            return view('admin.dashboard.home', compact(
                'totalCompletedAmount',
                'totalActiveAgents',
                'totalInactiveAgents',
                'totalAgents',
                'totalOrders',
                'totalItems',
                'totalSale',
                'PendingOrders',
                'CompletedOrders',
                'RejectedOrders',
                'dailySalesData',
                'monthlySalesData',
                'dailyDates',
                'dailyTotalSales',
                'lastMonths', // Use this for your x-axis labels in the view
                'orderedMonthlySales' // Ordered sales for the last months
            ));
        }

}
