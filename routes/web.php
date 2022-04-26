<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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

Route::get('/produk', function () {
    $produk = DB::table('data_produks')->get();
    return view('produk',['produk'=>$produk]);
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/daftarpembeli', function () {
    return 'Halaman Daftar Akun Pembeli';
});