<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KategoriIuranController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengeluaranController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Rute Halaman Depan
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Rute Otentikasi (Login/Register/Logout)
Auth::routes();

// 3. Rute Dashboard setelah login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 4. Grup Rute yang Dilindungi Login (Middleware Auth)
Route::middleware(['auth'])->group(function () {
    // CRUD Warga
    Route::resource('wargas', WargaController::class);
    
    // CRUD Kategori Iuran
    Route::resource('kategoris', KategoriIuranController::class);
    Route::resource('transaksis', TransaksiController::class);
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::resource('pengeluarans', PengeluaranController::class);
});