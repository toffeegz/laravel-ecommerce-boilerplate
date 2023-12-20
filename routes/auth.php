<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('auth.updateProfile');
Route::get('/profile', [AuthController::class, 'profile'])->name('auth.profile');