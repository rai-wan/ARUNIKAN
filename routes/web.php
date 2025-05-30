<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');
});
Route::get('/shop', function () {
    return view('shop'); // Halaman Shop
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/', function () {
    return view('index');
});

<<<<<<< HEAD
Route::get('/forum', [App\Http\Controllers\ForumController::class, 'index']);
Route::get('/komunitas', [KomunitasController::class, 'index']);
=======
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/supplier/stok', function () {
    return view('supplier.gudang');
});
Route::get('/kasir/transaksi', function () {
    return view('kasir.transaksi');
});
>>>>>>> ebd27a2 (Initial push)
