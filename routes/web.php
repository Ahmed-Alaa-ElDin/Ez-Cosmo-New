<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes(['verify' => true]);


Route::get('/', function () {
        
    return view('home');

})->name('home');


// Route::get('admin/login', function () {

//     return view('auth.admin.login');
    
// })->name('admin.login');

// Route::group(['middleware' => 'auth'], function () {

//     Route::group(['prefix' => 'admin', 'namespace' => 'Admin\\','as' => 'admin.'],function () {

//         Route::resource('users', UserController::class)->only('show', 'edit', 'update');
   
//     });

//     Route::group(['prefix' => 'admin', 'namespace' => 'Admin\\','as' => 'admin.', 'middleware' => 'admin'],function () {

//         Route::get('', 'DashboardController@index')->name('dashboard');

//         Route::resource('brands', BrandController::class);

//         Route::get('lines/{brand_id}/create', 'LineController@createSpecificBrand')->name('lines.create.brand');
//         Route::resource('lines', LineController::class);

//         Route::get('countries/{country}/users', 'CountryController@showUsers')->name('countries.show.users');
//         Route::get('countries/{country}/products', 'CountryController@showProducts')->name('countries.show.products');
//         Route::get('countries/{country}/brands', 'CountryController@showBrands')->name('countries.show.brands');
//         Route::resource('countries', CountryController::class);

//         Route::resource('categories', CategoryController::class);

//         Route::resource('indications', IndicationController::class);

//         Route::get('ingredients/get_ajax', 'IngredientController@getAjaxIngredient')->name('ingredients.get.ajax');
//         Route::post('ingredients/add_ajax', 'IngredientController@addAjaxIngredient')->name('ingredients.add.ajax');
//         Route::resource('ingredients', IngredientController::class);

//         Route::resource('forms', FormController::class);

//         Route::delete('products/{product}/images', 'ProductController@removeOldImg')->name('products.delete.images');
//         Route::post('products/{brand}/lines', 'ProductController@showlines')->name('products.show.lines');
//         Route::resource('products', ProductController::class);

//         Route::get('user/{id}', 'UserController@showJSON')->name('users.get.json');
//         Route::post('user_img/{id?}', 'UserController@updateProfilePhoto')->name('users.update.img');
//         Route::delete('user_img/{id}', 'UserController@deleteProfilePhoto')->name('users.delete.img');
//         Route::resource('users', UserController::class)->except('show', 'edit', 'update');


//         Route::post('review', 'ReviewController@store')->name('reviews.store');
//         Route::delete('review', 'ReviewController@destroy')->name('reviews.delete');
//     });
// });

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

// Auth::routes();