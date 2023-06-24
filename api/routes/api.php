<?php

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
    // 'middleware' => 'auth.api',
    'prefix' => 'products',
], function ($router) {
    Route::get('', [ProductController::class, 'get'])->name('get_products');
    Route::get('{product}', [ProductController::class, 'getProductById'])->name('get_product_by_id');
    Route::post('', [ProductController::class, 'store'])->name('create_products');
    Route::put("{product}", [ProductController::class, 'update'])->name('update_product');
    Route::delete("{product}", [ProductController::class, 'delete'])->name('delete_pruduct');
});
