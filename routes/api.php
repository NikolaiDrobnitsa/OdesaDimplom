<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes for categories
Route::get('categories', [CategoryController::class, 'index']);
Route::post('add/category', [CategoryController::class, 'store']);
Route::post('update/category/{id}', [CategoryController::class, 'update']);
Route::get('delete/category/{id}', [CategoryController::class, 'destroy']);

// Routes for products
Route::post('add/product', [ProductController::class, 'store']);
Route::get('products', [ProductController::class, 'index']);
Route::get('delete/product/{id}', [ProductController::class, 'destroy']);
Route::post('update/product/{id}', [ProductController::class, 'update']);
Route::get('latestProducts', [ProductController::class, 'latestProducts']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::post('update/product/{id}/image/{imageIndex}', [ProductController::class, 'updateImage']);
Route::post('swapImageNames/{productId}', [ProductController::class, 'swapImageNames']);


Route::get('booking', [BookingController::class, 'index']);
Route::get('bookings/{productId}', [BookingController::class, 'booking']);
Route::post('book', [BookingController::class, 'store']);

Route::post('add/booking', [BookingController::class, 'store']);
Route::post('update/booking/{id}', [BookingController::class, 'update']);
Route::get('delete/booking/{id}', [BookingController::class, 'destroy']);
//Route::get('bookings/search', [BookingController::class, 'search']);
//Route::get('bookings/search', [BookingController::class, 'search']);

//Route::get('/bookings/search', 'BookingController@search');

//Route::post('book', [BookingController::class, 'store']);
