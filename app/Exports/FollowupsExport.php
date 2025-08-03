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

class FollowupsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{

    protected $collection;
    protected $total;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    /**
     * @return Collection
     */

    public function collection()
    {
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
                $c->title,
                $c->details,
                $c->related->desc_ar,
                $c->sourcex->desc_ar,
                $c->commissioner,
                $c->follower->full_name,
                $c->creator->name,
                $c->is_finished == 1 ? "مغلق" : "غير مغلق",
                $c->finish_note,
                $c->created_at,
                $c->due_date,
                $c->finished_at,
            ];
        }

        $this->total = $i;

        return $col;
    }

    public function headings(): array
    {
        return [
            '#',
            " العنوان ",
            " التفاصيل",
            " متعلقة بــ ",
            "  نوع التكليف ",
            "تم التكليف بواسطة",
            "الشخص المكلف بها ",
            "  أنشأت بواسطة",
            "الحالة",
            " ملاحظة الاغلاق",
            "تاريخ الانشاء",
            "تاريخ الاستحقاق",
            "تاريخ الاغلاق",
        ];


    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => [
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
