<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::prefix('orders')->group(function() {
    Route::get('/', [OrderController::class, 'index'])->name('order.list');
    Route::get('/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::put('/{order}', [OrderController::class, 'update'])->name('order.update');
});