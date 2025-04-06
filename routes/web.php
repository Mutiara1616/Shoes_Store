<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\ShoesMemberController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

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
Route::get('/category/men', function () {
    return view('products.men');
})->name('category.men');

Route::get('/women', [ProductController::class, 'category'])->name('category.women')->defaults('slug', 'women');
Route::get('/kids', [ProductController::class, 'category'])->name('category.kids')->defaults('slug', 'kids');
Route::get('/sale', [ProductController::class, 'sale'])->name('products.sale');

// Cart routes
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::patch('/update/{cartItem}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{cartItem}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
});

// Checkout routes
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/process', [CheckoutController::class, 'process'])->name('process');
    Route::get('/success/{order}', [CheckoutController::class, 'success'])->name('success');
});

// Brand routes
Route::get('/brand/{slug}', [ProductController::class, 'brand'])->name('brand.show');

// New arrivals and featured products
Route::get('/new-arrivals', [ProductController::class, 'newest'])->name('products.newest');
Route::get('/featured', [ProductController::class, 'featured'])->name('products.featured');