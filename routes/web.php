<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
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
    
    Route::get('/profile', [GuestController::class, 'indexProfile'])->name('user.profile');
    Route::get('/profile/edit/{field}', [GuestController::class, 'editField'])->name('edit.nama');
    Route::patch('/profile/update/{field}', [GuestController::class, 'updateField'])->name('update.field');
    
    Route::get('/profile/edit/p/alamat', [GuestController::class, 'editAlamat'])->name('profile.edit.lokasi');
    Route::patch('/profile/update/p/alamat', [GuestController::class, 'updateAlamat'])->name('profile.update.alamat');
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
    Route::delete('/tbProduk/{id_produk}', [AdminController::class, 'destroyProduk'])->name('tbProduk.destroy');

        Route::get('/account-user', [AdminController::class, 'indexUsers'])->name('admin.account_user');
    Route::delete('/account-user/{id_user}', [AdminController::class, 'destroyUser'])->name('admin.account_user.destroy');

    Route::get('/keranjang', [AdminController::class, 'indexKeranjang'])->name('admin.keranjang');
    Route::delete('/keranjang/{id_keranjang}', [AdminController::class, 'destroyKeranjang'])->name('admin.keranjang.destroy');

    Route::get('/pesanan', [AdminController::class, 'indexPesanan'])->name('admin.pesanan');
    Route::get('/pesanan/detail/{id}', [AdminController::class, 'detailPesanan'])->name('admin.pesanan.detail');

    Route::get('/pesanan/{id}/edit-status', [AdminController::class, 'editStatus'])->name('admin.pesanan.edit-status');
    Route::post('/pesanan/{id}/update-status', [AdminController::class, 'updateStatus'])->name('admin.pesanan.update-status');

});




Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/proses', [CheckoutController::class, 'proses'])->name('checkout.proses');
    Route::get('/checkout/invoice/{id}', [CheckoutController::class, 'invoice'])->name('checkout.invoice'); 
    Route::get('/checkout/invoice/{id}/pdf', [CheckoutController::class, 'downloadPdf'])->name('checkout.download-pdf');
});