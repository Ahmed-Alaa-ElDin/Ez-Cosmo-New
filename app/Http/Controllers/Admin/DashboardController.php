<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index ()
    {
        // Number off all users except admins
        $usersNum = User::where('role_id','!=','1')->count();

        // Number off all Products
        $productsNum = Product::count();

        // Number off all Reviews
        $reviewsNum = Review::count();

        // Number off all users' visits except admins
        $visitsNum = User::where('role_id','!=','1')->sum('visit_num');

        // get chart data
        // 1- Visits, Reviews, New users & Products in last 10 days 
        $usersPerDays = [];
        $productsPerDays = [];
        $visitsPerDays = [];
        $reviewsPerDays = [];

        $days = [];
        for ($i = 9, $x = 8; $i >= 0 ; $i--, $x--) {
            $dayOne = date('Y-m-d', strtotime("-$i day", strtotime(now())));
            $dayTwo = date('Y-m-d', strtotime("-$x day", strtotime(now())));
            $newUsersCount = User::whereBetween('created_at',[$dayOne,$dayTwo])->count();
            $newProductsCount = Product::whereBetween('created_at',[$dayOne,$dayTwo])->count();
            $visitsCount = User::where('role_id','!=','1')->whereBetween('last_visit',[$dayOne,$dayTwo])->count(); 
            $reviewsCount = Review::whereBetween('created_at',[$dayOne,$dayTwo])->count(); 
            
            array_push($usersPerDays,$newUsersCount);
            array_push($productsPerDays,$newProductsCount);
            array_push($visitsPerDays,$visitsCount);
            array_push($reviewsPerDays,$reviewsCount);
            array_push($days,date('m/d', strtotime("-$i day", strtotime(now()))));
        };
        // dd($reviewsPerDays);

        // 2- new users & Products in last Year / Month
        $usersPerMonths = [];
        $productsPerMonths = [];
        $visitsPerMonths = [];
        $reviewsPerMonths = [];
        $months = [];
        for ($i = 11, $x = 10 ; $i >= 0 ; $i--, $x--) {
            $monthOne = date('Y-m-1', strtotime("-$i month", strtotime(now())));
            $monthTwo = date('Y-m-1', strtotime("-$x month", strtotime(now())));
            $newUsersCount = User::whereBetween('created_at',[$monthOne,$monthTwo])->count();
            $newProductsCount = Product::whereBetween('created_at',[$monthOne,$monthTwo])->count();
            $visitsCount = User::where('role_id','!=','1')->whereBetween('last_visit',[$monthOne,$monthTwo])->count();
            $reviewsCount = Review::whereBetween('created_at',[$monthOne,$monthTwo])->count(); 


            array_push($usersPerMonths,$newUsersCount);
            array_push($productsPerMonths,$newProductsCount);
            array_push($visitsPerMonths,$visitsCount);
            array_push($reviewsPerMonths,$reviewsCount);
            array_push($months,date('M Y', strtotime("-$i month", strtotime(date('01-m-Y')))));
        };

        // Top 10 Visitors Last Week
        $topTenVisitsWeek = User::where('visit_num','>','0')->where('role_id','!=','1')->whereBetween('last_visit',[date('Y-m-d', strtotime("-7 days", strtotime(now()))),now()])->orderBy('visit_num', 'desc')->get();
        // Top 10 Visitors Last Year
        $topTenVisitsYear = User::where('visit_num','>','0')->where('role_id','!=','1')->whereBetween('last_visit',[date('Y-m-d', strtotime("-12 months", strtotime(now()))),now()])->orderBy('visit_num', 'desc')->get();

        // Top 10 Reviewer Last Week
        $topTenReviewersW = Review::groupBy('user_id')->selectRaw('count(*) as total, user_id')->whereBetween('created_at',[date('Y-m-d', strtotime("-7 days", strtotime(now()))),now()])->orderBy('total', 'desc')->paginate(10);
        $topTenReviewersWeek = [];
        foreach ($topTenReviewersW as $topTenReviewer) {
            $user = User::find($topTenReviewer->user_id);
            $country = $user->country->name;
            $person = [
                'name' => $user->first_name . ' ' . $user->last_name,
                'country' => $country,
                'reviews' => $topTenReviewer->total,
            ];
            array_push($topTenReviewersWeek, $person);
        };

        // Top 10 Reviewer Last Year
        $topTenReviewersY = Review::groupBy('user_id')->selectRaw('count(*) as total, user_id')->whereBetween('created_at',[date('Y-m-d', strtotime("-12 months", strtotime(now()))),now()])->orderBy('total', 'desc')->paginate(10);
        $topTenReviewersYear = [];
        foreach ($topTenReviewersY as $topTenReviewer) {
            $user = User::find($topTenReviewer->user_id);
            $country = $user->country->name;
            $person = [
                'name' => $user->first_name . ' ' . $user->last_name,
                'country' => $country,
                'reviews' => $topTenReviewer->total,
            ];
            array_push($topTenReviewersYear, $person);
        };

        // Last 10 Products
        $lastTenProducts = Product::orderBy('created_at','desc')->paginate(10);

        // Last 10 Users
        $lastTenUsers = User::orderBy('created_at','desc')->paginate(10);


        // dd($lastTenProducts);

        return view('admin.dashboard', compact([
            'usersNum',
            'productsNum',
            'reviewsNum',
            'visitsNum',
            'usersPerDays',
            'productsPerDays', 
            'visitsPerDays', 
            'reviewsPerDays',
            'days', 
            'usersPerMonths',
            'productsPerMonths', 
            'visitsPerMonths', 
            'reviewsPerMonths', 
            'months',
            'topTenVisitsWeek', 
            'topTenVisitsYear', 
            'topTenReviewersWeek', 
            'topTenReviewersYear',
            'lastTenProducts',
            'lastTenUsers'
            ]));

    }

}
