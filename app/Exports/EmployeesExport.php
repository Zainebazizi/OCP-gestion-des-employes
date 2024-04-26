<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class EmployeesExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::all()->map(function ($employee) {
            return [
                $employee->id,
                $employee->nom,
                $employee->prenom,
                $employee->numero,
                $employee->department,
                $employee->region,
                $employee->cin,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nom',
            'Prénom',
            'Téléphone',
            'Department',
            'Region',
            'CIN'
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
