<?php

namespace App\Exports;

use App\Models\BranchProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill as StyleFill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductDistributionExport implements FromCollection, WithHeadings, WithStyles
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
        return BranchProduct::whereBetween('created_at', [$this->startDate, $this->endDate])
        ->whereNull('deleted_at') // Add condition to exclude soft-deleted records
        ->get()
        ->map(function ($item) {
            return [
                'Product Name' => $item->adminProduct->name ?? 'N/A',
                'Branch Name' => $item->branch->branch_name ?? 'N/A',
                'quantity' => $item->quantity,
                'price' => $item->price,
                'created_at' => Carbon::parse($item->created_at)->format('Y-m-d'),
            ];
        });
    }

    // Add column headings
    public function headings(): array
    {
        return [
            'Product',
            'Branch',
            'Quantity Distributed',
            'Unit Price',
            'Date Distributed',
        ];
    }

    /**
     * Apply styles to the headings.
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:E1')->applyFromArray([
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
