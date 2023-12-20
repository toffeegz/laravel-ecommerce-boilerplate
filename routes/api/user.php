<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('users')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('user.list');
    Route::get('/{user}', [UserController::class, 'show'])->name('user.show');
    Route::put('/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/{user}', [UserController::class, 'delete'])->name('user.delete');
    Route::post('/{user}/promote-to-admin', [UserController::class, 'promoteToAdmin'])->name('user.promoteToAdmin');
});