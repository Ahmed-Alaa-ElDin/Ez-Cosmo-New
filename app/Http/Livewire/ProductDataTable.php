<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductDataTable extends Component
{

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $sortBy = 'name';

    public $sortDirection = 'ASC';

    public $perPage = 10;

    public $search = "";

    // public $query = Product::orderBy($this->sortBy, $this->sortDirection)->paginate(10);

    public function render()
    {
        // dd(Product::select('products.*','brands.name As brand_name')->join('brands', 'brands.id', '=', 'products.brand_id')->orderBy('brand_name')->get());

        $products = $this->query();

        return view('livewire.product-data-table', compact('products'));
    }

    public function query()
    {
        return Product::select('products.*', 'brands.name As brand_name', 'forms.name As form_name', 'categories.name As category_name', 'lines.name As line_name')
            ->leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftjoin('brands', 'brands.id', '=', 'products.brand_id')
            ->leftjoin('forms', 'forms.id', '=', 'products.form_id')
            ->leftjoin('lines', 'lines.id', '=', 'products.line_id')
            ->where('products.name', 'like', '%' . $this->search . '%')
            ->orWhere('products.volume', 'like', '%' . $this->search . '%')
            ->orWhere('products.price', 'like', '%' . $this->search . '%')
            ->orWhere('categories.name', 'like', '%' . $this->search . '%')
            ->orWhere('brands.name', 'like', '%' . $this->search . '%')
            ->orWhere('forms.name', 'like', '%' . $this->search . '%')
            ->orWhere('lines.name', 'like', '%' . $this->search . '%')
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
}
