<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'user', 'namespace' => 'User\\', 'as' => 'user.', 'middleware' => 'auth'], function () {

    Route::resource('products', ProductController::class);

});
