<?php

namespace App\Exports;

use App\Models\Application;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApplicationsExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Application::all()->map(function ($application) {
            return [
                $application->id,
                $application->nom,
                $application->version,
            ];
        });
    }
    public function headings(): array
    {
        return [
            'id',
            'Nom',
            'Version',
        ];
    }
    public function styles(Worksheet $sheet)
{
    $sheet->getStyle('A1:C1')->applyFromArray([
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => '4285F4'], 
        ],
    ]);

    $sheet->getStyle('A1:C' . $sheet->getHighestRow())
        ->getBorders()->getAllBorders()->setBorderStyle('thin');

    foreach(range('A', 'C') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $sheet->getParent()->getDefaultStyle()->getFont()->setSize(12);
}
}