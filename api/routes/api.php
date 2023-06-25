<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix'     => 'auth',

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    // Route::post('refresh', 'AuthController@refresh');
    // Route::post('me', 'AuthController@me');

});

Route::group([
    'middleware' => 'api',
    'prefix'     => 'products',
], function ($router) {
    Route::get('', [ProductController::class, 'get'])->name('get_products');
    Route::get('{product}', [ProductController::class, 'getProductById'])->name('get_product_by_id');
    Route::post('', [ProductController::class, 'store'])->name('create_products');
    Route::put("{product}", [ProductController::class, 'update'])->name('update_product');
    Route::delete("{product}", [ProductController::class, 'delete'])->name('delete_pruduct');
});

Route::group([
    'middleware' => 'auth',
    'prefix'     => 'orders',
], function ($router) {
    Route::get('', [OrderController::class, 'get'])->name('get_orders');
    Route::get('{order}', [OrderController::class, 'getOrderById'])->name('get_order_by_id');
    Route::get('user/{user}', [OrderController::class, 'ordersByUser'])->name('get_order_by_user');
    Route::post('', [OrderController::class, 'store'])->name('create_order');
    Route::put('{order}', [OrderController::class, 'update'])->name('update_order');
    Route::delete('{order}', [OrderController::class, 'delete'])->name('delete_order');
});
