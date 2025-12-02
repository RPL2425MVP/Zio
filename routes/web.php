<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
// User
//Login
Route::get('/', [GuestController::class, 'showLoginForm'])->name('login');
Route::post('/login',[GuestController::class,'login']);
//Register
Route::get('/register',[GuestController::class,'regist'])->name('register');
Route::post('/register',[GuestController::class,'signup']);
//Home
Route::get('/index', [GuestController::class, 'index'])->middleware('auth');
Route::post('/logout',[GuestController::class,'logout'])->name('logout');




// produk
Route::middleware(['auth'])->group(function () {
    // Keranjang
    Route::post('/keranjang/tambah/{id_produk}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    // Detail
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    // Produk List
    Route::get('/product',[ProdukController::class, 'produkList'])->name('produkList.show');
    // atur Jumlah Di Keranjang
    Route::post('/keranjang/ubah-qty', [KeranjangController::class, 'ubahQty'])->name('keranjang.ubah.qty');
});






// Admin
// Login
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
// Logout
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('admin.dashboard');

    // Route Action Admin
    route::get('/tbProduk',[AdminController::class, 'tbProduk'])->name('tbProduk.show');
    route::get('/tbProduk/{id}/edit',[AdminController::class, 'editProduk'])->name('tbProduk.edit');
    route::put('/tbProduk/{id}',[AdminController::class, 'updateProduk'])->name('tbProduk.update');
    Route::get('/tbProduk/create', [AdminController::class, 'createProduk'])->name('tbProduk.create');
    Route::post('/tbProduk', [AdminController::class, 'storeProduk'])->name('tbProduk.store');

        Route::get('/account-user', [AdminController::class, 'indexUsers'])->name('admin.account_user');
    Route::delete('/account-user/{id_user}', [AdminController::class, 'destroyUser'])->name('admin.account_user.destroy');

    Route::get('/keranjang', [AdminController::class, 'indexKeranjang'])->name('admin.keranjang');
    Route::delete('/keranjang/{id_keranjang}', [AdminController::class, 'destroyKeranjang'])->name('admin.keranjang.destroy');
});