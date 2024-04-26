<?php

namespace App\Exports;

use App\Models\Affectation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AffectationsExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Affectation::all()->map(function ($affectation) {
            return [
                $affectation->id,
                $affectation->nom_employee,
                $affectation->telephone_N,
                $affectation->application1,
                $affectation->application2,
                $affectation->pplication3,
                $affectation->pplication4,
                $affectation->date_debut,
                $affectation->date_fin,
            ];
        });
    }
    public function headings(): array
    {
        return [
            'Id',
            'Employee_cin',
            'Num_série',
            'Application 1',
            'Application 2',
            'Application 3',
            'Application 4',
            'Date_debut',
            'Date_fin',
            
        ];
    }
    public function styles(Worksheet $sheet)
{
    $sheet->getStyle('A1:I1')->applyFromArray([
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => '4285F4'], 
        ],
    ]);

    $sheet->getStyle('A1:I' . $sheet->getHighestRow())
        ->getBorders()->getAllBorders()->setBorderStyle('thin');

    foreach(range('A', 'I') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $sheet->getParent()->getDefaultStyle()->getFont()->setSize(12);
}

}