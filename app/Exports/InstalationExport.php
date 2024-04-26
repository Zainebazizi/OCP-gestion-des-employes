<?php

namespace App\Exports;

use App\Models\Instalation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InstalationExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Instalation::all()->map(function ($instalation) {
            return [
                $instalation->Application_id,
                $instalation->Telephone_id,
                $instalation->Date_installation,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Application_id',
            'Telephone_id',
            'Date_installation'
        ];
    }
    public function styles(Worksheet $sheet)
{
    $sheet->getStyle('A1:G1')->applyFromArray([
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => '4285F4'], 
        ],
    ]);

    $sheet->getStyle('A1:G' . $sheet->getHighestRow())
        ->getBorders()->getAllBorders()->setBorderStyle('thin');

    foreach(range('A', 'G') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $sheet->getParent()->getDefaultStyle()->getFont()->setSize(12);
}

}