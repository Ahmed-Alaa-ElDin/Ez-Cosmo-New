<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'namespace' => 'Admin\\', 'as' => 'admin.', 'middleware' => 'admin'], function () {

    Route::get('', 'DashboardController@index')->name('dashboard');
    
    Route::get('brandslines/exportexcel/{brand}', 'BrandController@exportLineExcel')->name('brandsline.exportExcel');
    Route::get('brandslines/exportpdf/{brand}', 'BrandController@exportLinePDF')->name('brandsline.exportPDF');
    Route::get('brands/exportexcel', 'BrandController@exportExcel')->name('brands.exportExcel');
    Route::get('brands/exportpdf', 'BrandController@exportPDF')->name('brands.exportPDF');
    Route::resource('brands', BrandController::class);

    Route::get('lines/exportexcel/{line}', 'LineController@exportProductExcel')->name('linesproduct.exportExcel');
    Route::get('lines/exportpdf/{line}', 'LineController@exportProductPDF')->name('linesproduct.exportPDF');
    Route::get('lines/exportexcel', 'LineController@exportExcel')->name('lines.exportExcel');
    Route::get('lines/exportpdf', 'LineController@exportPDF')->name('lines.exportPDF');
    Route::get('lines/{brand_id}/create', 'LineController@createSpecificBrand')->name('lines.create.brand');
    Route::resource('lines', LineController::class);

    Route::get('countries/{country}/users', 'CountryController@showUsers')->name('countries.show.users');
    Route::get('countries/{country}/products', 'CountryController@showProducts')->name('countries.show.products');
    Route::get('countries/{country}/brands', 'CountryController@showBrands')->name('countries.show.brands');
    Route::resource('countries', CountryController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('indications', IndicationController::class);

    Route::get('ingredients/exportexcel', 'IngredientController@exportExcel')->name('ingredients.exportExcel');
    Route::get('ingredients/exportpdf', 'IngredientController@exportPDF')->name('ingredients.exportPDF');
    Route::get('ingredients/get_ajax', 'IngredientController@getAjaxIngredient')->name('ingredients.get.ajax');
    Route::post('ingredients/add_ajax', 'IngredientController@addAjaxIngredient')->name('ingredients.add.ajax');
    Route::resource('ingredients', IngredientController::class);

    Route::resource('forms', FormController::class);

    Route::delete('products/{product}/images', 'ProductController@removeOldImg')->name('products.delete.images');
    Route::get('products/exportexcel', 'ProductController@exportExcel')->name('products.exportExcel');
    Route::get('products/exportpdf', 'ProductController@exportPDF')->name('products.exportPDF');
    Route::post('products/{brand}/lines', 'ProductController@showlines')->name('products.show.lines');
    Route::resource('products', ProductController::class);

    Route::get('users/exportexcel', 'UserController@exportExcel')->name('users.exportExcel');
    Route::get('users/exportpdf', 'UserController@exportPDF')->name('users.exportPDF');
    Route::get('user/{id}/roles', 'UserController@showRoles')->name('users.show.roles');
    Route::post('user/{id}/roles', 'UserController@updateRoles')->name('users.update.roles');
    Route::get('user/{id}', 'UserController@showJSON')->name('users.get.json');
    Route::post('user_img/{id?}', 'UserController@updateProfilePhoto')->name('users.update.img');
    Route::delete('user_img/{id}', 'UserController@deleteProfilePhoto')->name('users.delete.img');
    Route::resource('users', UserController::class);


    Route::post('review', 'ReviewController@store')->name('reviews.store');
    Route::delete('review', 'ReviewController@destroy')->name('reviews.delete');

    Route::resource('roles', RoleController::class);

});
