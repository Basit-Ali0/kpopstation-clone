<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

Route::get('/', [ProductController::class, 'home'])->name('home');

Route::get('/collection/{categorySlug}', [ProductController::class, 'index'])->name('collection.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/cart', function () {
    return view('cart.index');
})->name('cart.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/checkout', function () {
    return view('checkout.index');
})->name('checkout.index');
