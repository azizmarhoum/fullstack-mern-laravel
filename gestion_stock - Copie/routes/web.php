<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseController;

// Resourceful Routes
Route::resource('clients', ClientController::class);
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
Route::resource('purchases', PurchaseController::class);

// Homepage/Dashboard Route (optional)
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/orders/{order}/pdf', [OrderController::class, 'downloadPdf'])->name('orders.pdf');