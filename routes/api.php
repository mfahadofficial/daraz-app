<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;




Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::get('abc', [RegisterController::class, 'abc']);
     
Route::middleware('auth:api')->group( function () {
    Route::resource('products', ProductController::class);
});

Route::group(['middleware' => ['auth:api', 'role']], function () {

    Route::get('admin', [ProductController::class, 'admin']);

});

