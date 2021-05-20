<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
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
        return Product::all();

        $products = Product::with('form', 'line', 'brand', 'category', 'indications', 'ingredients')->get();
        $productCollection = new Collection();
        foreach ($products as $product) {
            $item = [
                'name' => $product->name,
                'form' => $product->form->name,
                'brand' => $product->brand->name,
                'line' => $product->line ? $product->line->name : Null,
                'category' => $product->category->name,
                'volume' => $product->volume,
                'price' => $product->price,
            ];
            $productCollection->push($item);
        };

        return $productCollection;
    }

    public function map($product): array
    {
        return [
            $product->name,
            $product->form->name,
            $product->brand->name,
            $product->line ? $product->line->name : 'N\A',
            $product->category->name,
            $product->volume,
            $product->price,
        ];
    }
}
