<?php

use Illuminate\Support\Facades\Route;

// Home/Landing Page
Route::get('/', function () {
    return view('home');
})->name('home');

// Shoes Member Auth Routes
Route::get('/login', [App\Http\Controllers\Auth\ShoesMemberController::class, 'showLoginForm'])->name('shoes.login');
Route::post('/login', [App\Http\Controllers\Auth\ShoesMemberController::class, 'login'])->name('shoes.login.submit');
Route::get('/register', [App\Http\Controllers\Auth\ShoesMemberController::class, 'showRegisterForm'])->name('shoes.register');
Route::post('/register', [App\Http\Controllers\Auth\ShoesMemberController::class, 'register'])->name('shoes.register.submit');
Route::post('/logout', [App\Http\Controllers\Auth\ShoesMemberController::class, 'logout'])->name('shoes.logout');

// Dummy route for password reset
Route::get('/forgot-password', function() {
    return view('auth.forgot-password');
})->name('shoes.password.request');

// Dashboard - protected route
Route::middleware('auth:shoes')->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');
});