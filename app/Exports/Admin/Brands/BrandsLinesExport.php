<?php

namespace App\Exports\Admin\Brands;

use App\Models\Line;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BrandsLinesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public $brand_id; 

    public function __construct($brand_id)
    {
        $this->brand_id = $brand_id;
    }


    public function headings(): array
    {
        return [
            ['Brands Lines Data'], [
                'Line\' Name',
                'Brand\'s Name'
            ]
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Line::where('brand_id', $this->brand_id)->get();
    }

    public function map($line): array
    {
        return [
            $line->name,
            $line->brand->name,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:B1');
        $sheet->getDefaultRowDimension()->setRowHeight(25);

        return [
            '1:2' => [
                'font' => [
                    'bold' => true,
                    'color' => [
                        'rgb' => 'ffffff'
                    ]
                ]
            ],

            1 => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'rgb' => '16a085',
                    ]
                ]
            ],

            2 => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'rgb' => '1abc9c',
                    ]
                ]
            ],

            'A:B' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],

            ],

            'A' => [
                'font' => ['bold' => true]
            ],
        ];
    }
}
