<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        return view('user.home');
    }
    
    public function searchIngredients()
    {
        return view('user.search.search-ingredient');
    }

    public function searchIndications()
    {
        return view('user.search.search-indication');
    }

    public function searchCountries()
    {
        return view('user.search.search-indication');
    }


}
