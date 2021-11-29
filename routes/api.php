<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;




Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
// Route::put('updatee/{id}', [ProductController::class, 'update2']);
Route::resource('products', ProductController::class);
Route::get('search/{category_id?}', [ProductController::class, 'get_list']);
Route::resource('categories', CategoryController::class);



     
Route::middleware('auth:api')->group( function () {
    
    Route::get('product', [ProductController::class, 'admin']);
});

Route::group(['middleware' => ['auth:api', 'RegisterUser']], function () {

    Route::get('registeredUser', [RegisterController::class, 'registeredUser']);

});

Route::group(['middleware' => ['auth:api', 'Vendor']], function () {

    Route::get('vendor', [RegisterController::class, 'vendor']);
    Route::get('vendorProducts', [ProductController::class, 'vendorProducts']);

});


Route::group(['middleware' => ['auth:api', 'SuperAdmin']], function () {

    Route::get('superAdmin', [RegisterController::class, 'superAdmin']);

});

