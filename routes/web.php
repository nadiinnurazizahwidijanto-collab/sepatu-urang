<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Route Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/store', [AuthController::class, 'store'])->name('storeUser');
Route::post('/auth', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'products'])->name('admin.dashboard'); // daftar produk
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');         // daftar order

    // CRUD Produk
    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('admin.storeProduct');
    Route::delete('/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.deleteProduct');

    // Update status order (ubah name agar sesuai Blade)
    Route::get('/orders/update-status/{id}', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
});


// Route Home
Route::get('/', [ProductController::class, 'home'])->name('home');

// Route Category Filter
Route::get('/category/{id}', [ProductController::class, 'filter'])->name('filter');

// Shortcut route untuk Men & Women & Kids
Route::get('/men', function() {
    return redirect()->route('filter', ['id' => 1]);
})->name('men');

Route::get('/women', function() {
    return redirect()->route('filter', ['id' => 2]);
})->name('women');

Route::get('/kids', function() {
    return redirect()->route('filter', ['id' => 3]);
})->name('kids');

// Route Detail
Route::get('/detail/{id}', [ProductController::class, 'detail'])->name('detail');

// Route Cart
Route::get('/cart', [CartController::class, 'cart'])->name('cart')->middleware('auth');
Route::post('/cart/store', [CartController::class, 'store'])->name('cartStore')->middleware('auth');
Route::post('/discount', [CartController::class, 'discount'])->name('discount')->middleware('auth');
Route::post('/cart/delete', [CartController::class, 'delete'])->name('cartDelete')->middleware('auth');

// Route Order
Route::get('/order', [OrderController::class, 'order'])->name('order')->middleware('auth');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout')->middleware('auth');

// Route Offline (PWA fallback)
Route::get('/offline', function() {
    return view('offline'); // pastikan ada view resources/views/offline.blade.php
})->name('offline');
