<?php

use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\SellerController;
use Illuminate\Support\Facades\Route;

//Route::apiResource('/sellers', SellerController::class);
//Route::apiResource('/sales', SaleController::class);

Route::get('/sellers', [SellerController::class, 'index']);
Route::get('/sellers/{id}', [SellerController::class, 'show']);
Route::post('/sellers', [SellerController::class, 'store']);
Route::put('/sellers/{id}', [SellerController::class, 'update']);
Route::delete('/sellers/{id}', [SellerController::class, 'destroy']);

Route::get('/sales', [SaleController::class, 'index']);
Route::get('/sales/{id}', [SaleController::class, 'show']);
Route::get('/sales/seller/{id}', [SaleController::class, 'bySeller']);
Route::post('/sales', [SaleController::class, 'store']);
Route::put('/sales/{id}', [SaleController::class, 'update']);
Route::delete('/sales/{id}', [SaleController::class, 'destroy']);

Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});
