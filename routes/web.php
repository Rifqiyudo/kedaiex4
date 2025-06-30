<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login'); // ganti sesuai lokasi file login kamu
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile');
    Route::post('profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::resource('produk', App\Http\Controllers\Admin\ProductController::class)->parameters(['produk' => 'product']);
    Route::resource('promo', App\Http\Controllers\Admin\PromoController::class);
    Route::resource('kategori', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    Route::get('laporan', [App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/export', [App\Http\Controllers\Admin\LaporanController::class, 'export'])->name('laporan.export');
    Route::get('stok', [App\Http\Controllers\Admin\StokController::class, 'index'])->name('stok.index');
    Route::post('stok/update/{id}', [App\Http\Controllers\Admin\StokController::class, 'update'])->name('stok.update');
    Route::get('transaksi', [App\Http\Controllers\Admin\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/{id}', [App\Http\Controllers\Admin\TransaksiController::class, 'show'])->name('transaksi.show');
    Route::post('transaksi/{id}/status', [App\Http\Controllers\Admin\TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
    // Route lainnya nanti di sini
});

Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/', function() { return redirect()->route('pelanggan.beranda'); });
    Route::get('beranda', [App\Http\Controllers\Pelanggan\BerandaController::class, 'index'])->name('beranda');
    Route::get('produk', [App\Http\Controllers\Pelanggan\ProductController::class, 'index'])->name('produk.index');
    Route::post('produk/pesan', [App\Http\Controllers\Pelanggan\ProductController::class, 'order'])->name('produk.order');
    Route::get('pesanan', [App\Http\Controllers\Pelanggan\OrderController::class, 'index'])->name('pesanan.index');
    Route::get('pesanan/{id}', [App\Http\Controllers\Pelanggan\OrderController::class, 'show'])->name('pesanan.show');
    Route::get('pesanan/{id}/bayar', [App\Http\Controllers\Pelanggan\OrderController::class, 'bayarForm'])->name('pesanan.bayar.form');
    Route::post('pesanan/{id}/bayar', [App\Http\Controllers\Pelanggan\OrderController::class, 'bayarProses'])->name('pesanan.bayar.proses');
});

Route::middleware(['auth', 'role:barista'])->prefix('barista')->name('barista.')->group(function () {
    Route::get('transaksi', [App\Http\Controllers\Barista\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/{id}', [App\Http\Controllers\Barista\TransaksiController::class, 'show'])->name('transaksi.show');
    Route::post('transaksi/{id}/verifikasi', [App\Http\Controllers\Barista\TransaksiController::class, 'verifikasiPembayaran'])->name('transaksi.verifikasi');
    Route::get('transaksi/{id}/cetak-struk', [App\Http\Controllers\Barista\TransaksiController::class, 'cetakStruk'])->name('transaksi.cetak_struk');
});

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
