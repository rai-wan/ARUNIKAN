<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\KasirController;

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

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('dashboard', function () {
    return view('dashboard');
});

Route::get('/kasir', [KasirController::class, 'showTransaksi']);

Route::get('/supplier', function () {
    return view('supplier.gudang');
});


Route::get('/shop', function () {
    return view('shop'); // Halaman Shop
});
Route::get('/', function () {
    return view('login');
});
Route::get('/index', function () {
    return view('index');
});

Route::get('/shop', [ShopController::class, 'showShop']);