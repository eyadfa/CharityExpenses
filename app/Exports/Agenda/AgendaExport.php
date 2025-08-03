<?php

namespace App\Exports\Agenda;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AgendaExport implements  FromCollection, WithHeadings, ShouldAutoSize, WithStyles {

    protected  $collection;
    protected $total;
    public function __construct($collection){
        $this->collection = $collection;
    }

    /**
     * @return Collection
     */

    public function collection() {
        return new Collection($this->getData());
    }

    private function getData()
    {

        $data = $this->collection;
        $col = [];
        $i = 1;
        foreach ($data as $c) {
            $col[] = [
                $i++,
                $c->name,
                $c->address,
                $c->priority->desc_ar,
                $c->start_date,
                $c->end_date,
                $c->created_at,
            ];
        }
        $this->total = $i;

        return $col;
    }

    public function headings(): array
    {
        return [
            '#',
            " البند ",
            " المكان",
            "الأهمية",
            "تاريخ البداية",
            "تاريخ النهاية",
            "تاريخ الاضافة",
        ];


    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'ffffff'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'color' => ['rgb' => 'c40809'],
                ]
            ],

        ];
    }
}
