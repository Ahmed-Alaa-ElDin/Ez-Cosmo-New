<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'user', 'namespace' => 'User\\', 'as' => 'user.'], function () {

    Route::get('search/ingredients',[HomeController::class , 'searchIngredients'])->name('search.ingredient');
    Route::get('search/indications',[HomeController::class , 'searchIndications'])->name('search.indication');
    Route::get('search/countries',[HomeController::class , 'searchCountries'])->name('search.country');

    Route::group(['middleware' => 'auth'], function () {

    });

});
