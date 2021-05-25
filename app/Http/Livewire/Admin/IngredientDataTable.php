<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ingredient;
use Livewire\Component;
use Livewire\WithPagination;

class IngredientDataTable extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $sortBy = 'name';
    
    public $sortDirection = 'ASC';
    
    public $perPage = 10;
    
    public $search = "";
    
    public $ingredient_id, $ingredient_name;


    public function render()
    {

        $ingredients = $this->query();

        return view('livewire.admin.ingredients.ingredient-data-table', compact('ingredients'));
    }

    public function query()
    {
        return Ingredient::where('ingredients.name', 'like', '%' . $this->search . '%')
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

    public function load($ingredient_id, $ingredient_name)
    {
        $this->ingredient_id = $ingredient_id;
        $this->ingredient_name = $ingredient_name; 
    }

    public function deleteIngredient($ingredient_id)
    {
        Ingredient::find($ingredient_id)->delete();

        $this->emit('success', ['type' => 'success', 'message' => "$this->ingredient_name has been Deleted Successfully."]);
    }
}
