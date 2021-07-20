<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'namespace' => 'Admin\\', 'as' => 'admin.', 'middleware' => 'admin'], function () {

    // Admin Dashboard
    Route::get('', 'DashboardController@index')->name('dashboard');
    
    // Brand Class
    Route::get('brandslines/exportexcel/{brand}', 'BrandController@exportLineExcel')->name('brandsline.exportExcel');
    Route::get('brandslines/exportpdf/{brand}', 'BrandController@exportLinePDF')->name('brandsline.exportPDF');
    Route::get('brands/exportexcel', 'BrandController@exportExcel')->name('brands.exportExcel');
    Route::get('brands/exportpdf', 'BrandController@exportPDF')->name('brands.exportPDF');
    Route::resource('brands', BrandController::class);

    // Line Class
    Route::get('lines/exportexcel/{line}', 'LineController@exportProductExcel')->name('linesproduct.exportExcel');
    Route::get('lines/exportpdf/{line}', 'LineController@exportProductPDF')->name('linesproduct.exportPDF');
    Route::get('lines/exportexcel', 'LineController@exportExcel')->name('lines.exportExcel');
    Route::get('lines/exportpdf', 'LineController@exportPDF')->name('lines.exportPDF');
    Route::get('lines/{brand_id}/create', 'LineController@createSpecificBrand')->name('lines.create.brand');
    Route::resource('lines', LineController::class);

    // Country Class
    Route::get('countries/exportexcel/{country}/users', 'CountryController@exportUserExcel')->name('countriesuser.exportExcel');
    Route::get('countries/exportpdf/{country}/users', 'CountryController@exportUserPDF')->name('countriesuser.exportPDF');
    Route::get('countries/exportexcel/{country}/products', 'CountryController@exportProductExcel')->name('countriesproduct.exportExcel');
    Route::get('countries/exportpdf/{country}/products', 'CountryController@exportProductPDF')->name('countriesproduct.exportPDF');
    Route::get('countries/exportexcel/{country}/brands', 'CountryController@exportBrandExcel')->name('countriesbrand.exportExcel');
    Route::get('countries/exportpdf/{country}/brands', 'CountryController@exportBrandPDF')->name('countriesbrand.exportPDF');
    Route::get('countries/exportexcel', 'CountryController@exportExcel')->name('countries.exportExcel');
    Route::get('countries/exportpdf', 'CountryController@exportPDF')->name('countries.exportPDF');
    Route::get('countries/{country}/users', 'CountryController@showUsers')->name('countries.show.users');
    Route::get('countries/{country}/products', 'CountryController@showProducts')->name('countries.show.products');
    Route::get('countries/{country}/brands', 'CountryController@showBrands')->name('countries.show.brands');
    Route::resource('countries', CountryController::class);

    // Category Class
    Route::get('categories/exportexcel/{category}', 'CategoryController@exportProductExcel')->name('categoriesproduct.exportExcel');
    Route::get('categories/exportpdf/{category}', 'CategoryController@exportProductPDF')->name('categoriesproduct.exportPDF');
    Route::get('categories/exportexcel', 'CategoryController@exportExcel')->name('categories.exportExcel');
    Route::get('categories/exportpdf', 'CategoryController@exportPDF')->name('categories.exportPDF');
    Route::resource('categories', CategoryController::class);

    // Indication Class
    Route::get('indications/exportexcel/{indication}', 'IndicationController@exportProductExcel')->name('indicationsproduct.exportExcel');
    Route::get('indications/exportpdf/{indication}', 'IndicationController@exportProductPDF')->name('indicationsproduct.exportPDF');
    Route::get('indications/exportexcel', 'IndicationController@exportExcel')->name('indications.exportExcel');
    Route::get('indications/exportpdf', 'IndicationController@exportPDF')->name('indications.exportPDF');
    Route::resource('indications', IndicationController::class);

    // Ingredient Class
    Route::get('ingredients/exportexcel/{ingredient}', 'IngredientController@exportProductExcel')->name('ingredientsproduct.exportExcel');
    Route::get('ingredients/exportpdf/{ingredient}', 'IngredientController@exportProductPDF')->name('ingredientsproduct.exportPDF');
    Route::get('ingredients/exportexcel', 'IngredientController@exportExcel')->name('ingredients.exportExcel');
    Route::get('ingredients/exportpdf', 'IngredientController@exportPDF')->name('ingredients.exportPDF');
    Route::get('ingredients/get_ajax', 'IngredientController@getAjaxIngredient')->name('ingredients.get.ajax');
    Route::post('ingredients/add_ajax', 'IngredientController@addAjaxIngredient')->name('ingredients.add.ajax');
    Route::resource('ingredients', IngredientController::class);

    // Form Class
    Route::get('forms/exportexcel/{form}', 'FormController@exportProductExcel')->name('formsproduct.exportExcel');
    Route::get('forms/exportpdf/{form}', 'FormController@exportProductPDF')->name('formsproduct.exportPDF');
    Route::get('forms/exportexcel', 'FormController@exportExcel')->name('forms.exportExcel');
    Route::get('forms/exportpdf', 'FormController@exportPDF')->name('forms.exportPDF');
    Route::resource('forms', FormController::class);

    // Product Class
    Route::delete('products/{product}/images', 'ProductController@removeOldImg')->name('products.delete.images');
    Route::get('products/exportexcel', 'ProductController@exportExcel')->name('products.exportExcel');
    Route::get('products/exportpdf', 'ProductController@exportPDF')->name('products.exportPDF');
    Route::post('products/{brand}/lines', 'ProductController@showlines')->name('products.show.lines');
    Route::get('products/deleted', 'ProductController@viewDeletedProducts')->name('products.deleted');
    // Route::post('products', 'ProductController@index')->name('products.index');
    Route::resource('products', ProductController::class);
    
    // Edited Products Class
    Route::resource('edited_products', EditedProductController::class);

    // User Class
    Route::get('users/exportexcel', 'UserController@exportExcel')->name('users.exportExcel');
    Route::get('users/exportpdf', 'UserController@exportPDF')->name('users.exportPDF');
    Route::get('user/{id}/roles', 'UserController@showRoles')->name('users.show.roles');
    Route::post('user/{id}/roles', 'UserController@updateRoles')->name('users.update.roles');
    Route::get('user/{id}', 'UserController@showJSON')->name('users.get.json');
    Route::post('user_img/{id?}', 'UserController@updateProfilePhoto')->name('users.update.img');
    Route::delete('user_img/{id}', 'UserController@deleteProfilePhoto')->name('users.delete.img');
    Route::resource('users', UserController::class);

    // Review Class
    Route::post('review', 'ReviewController@store')->name('reviews.store');
    Route::delete('review', 'ReviewController@destroy')->name('reviews.delete');

    // Roles Class
    Route::resource('roles', RoleController::class);

    // Notification Class
    Route::get('notification/{id}','NotificationController@redirection')->name('notification');
    // Route::get('notification/{$notification_id}/product/{product_id}/link/{link}','NotificationController@redirection')->name('notification');
});
