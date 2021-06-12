<?php

namespace App\Http\Livewire\Admin;

use App\Models\EditedProduct;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EditedProductDataTable extends Component
{

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $sortBy = 'products.name';

    public $sortDirection = 'ASC';

    public $perPage = 10;

    public $search = "";


    public $name, $product_id, $origin = "";
    public $category, $brand, $line, $directions, $notes, $advantages, $disadvantages, $form, $volume, $units, $price, $code = "";
    public $images, $indications, $ingredients, $reviews = [];

    public function render()
    {
        $products = $this->query();

        return view('livewire.admin.products.edited-product-data-table', compact('products'));
    }

    public function query()
    {
        return EditedProduct::select('products.name', 'edited_products.id', 'edited_products.product_id', 'edited_products.request_type', 'edited_products.created_by', 'edited_products.created_at', 'users.first_name', 'users.last_name')
            ->leftjoin('products', 'products.id', '=', 'edited_products.product_id')
            ->leftjoin('users', 'users.id', '=', 'edited_products.created_by')
            ->where('products.name', 'like', '%' . $this->search . '%')
            ->orWhere('users.first_name', 'like', '%' . $this->search . '%')
            ->orWhere('users.last_name', 'like', '%' . $this->search . '%')
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

    public function load($id)
    {
        $this->product_id = $id;
    }


    public function ignoreEdit($product_id)
    {
        EditedProduct::findOrFail($product_id)->delete();

        $this->emit('success', ['type' => 'success', 'message' => "$this->name has been Deleted Successfully."]);
    }
}
