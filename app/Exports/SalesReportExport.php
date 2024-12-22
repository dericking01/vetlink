<?php

namespace App\Exports;

use App\Models\OrderItems;
use App\Models\AdminProduct;
use App\Models\Agent;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\ProductStock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill as StyleFill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Log;

class SalesReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithStyles
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = Carbon::parse($startDate)->startOfDay();
        $this->endDate = Carbon::parse($endDate)->endOfDay();
    }

    public function collection()
    {
        return OrderItems::whereHas('order', function ($query) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate])
                  ->whereNull('deleted_at')
                  ->where('status', 'Completed'); // Fetch only completed orders
        })
        ->with([
            'order', // Load order for agent_id and branch_id
            'productable' => function ($query) {
                $query->with(['adminProduct']); // Handle nested relationships
            }
        ])
        ->get();
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Customer Name',
            'Branch Name',
            'Product Name',
            'Quantity',
            'Unit Price',
            'Discount',
            'Total Amount',
            'Payment Method',
            'Delivery Status',
            'Order Date',
        ];
    }

    public function map($item): array
    {
        $order = $item->order;
        $agentName = Agent::find($order->agent_id)->name ?? 'Unknown Agent';
        $branchName = Branch::find($order->branch_id)->branch_name ?? 'Unknown Branch';
         // Handle delivery as boolean
        $delivery = $order->isDelivered ? 'Delivered' : 'Not Delivered';

        // Handle discount
        $discount = $order->discount !== null ? number_format($order->discount, 2) : 'NONE';

        // Payment method
        $paymentMethod = $order->payment_method;

        // Determine product name
        $productName = 'Unknown Product';
        if ($item->productable_type === AdminProduct::class) {
            // For AdminProduct
            $productName = $item->productable->name ?? 'Unknown Product';
        } elseif ($item->productable_type === BranchProduct::class) {
            // For BranchProduct
            $productName = $item->productable->adminProduct->name ?? 'Unknown Product';
        }elseif ($item->productable_type === ProductStock::class) {
            // For BranchProduct
            $productName = $item->productable->adminProduct->name ?? 'Unknown Product';
        }

        // Log::info($item->productable_type);
        // Log::info(get_class($item->productable));



        // Calculate total amount
        $totalAmount = ($item->price * $item->quantity) - $order->discount;

        return [
            $order->id,
            $agentName,
            $branchName,
            $productName,
            $item->quantity,
            number_format($item->price, 2),
            $discount,
            number_format($totalAmount, 2),
            $paymentMethod,
            $delivery,
            Carbon::parse($order->created_at)->format('Y-m-d'),
        ];
    }

        /**
     * Apply styles to the headings.
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_BLACK],
            ],
            'fill' => [
                'fillType' => StyleFill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCFFCC'], // Light green background color
            ],
        ]);

        return [];
    }
}
