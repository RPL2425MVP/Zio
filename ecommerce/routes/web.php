<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

//Login
Route::get('/', [GuestController::class, 'showLoginForm'])->name('login');
Route::post('/login',[GuestController::class,'login']);
//Register
Route::get('/register',[GuestController::class,'regist'])->name('register');
Route::post('/register',[GuestController::class,'signup']);
//Home
Route::get('/index', [GuestController::class, 'index'])->middleware('auth');
Route::post('/logout',[GuestController::class,'logout'])->name('logout');

// Detail
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');

// Keranjang
Route::middleware(['auth'])->group(function () {
    Route::post('/keranjang/tambah/{id_produk}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
});

// atur Jumlah Di Keranjang
Route::post('/keranjang/ubah-qty', [KeranjangController::class, 'ubahQty'])->name('keranjang.ubah.qty');