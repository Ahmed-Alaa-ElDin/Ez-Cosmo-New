<?php

namespace App\Http\Livewire\Search;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class HomeSearchResult extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';



    public $topRatedProducts, $newlyAddedProducts;
    public $productName, $product_id;
    public $active, $reviews, $productDetails;
    public $categoryID, $brandID, $lineID, $formID, $priceFrom, $priceTo, $rating;
    public $rating0, $rating1, $rating2, $rating3, $rating4;


    protected $listeners = [
        'searchActive' => 'findProduct',
        'updatedCategoryID',
        'updatedBrandID',
        'updatedLineID',
        'updatedFormID',
        'updatedPriceFrom',
        'updatedPriceTo',
        'updatedRating'
    ];

    public function mount()
    {

        $this->newlyAddedProducts = Product::with('form', 'line', 'brand', 'category', 'indications', 'ingredients', 'reviews')
            ->where("approved", '=', 1)
            ->orderBy('created_at', 'DESC')
            ->take(10)
            ->get();

        $this->priceFrom = Product::get()->pluck('price')->min();

        $this->priceTo = Product::get()->pluck('price')->max();

        $this->reviews = Review::select('product_id', DB::raw("SUM(`score`) / COUNT(`score`) AS `avg_score`"), DB::raw("COUNT(`score`) AS `no_reviewers`"))
            ->groupBy('product_id')
            ->toSql();
    }

    public function render()
    {
        $this->topRatedProducts = Review::leftjoin('products', 'reviews.product_id', 'products.id')
            ->with('product')
            ->selectRaw('product_id, SUM(`score`) / COUNT(`score`) AS `avg_score`, COUNT(`score`) AS `no_reviewers`')
            ->where('products.deleted_at', Null)
            ->where("approved", '=', 1)
            ->groupBy('product_id')
            ->orderBy('avg_score', 'DESC')
            ->take(10)
            ->get();


        if ($this->productName != "") {

            $productsSearchResults = Product::leftjoin(DB::raw('(' . $this->reviews . ')' . 'AS reviews'), 'id', 'reviews.product_id')
                // Search by Name    
                ->where('products.name', 'like', '%' . implode('%', explode('*', $this->productName))  . '%')
                // Search by Category    
                ->where(function ($q) {
                    if ($this->categoryID) {
                        $q->where("category_id", $this->categoryID);
                    }
                })
                // Search by Brand    
                ->where(function ($q) {
                    if ($this->brandID) {
                        $q->where("brand_id", $this->brandID);
                    }
                })
                // Search by Line    
                ->where(function ($q) {
                    if ($this->lineID) {
                        $q->where("line_id", $this->lineID);
                    }
                })
                // Search by Form    
                ->where(function ($q) {
                    if ($this->formID) {
                        $q->where("form_id", $this->formID);
                    }
                })
                // Search by Price    
                ->where(function ($q) {
                    if ($this->priceFrom && $this->priceTo) {
                        $q->whereBetween("price", [$this->priceFrom, $this->priceTo]);
                    }
                })
                // Search by Rating    
                ->where(function ($q) {
                    if ($this->rating) {
                        $q->where("reviews.avg_score", '>=', $this->rating);
                    }
                })
                // get only approved products 
                ->where("approved", '=', 1)

                // Order By Rating    
                ->orderBy('reviews.avg_score', 'DESC')
                // Get 10 By 10    
                ->paginate(10);

            $productsRating = Product::leftjoin(DB::raw('(' . $this->reviews . ')' . 'AS reviews'), 'id', 'reviews.product_id')
                // Search by Name    
                ->where('products.name', 'like', '%' . implode('%', explode('*', $this->productName))  . '%')
                // Search by Category    
                ->where(function ($q) {
                    if ($this->categoryID) {
                        $q->where("category_id", $this->categoryID);
                    }
                })
                // Search by Brand    
                ->where(function ($q) {
                    if ($this->brandID) {
                        $q->where("brand_id", $this->brandID);
                    }
                })
                // Search by Line    
                ->where(function ($q) {
                    if ($this->lineID) {
                        $q->where("line_id", $this->lineID);
                    }
                })
                // Search by Form    
                ->where(function ($q) {
                    if ($this->formID) {
                        $q->where("form_id", $this->formID);
                    }
                })
                // Search by Price    
                ->where(function ($q) {
                    if ($this->priceFrom && $this->priceTo) {
                        $q->whereBetween("price", [$this->priceFrom, $this->priceTo]);
                    }
                })
                // get only approved products 
                ->where("approved", '=', 1)

                // Order By Rating    
                ->orderBy('reviews.avg_score', 'DESC')
                // Get Results  
                ->get();


            // Send New Reviews Count
            $this->emit('ratingCountUpdate', [
                'rating0' => count($productsRating->where('avg_score', '>=', 0)),
                'rating1' => count($productsRating->where('avg_score', '>=', 1)),
                'rating2' => count($productsRating->where('avg_score', '>=', 2)),
                'rating3' => count($productsRating->where('avg_score', '>=', 3)),
                'rating4' => count($productsRating->where('avg_score', '>=', 4)),
            ]);
        } else {
            $productsSearchResults = Product::leftjoin(DB::raw('(' . $this->reviews . ')' . 'AS reviews'), 'id', 'reviews.product_id')
                // Search by Category    
                ->where(function ($q) {
                    if ($this->categoryID) {
                        $q->where("category_id", $this->categoryID);
                    }
                })
                // Search by Brand    
                ->where(function ($q) {
                    if ($this->brandID) {
                        $q->where("brand_id", $this->brandID);
                    }
                })
                // Search by Line    
                ->where(function ($q) {
                    if ($this->lineID) {
                        $q->where("line_id", $this->lineID);
                    }
                })
                // Search by Form    
                ->where(function ($q) {
                    if ($this->formID) {
                        $q->where("form_id", $this->formID);
                    }
                })
                // Search by Price    
                ->where(function ($q) {
                    if ($this->priceFrom && $this->priceTo) {
                        $q->whereBetween("price", [$this->priceFrom, $this->priceTo]);
                    }
                })
                // Search by Rating    
                ->where(function ($q) {
                    if ($this->rating) {
                        $q->where("reviews.avg_score", '>=', $this->rating);
                    }
                })
                // get only approved products 
                ->where("approved", '=', 1)

                // Order By Rating    
                ->orderBy('reviews.avg_score', 'DESC')
                // Get 10 By 10    
                ->paginate(10);
        }


        return view(
            'livewire.search.home-search-result',
            compact('productsSearchResults')
        );
    }

    // Listen to Nav Search Product
    public function findProduct($productName, $active)
    {
        $this->productName = $productName;

        $this->active = $active;

        $this->resetPage();
    }

    // Get Data From Nav Search Product Class
    public function updatedCategoryID($category_id)
    {
        $this->categoryID = $category_id;
    }

    public function updatedBrandID($brand_id)
    {
        $this->brandID = $brand_id;
        $this->lineID = Null;
    }

    public function updatedLineID($line_id)
    {
        $this->lineID = $line_id;
    }

    public function updatedFormID($form_id)
    {
        $this->formID = $form_id;
    }

    public function updatedPriceFrom($priceFrom)
    {
        $this->priceFrom = $priceFrom;
    }

    public function updatedPriceTo($priceTo)
    {
        $this->priceTo = $priceTo;
    }

    public function updatedRating($rating)
    {
        $this->rating = $rating;
    }

    public function productDetails($product_id)
    {
        $this->productDetails = Product::with('form', 'line', 'brand', 'category', 'indications', 'ingredients', 'reviews')->findOrFail($product_id);
    }
}
