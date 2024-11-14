<?php

namespace App\Exports;

use App\Models\ProductStock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill as StyleFill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StockReportExport implements FromCollection, WithHeadings, WithStyles
{
    protected $startDate;
    protected $endDate;

    // Accept date range as parameters in the constructor
    public function __construct($startDate, $endDate)
    {
        $this->startDate = Carbon::parse($startDate)->startOfDay();
        $this->endDate = Carbon::parse($endDate)->endOfDay();
    }

    // Specify the data to be collected
    public function collection()
    {
        return ProductStock::whereBetween('created_at', [$this->startDate, $this->endDate])
            ->whereNull('deleted_at') // Exclude soft-deleted records
            ->with(['adminProduct', 'branch', 'branchProducts']) // Eager load relationships
            ->get()
            ->map(function ($item) {

                return [
                    'Product Name' => $item->adminProduct->name ?? 'N/A',
                    'Branch Name' => $item->branch->branch_name ?? 'N/A',
                    'Total Quantity' => $item->total_quantity,
                    'Available Quantity' => $item->available_quantity,
                    'Price' => $item->price ? : 'N/A', // Use the accessor here
                    'Date Created' => Carbon::parse($item->created_at)->format('Y-m-d'),
                ];
            });
    }


    // Add column headings
    public function headings(): array
    {
        return [
            'Product',
            'Branch',
            'Stock Quantity',
            'Available Quantity',
            'Unit Price',
            'Stock as at',
        ];
    }

    /**
     * Apply styles to the headings.
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->applyFromArray([
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
