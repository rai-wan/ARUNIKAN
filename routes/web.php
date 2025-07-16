<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\SuplayerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopTransaksiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UmumController;


Route::get('/kasir', [KasirController::class, 'form'])->name('kasir.form');
Route::post('/kasir/simpan', [KasirController::class, 'simpan'])->name('kasir.simpan');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

// Login
Route::view('/login', 'login')->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Shop & Pembayaran
Route::get('/shop', [ShopController::class, 'index']);
Route::get('/shop/buy/{id}', [KasirController::class, 'buyNowForm'])->name('shop.buy');
Route::post('/shop/buy', [KasirController::class, 'buyNowSubmit'])->name('shop.buy.submit');
Route::get('/shop/pembayaran', [ShopTransaksiController::class, 'form'])->name('shop.form');
Route::post('/shop/transaksi', [ShopTransaksiController::class, 'simpan'])->name('shop.transaksi.simpan');


// Route::get('/supplier', [SuplayerController::class, 'index']);
// Route::post('/supplier/stok-masuk', [SuplayerController::class, 'simpan'])->name('supplier.stokMasuk');

// =================== ADMIN ROUTES ===================
Route::middleware(['web'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Register akun
    Route::get('/admin/register-akun', [AdminController::class, 'registerAkunForm'])->name('admin.register.form');
    Route::post('/admin/register-akun', [AdminController::class, 'registerAkun'])->name('admin.register.post');

    // Kelola produk
    Route::get('/admin/produk', [AdminController::class, 'kelolaProduk'])->name('admin.produk');
    Route::get('/admin/produk/tambah', [AdminController::class, 'tambahProdukForm'])->name('admin.produk.tambah');
    Route::post('/admin/produk/simpan', [AdminController::class, 'simpanProduk'])->name('admin.produk.simpan');
    Route::get('/admin/produk/edit/{id}', [AdminController::class, 'formEditProduk'])->name('admin.produk.edit');
    Route::put('/admin/produk/update/{id}', [AdminController::class, 'updateProduk'])->name('admin.produk.update');
    Route::delete('/admin/produk/hapus/{id}', [AdminController::class, 'hapusProduk'])->name('admin.produk.hapus');

    // Verifikasi pembayaran
    Route::get('/admin/verifikasi-pembayaran', [AdminController::class, 'verifikasiPembayaran'])->name('admin.verifikasi_pembayaran');
    Route::patch('/admin/verifikasi-pembayaran/{id}', [AdminController::class, 'verifikasiPembayaranProses'])->name('admin.verifikasi_pembayaran.proses');

    // Rekap Penjualan
    Route::get('/admin/rekap', [AdminController::class, 'rekapPenjualan'])->name('rekap.index');
    Route::get('/admin/rekap/export/pdf', [AdminController::class, 'exportRekapPDF'])->name('rekap.export.pdf');
    Route::get('/admin/rekap/export/excel', [AdminController::class, 'exportRekapExcel'])->name('rekap.export.excel');

    // ✅ Stok Masuk (akses dari admin ke halaman supplier)
    // stok masuk dipindah ke akses admin
    Route::get('/admin/stok', [SuplayerController::class, 'index'])->name('admin.stok.index');
    Route::post('/admin/stok', [SuplayerController::class, 'simpan'])->name('admin.stok.simpan');
    Route::get('/admin/stok/edit/{id}', [SuplayerController::class, 'edit'])->name('admin.stok.edit');
    Route::put('/admin/stok/update/{id}', [SuplayerController::class, 'update'])->name('admin.stok.update');
    Route::delete('/admin/stok/hapus/{id}', [SuplayerController::class, 'hapus'])->name('admin.stok.hapus');

    Route::get('/riwayat', [App\Http\Controllers\ShopTransaksiController::class, 'riwayatUser'])->name('shop.riwayat');

    Route::post('/logout', function () {
    session()->flush(); // Hapus semua session
    return redirect('/login'); // Redirect ke halaman login
})->name('logout');

});
