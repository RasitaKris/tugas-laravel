<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

// HOME
Route::get('/', function () {
    return view('welcome');
})->name('home');

// STATIC PAGES
Route::view('/about', 'about')->name('about');
Route::view('/school-rules', 'school-rules')->name('school.rules');
Route::view('/parents-guidelines', 'parents-guidelines')->name('parents.guidelines');
Route::view('/tutors-guidelines', 'tutors-guidelines')->name('tutors.guidelines');

// AUTH
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =========================
// PRODUCTS MODULE
// =========================

Route::prefix('products')->controller(ProductController::class)->group(function () {

    Route::get('/', 'index')->name('products');
    Route::get('/create', 'create')->name('products.create');
    Route::post('/store', 'store')->name('products.store');

    Route::get('/show/{id}', 'show')->name('products.show');
    Route::get('/edit/{id}', 'edit')->name('products.edit');
    Route::post('/update/{id}', 'update')->name('products.update');

    Route::delete('/delete/{id}', 'destroy')->name('products.delete');
});


// =========================
// CART, CHECKOUT & ORDERS (AUTH REQUIRED)
// =========================

Route::middleware('auth')->group(function () {

    // CART
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product_id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // CHECKOUT
    Route::get('/checkout', [CheckoutController::class, 'form'])->name('checkout.form');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    // ORDERS
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});
