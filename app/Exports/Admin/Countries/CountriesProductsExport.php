<?php

namespace App\Exports\Admin\Countries;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class CountriesProductsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public $country_id; 

    public function __construct($country_id)
    {
        $this->country_id = $country_id;
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
        return Product::select('products.*', 'countries.name As country_name','countries.id As country_id', 'brands.name As brand_name', 'brands.id As brand_id', 'forms.name As form_name', 'categories.name As category_name', 'lines.name As line_name')
            ->leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftjoin('brands', 'brands.id', '=', 'products.brand_id')
            ->leftjoin('forms', 'forms.id', '=', 'products.form_id')
            ->leftjoin('lines', 'lines.id', '=', 'products.line_id')
            ->leftjoin('countries', 'countries.id', '=', 'brands.country_id')
            ->where('country_id', $this->country_id)
            ->get();
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
