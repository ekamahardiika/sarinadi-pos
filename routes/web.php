<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

// Route publik
Route::get('/', function () {
    return view('welcome');
});

// Auth routes (login, register, password reset, etc.)
Auth::routes();

// Semua route berikut hanya bisa diakses jika sudah login
Route::middleware('auth')->group(function () {

    // Home / Dashboard
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Produk
    Route::resource('produk', ProdukController::class);

    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/riwayat', [TransaksiController::class, 'riwayat'])->name('transaksi.riwayat');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');

    // Laporan
    Route::get('/laporan/penjualan', [LaporanController::class, 'index'])->name('laporan.penjualan');
    Route::get('/laporan/produk-terlaris', [LaporanController::class, 'produkTerlaris'])->name('laporan.produk.terlaris');
    Route::get('/laporan/metode-pembayaran', [LaporanController::class, 'metodePembayaran'])->name('laporan.metode');
});
