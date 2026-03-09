<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Resource route sudah cukup, hapus Route::get('/produk',...) di bawah
Route::resource('produk', ProdukController::class)->middleware('auth');

// Route::get('/transaksi', [TransaksiController::class,'index'])->name('transaksi.index');
// Route::post('/transaksi', [TransaksiController::class,'store'])->name('transaksi.store');
// Route::get('/riwayat-transaksi', [TransaksiController::class,'riwayat'])->name('transaksi.show');
// Route::get('/transaksi-detail/{id}', [TransaksiController::class,'detail'])->name('transaksi.detail');

Route::get('/transaksi', [TransaksiController::class,'index'])->name('transaksi.index');

Route::post('/transaksi/store', [TransaksiController::class,'store'])->name('transaksi.store');

Route::get('/transaksi/riwayat', [TransaksiController::class,'riwayat'])->name('transaksi.riwayat');

Route::get('/transaksi/{id}', [TransaksiController::class,'show'])->name('transaksi.show');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard.index');

// Laporan
Route::get('/laporan/penjualan', [LaporanController::class, 'index'])->name('laporan.penjualan');
Route::get('/laporan/produk-terlaris', [LaporanController::class, 'produkTerlaris'])->name('laporan.produk.terlaris');
Route::get('/laporan/metode-pembayaran', [LaporanController::class, 'metodePembayaran'])->name('laporan.metode');

// Route::middleware('auth')->group(function () {
//     // Route::get('/dashboard', fn() => view('dashboard.index'));
//     Route::get('/laporan', fn() => view('laporan.index'));
// });

// ❌ HAPUS baris-baris ini (duplikat & tidak passing $produk):
// Route::get('/produk', function () { return view('produk.index'); })->middleware('auth');
// Route::get('/transaksi', function () { return view('transaksi.index'); })->middleware('auth');