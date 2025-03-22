<?php

namespace App\Exports;

use App\Models\Agent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill as StyleFill;

class AgentExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * Fetch data from the Agent model
     */
    public function collection()
    {
        return Agent::select('name', 'phone', 'points', 'agent_id', 'status', 'created_at')->get();
    }

    /**
     * Define column headings
     */
    public function headings(): array
    {
        return [
            'Customer Name',
            'Phone Number',
            'Points',
            'Card ID',
            'Status',
            'Joined At',
        ];
    }

    /**
     * Map data before exporting
     */
    public function map($agent): array
    {
        return [
            $agent->name ?? 'N/A',
            $agent->phone ?? 'N/A',
            strval($agent->points),
            $agent->agent_id ?? 'N/A',
            ucfirst($agent->status), // Capitalize status (e.g., "active" → "Active")
            $agent->created_at->format('Y-m-d'), // Format date
        ];
    }

    /**
     * Apply styles to the sheet
     */
    public function styles(Worksheet $sheet)
    {
        // Apply bold styling to headings
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE],
            ],
            'fill' => [
                'fillType' => StyleFill::FILL_SOLID,
                'startColor' => ['argb' => 'FF5733'], // Orange background
            ],
        ]);

        // Auto-size columns
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        return [];
    }
}
