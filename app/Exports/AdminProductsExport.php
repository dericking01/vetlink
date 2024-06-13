<?php

namespace App\Exports;

use App\Models\AdminProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill as StyleFill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AdminProductsExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AdminProduct::select(
            'id',
            'name',
            'quantity',
            'price',
            'description',
            'status',
            'created_at',
            'updated_at',
            'deleted_at',
        )->get();
    }

    public function headings(): array
    {
        return [
            's/n',
            'name',
            'quantity',
            'price',
            'description',
            'status',
            'created_at',
            'updated_at',
            'deleted_at',
            // Add other fields as necessary
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
                'startColor' => ['argb' => 'FFCCFFCC'], // Blue background color
            ],
        ]);

        return [
            // Other styles if necessary
        ];
    }
}
