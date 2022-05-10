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
Route::post('/editproduk/{id}',[ProdukController::class, 'edit']);
Route::post('/produk',[ProdukController::class, 'tambah']);
Route::get('/beliproduk/{id}',[ProdukController::class, 'index_beli']);
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