<?php

namespace App\Exports\Admin\Indications;

use App\Models\Indication;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class IndicationsProductsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public $indication_id; 

    public function __construct($indication_id)
    {
        $this->indication_id = $indication_id;
    }

    public function headings(): array
    {
        return [
            ['Products Data'], [
                'Name',
                'Form',
                'Brand',
                'Line',
                'Category',
                'Volume',
                'Price'
            ]
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Indication::findOrFail($this->indication_id)->products()->get();
    }

    public function map($product): array
    {
        return [
            $product->name,
            $product->form->name,
            $product->brand->name,
            $product->line ? $product->line->name : 'N/A',
            $product->category->name,
            $product->volume,
            $product->price,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:G1');
        $sheet->getDefaultRowDimension()->setRowHeight(25);
        $sheet->getPageSetup()->setOrientation('landscape');


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
                        'rgb' => '2980b9',
                    ]
                ]
            ],

            2 => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'rgb' => '3498db',
                    ]
                ]
            ],

            'A:G' => [
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
