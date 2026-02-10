<?php

use App\Livewire\ProductDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('shop');
})->name('home');

Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

Route::get('/products/{product}', ProductDetail::class)->name('products.show');

Route::get('/cart', function () {
    return view('cart-page');
})->name('cart.index');

Route::get('/checkout', function () {
    return view('checkout-page');
})->name('checkout.index');

Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/account/profile', 'profile-page')->name('profile');

    Route::get('/account/orders', function () {
        return view('order-history-page');
    })->name('orders.index');
});
