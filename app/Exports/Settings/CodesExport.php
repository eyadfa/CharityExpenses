<?php

namespace App\Exports\Settings;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CodesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
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
                $c->controller->name??"",
                $c->page->name??"",
                $c->parent->desc_ar??"",
                $c->main_cd,
                $c->sub_cd,
                $c->desc_ar,
                $c->desc_en,
                $c->is_active == 1 ? "فعال" : "غير فعال",
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
            " النموذج الرئيسي ",
            " النموذج الفرعي ",
            " التصنيف الرئيسي ",
            "  الكود الرئيسي ",
            " الكود  الفرعي ",
            " الاسم ",
            " الاسم English ",
            " الحالة ",
            "تاريخ الاضافة",
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
