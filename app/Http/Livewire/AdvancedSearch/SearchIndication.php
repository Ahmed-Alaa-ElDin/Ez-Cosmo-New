<?php

namespace App\Http\Livewire\AdvancedSearch;

use App\Models\Indication;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class SearchIndication extends Component
{
    use WithPagination;

    public $indicationSearch = "";
    public $indications = Null;
    public $productDetails;
    public $highlightedIndex  = 0;
    protected $paginationTheme = 'bootstrap';

    // Excuted when component rendered
    public function render()
    {
        $products = Product::whereHas('indications', function ($query) {
            $query->where('name', 'like', '%' . str_replace('*', '%', $this->indicationSearch) . '%');
        })->paginate(15);

        return view('livewire.advanced-search.search-indication', compact('products'));
    }

    // Excute Searching
    public function updatedIndicationSearch($indicationSearch)
    {
        $this->highlightedIndex = 0;
        $this->indications = Indication::where('name', 'like', '%' . str_replace('*', '%', $indicationSearch) . '%')
            ->get()->take(5);
    }

    // Reset all Component
    public function resetData()
    {
        $this->indicationSearch = "";
        $this->indications = Null;
        $this->highlightedIndex = 0;
    }
    
    // Hide the Choices
    public function resetIndications()
    {
        $this->indications = Null;
    }

    public function setIndicationSearch($indicationName)
    {
        $this->indicationSearch = $indicationName;
        $this->indications = Null;
    }

    public function goUp()
    {

        if ($this->highlightedIndex == 0) {
            $this->highlightedIndex = count($this->indications);
        }
        $this->highlightedIndex--;
    }

    public function goDown()
    {
        if ($this->highlightedIndex == count($this->indications) - 1) {
            $this->highlightedIndex = -1;
        }
        $this->highlightedIndex++;
    }

    public function selectIndication()
    {
        if (!empty($this->indications)) {
        $this->indicationSearch = $this->indications->get($this->highlightedIndex)->name;
        }

        $this->indications = Null;
        $this->highlightedIndex = 0;
    }

    public function productDetails($product_id)
    {
        $this->productDetails = Product::with('form', 'line', 'brand', 'category', 'indications', 'ingredients', 'reviews')->findOrFail($product_id);
    }

}
