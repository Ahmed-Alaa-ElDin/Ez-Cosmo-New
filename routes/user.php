<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'user', 'namespace' => 'User\\', 'as' => 'user.'], function () {

    Route::get('search/ingredients', [HomeController::class, 'searchIngredients'])->name('search.ingredient');
    Route::get('search/indications', [HomeController::class, 'searchIndications'])->name('search.indication');
    Route::get('search/countries', [HomeController::class, 'searchCountries'])->name('search.country');

    Route::group(['middleware' => 'auth'], function () {
        // Route::get('products/{id}/edit', 'ProductController@edit')->name('products.edit.request');
        Route::post('ingredients/add_ajax', 'ProductController@addAjaxIngredient')->name('ingredients.add.ajax');
        Route::get('ingredients/get_ajax', 'ProductController@getAjaxIngredient')->name('ingredients.get.ajax');
        Route::post('products/{brand}/lines', 'ProductController@showlines')->name('products.show.lines');
        Route::resource('products', ProductController::class);
    });
});
