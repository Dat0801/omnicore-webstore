<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('shop');
});

Route::get('/checkout', function () {
    return view('checkout-page');
});
