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

    public $productName = "";
    public $active;

    protected $listeners = ['searchActive' => 'findProduct'];

    public function render()
    {
        if ($this->productName != "") {
            $reviews = Review::select('product_id', DB::raw("SUM(`score`) / COUNT(`score`) AS `avg_score`"), DB::raw("COUNT(`score`) AS `no_reviewers`"))
                ->groupBy('product_id')
                ->orderBy('avg_score', 'DESC')
                ->toSql();

            $products = Product::leftjoin(DB::raw('(' . $reviews . ')'.'AS reviews'), 'id', 'reviews.product_id')
                ->where('products.name', 'like', '%' . implode('%',explode('*',$this->productName))  . '%')
                ->paginate(10);

        } else {
            $products = '';
        }

        return view('livewire.search.home-search-result', compact('products'));
    }

    public function findProduct($productName, $active)
    {
        $this->productName = $productName;

        $this->active = $active;
    }
}
