<?php

namespace App\Exports;

use App\Models\Telephone;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TelephonesExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Telephone::all()->map(function ($telephone) {
            return [
                $telephone->id,
                $telephone->marque,
                $telephone->modele,
                $telephone->num_série,
                $telephone->status,
            ];
        });
    }
    public function headings(): array
    {
        return [
            'id',
            'Marque',
            'Modele',
            'Num_serie',
            'Status'
        ];
    }
    public function styles(Worksheet $sheet)
{
    $sheet->getStyle('A1:E1')->applyFromArray([
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => '4285F4'], 
        ],
    ]);

    $sheet->getStyle('A1:E' . $sheet->getHighestRow())
        ->getBorders()->getAllBorders()->setBorderStyle('thin');

    foreach(range('A', 'E') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $sheet->getParent()->getDefaultStyle()->getFont()->setSize(12);
}

}
