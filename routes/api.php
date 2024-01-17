<?php

use App\Http\Controllers\Api\V1\Shop\ShopController;
use App\Http\Controllers\Api\V1\Tokens\TokenController;
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

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    Route::group(['namespace' => 'Token', 'prefix' => 'token'], function () {
        Route::get('/', [TokenController::class, 'list'])->name('api.v1.token.list');
        Route::post('/', [TokenController::class, 'storeOrUpdate'])->name('api.v1.token.store');
        Route::post('/restore', [TokenController::class, 'restore'])->name('api.v1.token.restore');
    });
    Route::group(['namespace' => 'Shop', 'prefix' => 'shop'], function () {
        Route::get('/', [ShopController::class, 'list'])->name('api.v1.shop.list');
        Route::post('/', [ShopController::class, 'store'])->name('api.v1.shop.store');
        Route::post('/restore', [ShopController::class, 'restore'])->name('api.v1.shop.restore');
    });
    Route::group(['namespace' => 'Statistics', 'prefix' => 'statistics'], function () {
       Route::get('/stocks', [ShopController::class, 'getStocks'])->name('api.v1.statistics.stocks');
    });
});
