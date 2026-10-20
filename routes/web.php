<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardNasabah;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginPembeliController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\RegisterNasabahController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\TarikSaldoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Route untuk halaman home
Route::get('/', function () {
    return view('home');
})->name('home');

// Route untuk halaman profil pengguna
Route::get('/profile', function(){
    return view('profile');
});

// Route untuk data sampah
Route::get('/data-sampah', function(){
    return view('data-sampah');
});


Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard-admin'); // Route untuk dashboard admin
Route::get('/dashboard-nasabah', [DashboardNasabah::class,  'DashboardNasabah'])->name('dashboard-nasabah'); // Route untuk dashboard nasabah
Route::get('/dashboard-pembeli', [PembelianController::class,  'Dashboardpembeli'])->name('dashboard-pembeli'); // Route untuk dashboard pembeli

// Route untuk halaman login nasabah
Route::get('/login', [LoginController::class, 'showNasabahLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'loginNasabah']);

// Route untuk halaman login pembeli
Route::get('/login-pembeli', [LoginPembeliController::class, 'showPembeliLoginForm'])->name('loginpembeli');
Route::post('/login-pembeli', [LoginPembeliController::class, 'loginPembeli']);

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk halaman register nasabah
Route::get('/register-nasabah', [RegisterNasabahController::class, 'showNasabahRegisterForm'])->name('register.nasabah');
Route::post('/register-nasabah', [RegisterNasabahController::class, 'nasabahRegister']);

// Routes untuk nasabah (mengambil data nasabah)
Route::get('/api/nasabah', [NasabahController::class, 'index']); // Mengambil semua nasabah
Route::get('/api/nasabah/{id}', [NasabahController::class, 'show']); // Mengambil detail nasabah berdasarkan ID

// Route untuk mengelola data sampah
Route::get('/data-sampah', [SampahController::class, 'indexNasabah']);
Route::prefix('sampah')->group(function () {
    Route::get('/', [SampahController::class, 'index'])->name('sampah.index');
    Route::get('/create', [SampahController::class, 'create'])->name('sampah.create');
    Route::post('/store', [SampahController::class, 'store'])->name('sampah.store');
    Route::get('/{sampah}', [SampahController::class, 'show'])->name('sampah.show');
    Route::get('/{sampah}/edit', [SampahController::class, 'edit'])->name('sampah.edit');
    Route::put('/{sampah}/edit', [SampahController::class, 'update'])->name('sampah.update');
    Route::delete('/{sampah}', [SampahController::class, 'destroy'])->name('sampah.destroy');
});

// Route untuk mengelola data admin (user)
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/{admin}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/{admin}/edit', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

// Route untuk mengelola data nasabah
Route::prefix('nasabah')->group(function () {
    Route::get('/', [NasabahController::class, 'index'])->name('nasabah.index');
    Route::get('/create', [NasabahController::class, 'create'])->name('nasabah.create');
    Route::post('/store', [NasabahController::class, 'store'])->name('nasabah.store');
    Route::get('/{nasabah}', [NasabahController::class, 'show'])->name('nasabah.show');
    Route::get('/{nasabah}/edit', [NasabahController::class, 'edit'])->name('nasabah.edit');
    Route::put('/{nasabah}/edit', [NasabahController::class, 'update'])->name('nasabah.update');
    Route::delete('/{nasabah}', [NasabahController::class, 'destroy'])->name('nasabah.destroy');
});

// Route untuk mengelola setoran nasabah
Route::prefix('setoran')->group(function () {
    Route::get('/', [SetoranController::class, 'index'])->name('setoran.index');
    Route::get('/create', [SetoranController::class, 'create'])->name('setoran.create');
    Route::post('/store', [SetoranController::class, 'store'])->name('setoran.store');
    Route::get('/{setoran}', [SetoranController::class, 'show'])->name('setoran.show');
    Route::get('/{setoran}/edit', [SetoranController::class, 'edit'])->name('setoran.edit');
    Route::put('/{setoran}/edit', [SetoranController::class, 'update'])->name('setoran.update');
    Route::delete('/{setoran}', [SetoranController::class, 'destroy'])->name('setoran.destroy');
});

// Route untuk melihat riwayat setoran admin
Route::get('/riwayat', [SetoranController::class, 'riwayatSetoran'])->name('riwayat.setoran');
Route::get('/setoran-detail/{id}', [SetoranController::class, 'show'])->name('setoran-detail');

// Route untuk melihat riwayat setoran nasabah
Route::get('/riwayatNasabah', [SetoranController::class, 'riwayatSetoranNasabah'])->name('riwayat.setoranNasabah');
Route::get('/setoran-detailNasabah/{id}', [SetoranController::class, 'showNasabah'])->name('setoran-detailNasabah');

// Route untuk penarikan saldo
Route::prefix('permintaan-penarikan')->group(function () {
    Route::get('/', [TarikSaldoController::class, 'index'])->name('tarik_saldo.index');
    Route::get('/create', [TarikSaldoController::class, 'create'])->name('tarik_saldo.create');
    Route::post('/store', [TarikSaldoController::class, 'store'])->name('tarik_saldo.store');
});

// Route untuk penarikan saldo dan update statusnya
Route::get('/penarikan-saldo', [TarikSaldoController::class, 'index2'])->name('tarik_saldo2.index2');
Route::patch('/update-status/{id}', [TarikSaldoController::class, 'updateStatus'])->name('penarikan.update-status');

// Route untuk penjualan produk
Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/addpenjualan', [PenjualanController::class, 'create'])->name('penjualan.create');
Route::post('/store', [PenjualanController::class, 'store'])->name('penjualan.store');
Route::get('/penjualan/{id}/edit', [PenjualanController::class, 'edit'])->name('penjualan.edit');
Route::put('/penjualan/{id}', [PenjualanController::class, 'update'])->name('penjualan.update');
Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');

// Route untuk mengelola produk dan pembelian
Route::get('/produk', [PembelianController::class, 'produk'])->name('produk');
Route::get('/create', [PembelianController::class, 'create'])->name('pembelian.create');
Route::post('/store', [PembelianController::class, 'store'])->name('pembelian.store');
Route::get('/pembelian/{id}/edit', [PembelianController::class, 'edit'])->name('pembelian.edit');
Route::put('/pembelian/{id}', [PembelianController::class, 'update'])->name('pembelian.update');
Route::delete('/pembelian/{id}', [PembelianController::class, 'destroy'])->name('pembelian.destroy');

// Route untuk laporan PDF dan saldo
Route::get('/laporan/sampah/pdf', [LaporanController::class, 'generatePdf'])->name('laporan.sampah.pdf');
Route::get('/laporan/saldo', [LaporanController::class, 'laporanSaldo'])->name('laporanSaldo.pdf');

// Route untuk mengelola keranjang belanja
Route::get('/cart/index', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::get('/cart/create', [CartController::class, 'create'])->name('cart.create');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');