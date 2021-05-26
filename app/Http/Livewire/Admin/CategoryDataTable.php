<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryDataTable extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $sortBy = 'name';
    
    public $sortDirection = 'ASC';
    
    public $perPage = 10;
    
    public $search = "";
    
    public $category_id, $category_name;

    public function render()
    {
        $categories = $this->query();

        return view('livewire.admin.categories.category-data-table', compact('categories'));
    }

    public function query()
    {
        return Category::where('categories.name', 'like', '%' . $this->search . '%')
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

    public function load($category_id, $category_name)
    {
        $this->category_id = $category_id;
        $this->category_name = $category_name; 
    }

    public function deleteCategory($category_id)
    {
        Category::findOrFail($category_id)->delete();

        $this->emit('success', ['type' => 'success', 'message' => "$this->category_name has been Deleted Successfully."]);
    }

}
