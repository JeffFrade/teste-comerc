<?php

use App\Http\ClientController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'clients'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients.index');
});
