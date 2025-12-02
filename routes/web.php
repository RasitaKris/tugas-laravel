<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('products');
    Route::get('/create', 'create')->name('products.create');
    Route::get('/edit/{id}', 'edit')->name('products.edit');
    Route::post('/store', 'store')->name('products.store');
    Route::post('/update/{id}', 'update')->name('products.update');
    Route::get('/show/{id}', 'show')->name('products.show');
    Route::view('/about', 'about');
    Route::view('/school-rules', 'school-rules');
    Route::view('/parents-guidelines', 'parents-guidelines');
    Route::view('/tutors-guidelines', 'tutors-guidelines');
    Route::view('/communication-flow', 'communication-flow');

});
