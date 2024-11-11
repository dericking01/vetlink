<?php

namespace App\Http\Controllers\admin\reports;

use App\Exports\ProductDistributionExport;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    public function salesReport(Request $request)
    {
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

    public function DistributionReport(Request $request)
    {
        // Retrieve all distributions from BranchProduct, including related AdminProduct and Branch details
        $distributions = BranchProduct::with(['adminProduct', 'branch'])->get();

        return view('admin.reports.distributions-report', compact('distributions'));
    }

    public function exportProductDistributions(Request $request)
    {
        // Validate incoming date range
        $request->validate([
            'date_range' => 'required',
        ]);

         // Retrieve the date range input
        $dateRange = $request->input('date_range');

        if (!$dateRange) {
            return back()->withErrors(['date_range' => 'Please select a valid date range.']);
        }

        // Split the date range into start and end dates
        [$startDate, $endDate] = explode(' to ', $dateRange);

        try {
            // Convert each date individually to ensure format compatibility
            $startDate = Carbon::createFromFormat('d/m/y', trim($startDate))->startOfDay()->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d/m/y', trim($endDate))->endOfDay()->format('Y-m-d');
        } catch (\Exception $e) {
            // Debugging: Display the error if parsing fails
            Toastr::error('Invalid date format selected. Error: ' . $e->getMessage());
            return back();
        }
        // dd("Start Date: $startDate, End Date: $endDate");

        // Return the Excel file as a download
        return Excel::download(new ProductDistributionExport($startDate, $endDate), 'ProductDistributions.xlsx');
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
