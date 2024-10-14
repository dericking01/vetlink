<?php

namespace App\Http\Controllers\admin\reports;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function salesReport(Request $request)
    {
        // dd('here');
        // Retrieve sales data
        $salesData = Orders::with('orderItems.productable')
            ->selectRaw('DATE(orders.created_at) as date, SUM(order_items.quantity * order_items.price) as total_sales')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Prepare data for Chart.js
        $dates = $salesData->pluck('date');
        $totalSales = $salesData->pluck('total_sales');

        return view('admin.reports.sales', compact('dates', 'totalSales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
