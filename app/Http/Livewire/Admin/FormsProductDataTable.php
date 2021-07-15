<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class FormsProductDataTable extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $sortBy = 'name';
    
    public $sortDirection = 'ASC';
    
    public $perPage = 10;
    
    public $search = "";
    
    public $product_name, $formID, $formName;
    public $name, $product_id, $origin = "";
    public $category, $brand, $line, $directions, $notes, $advantages, $disadvantages, $form, $volume, $units, $price, $code = "";
    public $images, $indications, $ingredients, $reviews = [];

    public function render()
    {

        $products = $this->query();

        return view('livewire.admin.forms.forms-product-data-table', compact('products'));
    }

    public function query()
    {
        return Product::select('products.*', 'lines.id As line_id', 'lines.name As line_name', 'brands.name As brand_name', 'forms.name As form_name', 'categories.name As category_name')
            ->leftjoin('lines', 'lines.id', '=', 'products.line_id')
            ->leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftjoin('brands', 'brands.id', '=', 'products.brand_id')
            ->leftjoin('forms', 'forms.id', '=', 'products.form_id')
            ->where('forms.id', $this->formID)
            ->where('products.approved', 1)
            ->where(function ($query) {
                $query->where('products.name', 'like', '%' . $this->search . '%')
                    ->orWhere('products.volume', 'like', '%' . $this->search . '%')
                    ->orWhere('products.price', 'like', '%' . $this->search . '%')
                    ->orWhere('categories.name', 'like', '%' . $this->search . '%')
                    ->orWhere('brands.name', 'like', '%' . $this->search . '%')
                    ->orWhere('forms.name', 'like', '%' . $this->search . '%')
                    ->orWhere('lines.name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function sortBy($field)
    {

        if ($this->sortDirection == 'ASC') {
            $this->sortDirection = 'DESC';
        } else {
            $this->sortDirection = 'ASC';
        }

        return $this->sortBy = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function load($product_id, $product_name)
    {
        $this->product_id = $product_id;
        $this->product_name = $product_name;

        $product = Product::with('form','line','brand','category','indications','ingredients','reviews')->findOrFail($product_id);
        
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->category = $product->category->name;
        $this->brand = $product->brand->name;
        $this->line = $product->line ? $product->line->name : "";
        $this->directions = $product->directions_of_use;
        $this->notes = $product->notes;
        $this->advantages = $product->advantages;
        $this->disadvantages = $product->disadvantages;
        $this->form = $product->form->name;
        $this->volume = $product->volume;
        $this->units = $product->units;
        $this->price = $product->price;
        $this->code  = $product->code;
        $this->images = $product->product_photo;
        $this->indications = $product->indications;
        $this->ingredients = $product->ingredients;
        $this->reviews = $product->reviews;
        $this->origin = $product->brand->country->name ?? 'N/A';
    }

    public function deleteProduct($product_id)
    {
        Product::findOrFail($product_id)->delete();

        $this->emit('success', ['type' => 'success', 'message' => "$this->product_name has been Deleted Successfully."]);
    }
}
