<?php

namespace App\Http\Livewire\AdvancedSearch;

use App\Models\Ingredient;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class SearchIngredient extends Component
{
    use WithPagination;

    public $ingredientSearch = "";
    public $ingredients = Null;
    public $productDetails;
    public $highlightedIndex  = 0;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $products = Product::whereHas('ingredients', function ($query) {
            $query->where('name', 'like', '%' . str_replace('*', '%', $this->ingredientSearch) . '%');
        })
            ->where("approved", '=', 1)
            ->paginate(15);

        return view('livewire.advanced-search.search-ingredient', compact('products'));
    }

    public function updatedIngredientSearch($ingredientSearch)
    {
        $this->highlightedIndex = 0;
        $this->ingredients = Ingredient::where('name', 'like', '%' . str_replace('*', '%', $ingredientSearch) . '%')
            ->get()->take(5);
    }

    public function resetData()
    {
        $this->ingredientSearch = "";
        $this->ingredients = Null;
        $this->highlightedIndex = 0;
    }

    // Hide the Choices
    public function resetIngredients()
    {
        $this->ingredients = Null;
    }

    public function setIngredientSearch($ingredientName)
    {
        $this->ingredientSearch = $ingredientName;
        $this->ingredients = Null;
    }

    public function goUp()
    {

        if ($this->highlightedIndex == 0) {
            $this->highlightedIndex = count($this->ingredients);
        }
        $this->highlightedIndex--;
    }

    public function goDown()
    {
        if ($this->highlightedIndex == count($this->ingredients) - 1) {
            $this->highlightedIndex = -1;
        }
        $this->highlightedIndex++;
    }

    public function selectIngredient()
    {
        if (!empty($this->ingredients)) {
            $this->ingredientSearch = $this->ingredients->get($this->highlightedIndex)->name;
        }

        $this->ingredients = Null;
        $this->highlightedIndex = 0;
    }

    public function productDetails($product_id)
    {
        $this->productDetails = Product::with('form', 'line', 'brand', 'category', 'indications', 'ingredients', 'reviews')->findOrFail($product_id);
    }
}
