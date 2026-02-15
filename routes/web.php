<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderInvoiceDownloadController;
use App\Livewire\ProductDetail;
use App\Models\Order;
use App\Models\Product;
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
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::view('/register', 'register')->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/account/profile', 'profile-page')->name('profile');

    Route::get('/account/orders', function () {
        return view('order-history-page');
    })->name('orders.index');

    Route::get('/account/orders/download', OrderInvoiceDownloadController::class)->name('orders.download');

    Route::get('/account/orders/{order}', function (Order $order) {
        return view('order-detail-page', [
            'order' => $order,
        ]);
    })->name('orders.show');

    Route::view('/admin/products', 'admin.products')->name('admin.products.index');
    Route::get('/admin/products/{product}', function (Product $product) {
        return view('admin.product-show', [
            'product' => $product,
        ]);
    })->name('admin.products.show');
    Route::view('/admin/orders', 'admin.orders')->name('admin.orders.index');
});
