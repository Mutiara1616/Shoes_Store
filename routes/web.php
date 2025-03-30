<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\ShoesMemberController;

// Home/Landing Page
Route::get('/', function () {
    return view('home');
})->name('home');

// Shoes Member Auth Routes
Route::get('/login', [ShoesMemberController::class, 'showLoginForm'])->name('shoes.login');
Route::post('/login', [ShoesMemberController::class, 'login'])->name('shoes.login.submit');
Route::get('/register', [ShoesMemberController::class, 'showRegisterForm'])->name('shoes.register');
Route::post('/register', [ShoesMemberController::class, 'register'])->name('shoes.register.submit');
Route::post('/logout', [ShoesMemberController::class, 'logout'])->name('shoes.logout');

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

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// Category routes
Route::get('/men', [ProductController::class, 'category'])->name('category.men')->defaults('slug', 'men');
Route::get('/women', [ProductController::class, 'category'])->name('category.women')->defaults('slug', 'women');
Route::get('/kids', [ProductController::class, 'category'])->name('category.kids')->defaults('slug', 'kids');
Route::get('/sale', [ProductController::class, 'sale'])->name('products.sale');