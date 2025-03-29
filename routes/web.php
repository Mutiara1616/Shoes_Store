<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Skincare Member Auth Routes
Route::get('/login', [App\Http\Controllers\Auth\SkincareMemberController::class, 'showLoginForm'])->name('skincare.login');
Route::post('/login', [App\Http\Controllers\Auth\SkincareMemberController::class, 'login'])->name('skincare.login.submit');
Route::get('/register', [App\Http\Controllers\Auth\SkincareMemberController::class, 'showRegisterForm'])->name('skincare.register');
Route::post('/register', [App\Http\Controllers\Auth\SkincareMemberController::class, 'register'])->name('skincare.register.submit');
Route::post('/logout', [App\Http\Controllers\Auth\SkincareMemberController::class, 'logout'])->name('skincare.logout');

// Dummy route for password reset
Route::get('/forgot-password', function() {
    return view('auth.forgot-password');
})->name('skincare.password.request');

// Dashboard - protected route
Route::middleware('auth:skincare')->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');
});