<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DetailUserController;
use App\Http\Controllers\EditProfileController;

Route::put('/profile/update', [EditProfileController::class, 'update'])->name('user.update');

// Autentikasi
Route::get('/', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Middleware auth untuk melindungi halaman tertentu
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('penjualan', PenjualanController::class);
    Route::resource('detail-penjualan', DetailPenjualanController::class);
    Route::get('/user/{id}', [DetailUserController::class, 'show'])->name('user.detail');
    Route::get('/profile/edit/{id}', [EditProfileController::class, 'edit'])->name('user.edit');
    Route::put('/profile/update/{id}', [EditProfileController::class, 'update'])->name('user.update');      
});