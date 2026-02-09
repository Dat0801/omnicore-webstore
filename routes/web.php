<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('shop');
})->name('home');

Route::get('/cart', function () {
    return view('cart-page');
})->name('cart.index');

Route::get('/checkout', function () {
    return view('checkout-page');
})->name('checkout.index');

Route::view('/login', 'login')->name('login');
