<?php

namespace App\Exports;

use App\Models\History;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HistoriesExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return History::all()->map(function ($history) {
            return [
                $history->employee_id,
                $history->telephone_id,
                $history->application_id,
                $history->date_debut,
                $history->date_fin,
            ];
        });
    }
    public function headings(): array
            {
                return [
                    'employee_id',
                    'telephone_id',
                    'application_id',
                    'date_debut',
                    'date_fin'
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
