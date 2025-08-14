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

class PartiesExport  implements  FromCollection, WithHeadings, ShouldAutoSize, WithStyles {

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
                $c->manager_name,
                $c->mobile,
                $c->activity->desc_ar,
                $c->status->desc_ar,
                $c->notes,
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
            " اسم المؤسسة ",
            " مدير المؤسسة",
            "رقم الموبايل",
            "نوع النشاط",
            "الحالة",
            "ملاحظات",
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
