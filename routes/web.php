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
    return view('landing');
});

Route::get('/produk', function () {
    return view('produk');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/daftarpembeli', function () {
    return 'Halaman Daftar Akun Pembeli';
});
