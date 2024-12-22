<?php

namespace App\Http\Controllers\admin\reports;

use App\Exports\ProductDistributionExport;
use App\Exports\StockReportExport;
use App\Exports\SalesReportExport;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Orders;
use App\Models\ProductStock;
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

    public function StockReport(Request $request)
    {
        $stocks = ProductStock::with(['adminProduct', 'branchProducts'])->get()->map(function ($stock) {
            return [
                'product_name' => $stock->adminProduct->name ?? 'N/A',
                'branch_name' => $stock->branch->branch_name ?? 'N/A',
                'total_quantity' => $stock->total_quantity,
                'available_quantity' => $stock->available_quantity,
                'price' => $stock->price, // Now using the custom accessor
                'updated_on' => $stock->updated_at,
                'description' => $stock->adminProduct->description ?? null,
            ];
        });

        return view('admin.reports.stock-report', compact('stocks'));
    }

    public function exportStock(Request $request)
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
        return Excel::download(new StockReportExport($startDate, $endDate), 'Stock-Report.xlsx');
    }

    public function exportSales(Request $request)
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

        // Check if start date is before 2024-10-13
        $minDate = Carbon::create('2024', '10', '13')->startOfDay();  // Set the minimum start date
        if (Carbon::parse($startDate)->lt($minDate)) {
            Toastr::error('The start date cannot be before 2024-10-13.');
            return back();
        }

        // dd("Start Date: $startDate, End Date: $endDate");

        // Return the Excel file as a download
        return Excel::download(new SalesReportExport($startDate, $endDate), 'Sales-Report.xlsx');
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
