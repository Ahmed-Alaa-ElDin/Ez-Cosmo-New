<?php

namespace App\Http\Livewire\Search;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Form;
use App\Models\Line;
use App\Models\Product;
use App\Models\Review;
use Livewire\Component;

class NavSearchProduct extends Component
{
    public $search, $categories, $brands, $lines, $forms, $rating0, $rating1, $rating2, $rating3, $rating4;
    public $categoryID, $brandID, $lineID, $formID, $priceFrom, $priceTo;
    public $rating = 0;

    protected $listeners = ['ratingCountUpdate'];


    public function mount()
    {
        $this->priceFrom = Product::get()->pluck('price')->min();
        $this->priceTo = Product::get()->pluck('price')->max();
        $this->rating0 = Product::count();
        $this->rating1 = Product::select('products.id','reviews.score')->leftjoin('reviews','products.id','reviews.product_id')->where('reviews.score', '>=', 1)->distinct('product_id')->count();
        $this->rating2 = Product::select('products.id','reviews.score')->leftjoin('reviews','products.id','reviews.product_id')->where('reviews.score', '>=', 2)->distinct('product_id')->count();
        $this->rating3 = Product::select('products.id','reviews.score')->leftjoin('reviews','products.id','reviews.product_id')->where('reviews.score', '>=', 3)->distinct('product_id')->count();
        $this->rating4 = Product::select('products.id','reviews.score')->leftjoin('reviews','products.id','reviews.product_id')->where('reviews.score', '>=', 4)->distinct('product_id')->count();
        $this->categories = Category::all();
        $this->brands = Brand::all();
        $this->forms = Form::all();
    }

    public function render()
    {
        return view('livewire.search.nav-search-product');
    }

    public function updatedSearch()
    {
        if ($this->search != "") {
            $this->emit('searchActive', $this->search, true);
        } else {
            $this->mount();
            $this->emit('searchActive', $this->search, false);
        }
    }

    public function updatedCategoryID()
    {
        $this->emit('updatedCategoryID', $this->categoryID);
    }

    public function updatedBrandID($brand_id  = '')
    {
        $this->lines = Line::where('brand_id', $brand_id)->get();

        $this->emit('updatedBrandID', $this->brandID);
    }

    public function updatedLineID()
    {
        $this->emit('updatedLineID', $this->lineID);
    }

    public function updatedFormID()
    {
        $this->emit('updatedFormID', $this->formID);
    }

    public function updatedPriceFrom()
    {
        $this->emit('updatedPriceFrom', $this->priceFrom);
    }

    public function updatedPriceTo()
    {
        $this->emit('updatedPriceTo', $this->priceTo);
    }

    public function updatedRating()
    {
        $this->emit('updatedRating', $this->rating);
    }


    public function ratingCountUpdate($rating)
    {
        $this->rating0 = $rating['rating0'];
        $this->rating1 = $rating['rating1'];
        $this->rating2 = $rating['rating2'];
        $this->rating3 = $rating['rating3'];
        $this->rating4 = $rating['rating4'];
    }

    public function clearFilter()
    {
        $this->reset(['categoryID', 'brandID', 'lineID', 'formID', 'priceFrom', 'priceTo', 'rating']);
        $this->emit('updatedCategoryID', '');
        $this->emit('updatedBrandID', '');
        $this->emit('updatedLineID', '');
        $this->emit('updatedFormID', '');
        $this->emit('updatedPriceFrom', $this->priceFrom);
        $this->emit('updatedPriceTo', $this->priceTo);
        $this->emit('updatedRating', 0);
        
        $this->mount();

    }
}
