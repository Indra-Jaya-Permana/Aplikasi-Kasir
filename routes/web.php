<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\UserController; // Pastikan UserController diimpor jika digunakan 

// Route::get('/', function () {
//     return view('welcome');
// });

// Autentikasi
Route::get('/', [AuthController::class, 'loginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// CRUD untuk data dengan middleware 'auth'
Route::middleware('auth')->group(function () {
    // Rute untuk Pelanggan
    Route::resource('pelanggan', PelangganController::class);
    // Rute untuk Produk
    Route::resource('produk', ProdukController::class);
    // Rute untuk Penjualan
    Route::resource('penjualan', PenjualanController::class);
    // Rute untuk Detail Penjualan
    Route::resource('detail-penjualan', DetailPenjualanController::class);
});

// Rute untuk pengguna, hanya dapat diakses oleh admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});