<?php

use App\Http\ClientController;
use App\Http\ProductController;
use App\Http\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'clients'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/store', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/update/{id}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/delete/{id}', [ClientController::class, 'delete'])->name('clients.delete');
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
});

Route::group(['prefix' => 'orders'], function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/update/{id}', [OrderController::class, 'update'])->name('orders.update');
});