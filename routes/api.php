<?php

use App\Http\ClientController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'clients'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/store', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/update/{id}', [ClientController::class, 'update'])->name('clients.update');
});
