<?php

namespace App\Exports;

use App\Models\ProductStock;
use App\Models\Branch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill as StyleFill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Carbon\Carbon;

class BranchStockExport implements FromCollection, WithHeadings, WithStyles
{
    protected $branchId;

    public function __construct($branchId)
    {
        $this->branchId = $branchId;
    }

    public function collection()
    {
        return ProductStock::where('branch_id', $this->branchId)
            ->whereNull('deleted_at') // Exclude soft-deleted records
            ->with(['adminProduct', 'branch', 'branchProducts']) // Load relationships
            ->get()
            ->map(function ($item) {
                // dd($item);
                return [
                    'Product Name' => $item->adminProduct->name ?? 'N/A',
                    'Branch Name' => $item->branch->branch_name ?? 'N/A',
                    'Total Quantity' => strval($item->total_quantity),  // Convert explicitly to a string
                    'Available Quantity' => strval($item->available_quantity),  // Convert explicitly to a string
                    'Price' => $item->price ?: 'N/A', // Retrieve price via accessor
                    'Date Created' => Carbon::parse($item->created_at)->format('Y-m-d'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Product Name',
            'Branch Name',
            'Total Quantity',
            'Available Quantity',
            'Price',
            'Date Created',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Get branch name and place it on the first row
        $branch = Branch::find($this->branchId);
        $branchName = $branch ? strtoupper($branch->branch_name) : 'UNKNOWN BRANCH';

        // Insert the branch name at the top row (before column headings)
        $sheet->insertNewRowBefore(1, 1);
        $sheet->setCellValue('A1', "Branch: $branchName");
        $sheet->mergeCells('A1:F1');

        // Style branch name row
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['argb' => Color::COLOR_WHITE],
            ],
            'fill' => [
                'fillType' => StyleFill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4CAF50'], // Green background
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
        ]);

        // Style headings
        $sheet->getStyle('A2:F2')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_BLACK],
            ],
            'fill' => [
                'fillType' => StyleFill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFFC000'], // Yellow background
            ],
        ]);

        return [];
    }
}
