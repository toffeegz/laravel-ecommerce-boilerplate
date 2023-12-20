<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::prefix('cart')->group(function() {
    Route::get('/', [CartController::class, 'index'])->name('cart.list');
    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('cart.addToCart'); // product id and quantity
    Route::put('change-quantity/{cart}', [CartController::class, 'changeQuantity'])->name('cart.changeQuantity'); // cart id, quantity
    Route::delete('remove-to-cart/{cart}', [CartController::class, 'removeToCart'])->name('cart.removeToCart'); 
    
    Route::post('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});