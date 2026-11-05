<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('categories', CategoryController::class);

Route::get('/items/cetak-pdf', [ItemController::class, 'cetakPdf'])
    ->name('items.pdf');
Route::resource('items', ItemController::class);
