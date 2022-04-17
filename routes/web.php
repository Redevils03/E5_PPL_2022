<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\DB;
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

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/produkadmin', function () {
    $produk = DB::table('data_produks')->get();
    return view('produkadmin',['produk'=>$produk]);
});

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
