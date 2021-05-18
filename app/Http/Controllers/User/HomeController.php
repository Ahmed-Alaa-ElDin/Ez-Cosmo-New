<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $topRatedProducts = Review::with('product')->select('product_id', DB::raw("SUM(`score`) / COUNT(`score`) AS `avg_score`"), DB::raw("COUNT(`score`) AS `no_reviewers`"))->groupBy('product_id')->orderBy('avg_score','DESC')->paginate(10);

        return view('user.home', compact('topRatedProducts'));
    }
}
