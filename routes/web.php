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
    return view('home');
});

Route::get('/produk', function () {
    return 'Halaman Katalog Produk';
});

Route::get('/profil', function () {
    return 'Halaman Profil';
});

Route::get('/daftarpembeli', function () {
    return 'Halaman Daftar Akun Pembeli';
});
