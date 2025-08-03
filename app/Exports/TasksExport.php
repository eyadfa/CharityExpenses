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

class TasksExport implements  FromCollection, WithHeadings, ShouldAutoSize, WithStyles
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
                $c->priority->desc_ar,
                $c->source->desc_ar,
                $c->commissioner,
                $c->creator->name,
                $c->is_finished == 1 ? "منجز" : "غير منجز",
                $c->finish_note,
                $c->created_at,
                $c->start_date,
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
        "  الأهمية ",
        "  نوع التكليف ",
        "تم التكليف بواسطة",
        "  أنشأت بواسطة",
        "الحالة",
        " ملاحظة الاغلاق",
        "تاريخ الانشاء",
        "تاريخ البداية",
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
