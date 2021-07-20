<?php

namespace App\Http\Livewire\Admin;

use App\Models\EditedProduct;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EditedProductDataTable extends Component
{

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $sortBy = 'edited_products.created_at';
    public $sortNewBy = 'products.created_at';


    public $sortDirection = 'DESC';
    public $sortNewDirection = 'DESC';


    public $perPage = 10;
    public $perNewPage = 10;


    public $search = "";
    public $newSearch = "";


    public $name, $product_id, $origin = "";
    public $category, $brand, $line, $directions, $notes, $advantages, $disadvantages, $form, $volume, $units, $price, $code = "";
    public $images, $indications, $ingredients, $reviews = [];

    public function render()
    {
        $editedProducts = $this->editedQuery();
        $newProducts = $this->newQuery();

        return view('livewire.admin.products.edited-product-data-table', compact('editedProducts','newProducts'));
    }

    public function editedQuery()
    {
        return EditedProduct::select('products.name', 'edited_products.id', 'edited_products.product_id', 'edited_products.request_type', 'edited_products.created_by', 'edited_products.request_type', 'edited_products.created_at', 'users.first_name', 'users.last_name')
            ->leftjoin('products', 'products.id', '=', 'edited_products.product_id')
            ->leftjoin('users', 'users.id', '=', 'edited_products.created_by')
            ->where('edited_products.approved', 0)
            ->where(function ($q) {
                return $q->where('products.name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.last_name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function newQuery()
    {
        return Product::select('products.name', 'products.id', 'products.created_by', 'products.created_at', 'users.first_name', 'users.last_name')
            ->leftjoin('users', 'users.id', '=', 'products.created_by')
            ->where('products.approved', 0)
            ->where(function ($q) {
                return $q->where('products.name', 'like', '%' . $this->newSearch . '%')
                    ->orWhere('users.first_name', 'like', '%' . $this->newSearch . '%')
                    ->orWhere('users.last_name', 'like', '%' . $this->newSearch . '%');
            })
            ->orderBy($this->sortNewBy, $this->sortNewDirection)
            ->paginate($this->perNewPage);
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

    public function sortNewBy($field)
    {

        if ($this->sortNewDirection == 'ASC') {
            $this->sortNewDirection = 'DESC';
        } else {
            $this->sortNewDirection = 'ASC';
        }

        return $this->sortNewBy = $field;
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
        // change the status of Edited product to be rejected and disappearing it
        EditedProduct::findOrFail($product_id)->update([
            'approved' => 2
        ]);

        // rerender with success message
        $this->emit('success', ['type' => 'success', 'message' => "Request has been Ignored."]);
    }

    public function ignoreNew($product_id)
    {
        // change the status of Edited product to be rejected and disappearing it
        Product::findOrFail($product_id)->update([
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        // rerender with success message
        $this->emit('success', ['type' => 'success', 'message' => "Request has been Ignored."]);
    }

    public function acceptNew($product_id)
    {
        // change the status of Edited product to be rejected and disappearing it
        Product::findOrFail($product_id)->update([
            'approved' => 1
        ]);

        // rerender with success message
        $this->emit('success', ['type' => 'success', 'message' => "Request has been Accepted."]);
    }

    public function deleteProduct($product_id)
    {
        $deletedProductId = EditedProduct::select('product_id')->where('id', $product_id)->firstOrFail()->product_id;

        // Soft Delete Old Product
        Product::findOrFail($deletedProductId)->delete();

        // change the status of Edited product to be approved and disappearing it
        EditedProduct::findOrFail($product_id)->update([
            'approved' => 1
        ]);

        // rerender with success message
        $this->emit('success', ['type' => 'success', 'message' => "$this->name has been Deleted Successfully."]);
    }
}
