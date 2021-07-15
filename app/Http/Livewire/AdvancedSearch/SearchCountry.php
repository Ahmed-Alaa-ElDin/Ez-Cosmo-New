<?php

namespace App\Http\Livewire\AdvancedSearch;

use App\Models\Country;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class SearchCountry extends Component
{
    use WithPagination;

    public $countrySearch = "";
    public $countries = Null;
    public $productDetails;
    public $highlightedIndex  = 0;
    protected $paginationTheme = 'bootstrap';

    // Excuted when component rendered
    public function render()
    {
        $products = Product::whereHas('brand.country', function ($query) {
            $query->where('name', 'like', '%' . str_replace('*', '%', $this->countrySearch) . '%');
        })
        ->where("approved", '=', 1)
        ->paginate(15);

        return view('livewire.advanced-search.search-country', compact('products'));
    }

    // Excute Searching
    public function updatedCountrySearch($countrySearch)
    {
        $this->highlightedIndex = 0;
        $this->countries = Country::where('name', 'like', '%' . str_replace('*', '%', $countrySearch) . '%')
            ->get()->take(5);
    }

    // Reset all Component
    public function resetData()
    {
        $this->countrySearch = "";
        $this->countries = Null;
        $this->highlightedIndex = 0;
    }

    // Hide the Choices
    public function resetCountries()
    {
        $this->countries = Null;
    }

    public function setCountrySearch($countryName)
    {
        $this->countrySearch = $countryName;
        $this->countries = Null;
    }

    public function goUp()
    {

        if ($this->highlightedIndex == 0) {
            $this->highlightedIndex = count($this->countries);
        }
        $this->highlightedIndex--;
    }

    public function goDown()
    {
        if ($this->highlightedIndex == count($this->countries) - 1) {
            $this->highlightedIndex = -1;
        }
        $this->highlightedIndex++;
    }

    public function selectCountry()
    {
        if (!empty($this->countries)) {
            $this->countrySearch = $this->countries->get($this->highlightedIndex)->name;
        }

        $this->countries = Null;
        $this->highlightedIndex = 0;
    }

    public function productDetails($product_id)
    {
        $this->productDetails = Product::with('form', 'line', 'brand', 'category', 'indications', 'ingredients', 'reviews')->findOrFail($product_id);
    }
}
