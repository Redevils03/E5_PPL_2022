<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('landing');
})->middleware('guest');

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/edit', [RegisterController::class, 'edit']);
Route::get('/akunpembeli/{id}', [RegisterController::class, 'data_pembeli']);
Route::get('/chat/{id}', [RegisterController::class, 'index_chat']);
Route::post('/chat/{id}', [RegisterController::class, 'chat']);

Route::get('/produk',[ProdukController::class, 'index']);
Route::get('/produk/{id}',[ProdukController::class, 'hapus']);
Route::get('/hapus_pembayaran/{id}',[ProdukController::class, 'hapus_pembayaran']);
Route::get('/pembelian/{id}',[ProdukController::class, 'hapus_pembelian']);
Route::post('/editpembelian/{id}',[ProdukController::class, 'edit_pembelian']);
Route::post('/editproduk/{id}',[ProdukController::class, 'edit']);
Route::post('/bayar/{id}',[ProdukController::class, 'bayar']);
Route::get('/terima/{id}',[ProdukController::class, 'terima']);
Route::get('/terima_pembayaran/{id}',[ProdukController::class, 'terima_pembayaran']);
Route::get('/admin_hapus_pembelian/{id}',[ProdukController::class, 'admin_hapus_pembelian']);
Route::get('/admin_konfirmasi/{id}',[ProdukController::class, 'admin_konfirmasi']);
Route::post('/produk',[ProdukController::class, 'tambah']);
Route::post('/beliproduk/{id}',[ProdukController::class, 'beli']);

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/daftarpembeli', function () {
    return view('daftarakunpembeli');
});

Route::get('/daftarpembelian', function () {
    return view('daftarpembelian');
});