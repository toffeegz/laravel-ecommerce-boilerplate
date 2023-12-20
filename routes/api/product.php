<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::prefix('products')->group(function() {
    Route::get('/', [ProductController::class, 'index'])->name('product.list');
    Route::get('/{product}', [ProductController::class, 'show'])->name('product.show');
    Route::post('/', [ProductController::class, 'store'])->name('product.store');
    Route::put('/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/{product}', [ProductController::class, 'delete'])->name('product.delete');
});