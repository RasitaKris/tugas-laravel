<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

// Controllers
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProfileController;

// LANGUAGE SWITCH (GLOBAL)

Route::get('/lang/{locale}', function ($locale) {
    if (!in_array($locale, ['id', 'en'])) {
        abort(404);
    }

    session(['locale' => $locale]);
    app()->setLocale($locale);

    return redirect()->back();
})->name('lang.switch');


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
Route::get('/forgot-password', [PasswordResetController::class, 'requestForm'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetForm'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// PRODUCTS (AUTH REQUIRED)

Route::middleware('auth')->prefix('products')->controller(ProductController::class)->group(function () {

    Route::get('/', 'index')->name('products');

    // ADMIN / STAFF
    Route::get('/create', 'create')->name('products.create');
    Route::post('/store', 'store')->name('products.store');
    Route::get('/edit/{id}', 'edit')->name('products.edit');
    Route::post('/update/{id}', 'update')->name('products.update');
    Route::delete('/delete/{id}', 'destroy')->name('products.delete');

    // PUBLIC DETAIL (LOGIN WAJIB)
    Route::get('/show/{id}', 'show')->name('products.show');
});

//CART, CHECKOUT & ORDERS (AUTH REQUIRED)

Route::middleware('auth')->group(function () {

    // PROFILE SETTINGS
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    
    Route::get('/wishlist', [WishlistController::class, 'index'])
        ->name('wishlist.index');

    Route::post('/wishlist/toggle/{product_id}', [WishlistController::class, 'toggle'])
        ->name('wishlist.toggle');

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

    // BUY NOW
    Route::get('/buy-now/{product_id}', [CheckoutController::class, 'buyNow'])
        ->name('buy.now');

     // DARK MODE TOGGLE
    Route::post('/toggle-dark-mode', function () {
        session(['dark_mode' => !session('dark_mode')]);
        return response()->json(['status' => 'ok']);
});

});
