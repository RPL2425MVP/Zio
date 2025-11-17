<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;


Route::get('/', [GuestController::class, 'showLoginForm'])->name('login');
Route::get('/register',[GuestController::class,'regist'])->name('register');
Route::post('/register',[GuestController::class,'signup']);
Route::get('/index', [GuestController::class, 'index'])->middleware('auth');
Route::post('/login',[GuestController::class,'login']);
Route::post('/logout',[GuestController::class,'logout'])->name('logout');