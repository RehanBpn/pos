<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

// HOME
Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

// LOGIN
// Route::get('/', [AuthController::class, 'view'])->name('login.view');
Route::get('/login', [AuthController::class, 'view'])->name('login.view');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Sign In
Route::get('/signin', [AuthController::class, 'viewSign'])->name('signin.view');
Route::post('/signin', [AuthController::class, 'register'])->name('signin');



// BARANG CRUD
Route::resource('barang', BarangController::class)->middleware('auth');


// SHOP + CART
Route::get('/shop', [CartController::class, 'index'])->name('shop.index')->middleware('auth');
Route::post('/cart/add', [CartController::class, 'addkeranjang'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.remove');
Route::post('/cart/increase/{id}', [CartController::class, 'increase'])
    ->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])
    ->name('cart.decrease');

Route::post('/checkout', [TransaksiController::class, 'index'])->name('checkout.index')->middleware('auth');
Route::post('/checkout', [TransaksiController::class, 'index'])->name('checkout.index');
Route::post('/checkout/store', [TransaksiController::class, 'store'])->name('checkout.store');
Route::get('/checkout/invoice/{id}', [TransaksiController::class, 'invoice'])->name('checkout.invoice')->middleware('auth');
