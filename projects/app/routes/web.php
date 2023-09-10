<?php

use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/sellers');
});

Route::get('/sellers', [SellerController::class, 'index'])->name('sellers.index');

Route::get('/sellers/create', [SellerController::class, 'create'])->name('sellers.create');
Route::post('/sellers/create', [SellerController::class, 'create'])->name('sellers.store');

Route::get('/sellers/{id}', [SellerController::class, 'edit'])->name('sellers.show');
Route::post('/sellers/edit', [SellerController::class, 'edit'])->name('sellers.edit');
