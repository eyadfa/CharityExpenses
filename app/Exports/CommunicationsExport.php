<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CommunicationsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles {

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

    private function getData() {

        $data = $this->collection;
        $col = [];
        $i = 1;
        foreach ($data as $c) {
            $p = $c->participants->toArray();
            $caller = array_filter($p ,function($el){return $el["role_cd"] ==1;});
            $caller_p = array_filter($p ,function($el){return $el["role_cd"] ==2;});
            $callee = array_filter($p ,function($el){return $el["role_cd"] ==3;});
            $callee_p = array_filter($p ,function($el){return $el["role_cd"] ==4;});
            $col[] = [
                $i++,
                $c->caller_name,
                $c->caller_number,
                $c->callee_number,
                $c->call_date,
                $c->call_time,
                $c->call_reason,
                $c->response,
                $c->call_duration_in_minutes,
                $c->follower->full_name??"",
                $c->answered_by,
                $c->direction->desc_ar,
                $c->mechanism->desc_ar,
                implode(", \r\n" , array_column($caller, 'person_name')),
                implode(", \r\n" , array_column($caller_p, 'person_name')),
                implode(", \r\n" , array_column($callee, 'person_name')),
                implode(", \r\n" , array_column($callee_p, 'person_name')),
                $c->created_at
            ];
        }
        $this->total = $i;
        return $col;
    }

    public function headings(): array {
        return [
            '#',
            'المتصل',
            'الهاتف المتصل',
            ' الهاتف المتصل عليه',
            'تاريخ الاتصال',
            ' وقت الاتصال',
            'سبب الاتصال',
            ' الرد',
            'مدة الاتصال',
            'المتابعة بواسطة',
            ' تم الرد بواسطة',
            'نوع الاتصال',
            'ألية الاتصال',
            'المتصلون',
            'الحضور من طرف المتصل',
            'المتصل عليهم',
            'الحضور من طرقف المتصل عليهم',
            'تاريخ الاضافة',
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
            /*
                        // Styling a specific cell by coordinate.
                        'B2' => ['font' => ['italic' => true]],

                        // Styling an entire column.
                        'C'  => ['font' => ['size' => 16]],
                        */
        ];
    }
}
