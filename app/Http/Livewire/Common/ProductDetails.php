<?php

namespace App\Http\Livewire\Common;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product, $product_id, $category, $brand, $line, $name, $indications, $ingredients, $product_photo, $directions_of_use, $notes, $advantages, $disadvantages, $form, $volume, $units, $price, $code, $country, $editor;
    public $color, $textColor;

    protected $listeners = ['setProductId'];

    public function render()
    {
        return view('livewire.common.product-details');
    }

    public function setProductId($product_id)
    {
        $this->product_id = $product_id;

        $this->product = Product::with('brand.country')->findOrFail($product_id);
        
        $this->category = $this->product->category->name;
        $this->brand = $this->product->brand->name;
        $this->line = $this->product->line ? $this->product->line->name : null;
        $this->name = $this->product->name;
        $this->directions_of_use = $this->product->directions_of_use;
        $this->notes = $this->product->notes;
        $this->product_photo = $this->product->product_photo;
        $this->advantages = $this->product->advantages;
        $this->disadvantages = $this->product->disadvantages;
        $this->form = $this->product->form->name;
        $this->indications = $this->product->indications;
        $this->ingredients = $this->product->ingredients;
        $this->volume = $this->product->volume;
        $this->units = $this->product->units;
        $this->price = $this->product->price;
        $this->code = $this->product->code;
        $this->country = $this->product->brand->country->name;
        $this->editor = $this->product->editor->first_name . ' ' . $this->product->editor->last_name;

        $this->emit('modalShow');
        // dd($this);
    }

}
