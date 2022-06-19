<?php

namespace App\Http\Controllers;

use App\Models\informasi_mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('HalamanLogin', [
            'title' => 'HalamanLogin'
        ]);
    }

    public function authenticate(Request $request)
    {
        if ($request->email == null || $request->password == null) {
            session()->flash('Empty', 'Silahkan Isi Semua Data');
            return redirect()->back()->withInput();
        }

        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        if(Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/produk');
        }

        if(Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/produk');
        }

        session()->flash('loginError', 'Email atau Password Salah');
        return redirect()->back();
    }

    public function tambah_info(Request $request)
    {
        if ($request->keterangan == null) {
            session()->flash('Empty', 'Silahkan Isi Semua Data');
            return redirect()->back()->withErrors(['Empty', 'Silahkan Isi Semua Data'])->withInput();
        }
        $data = DB::table('informasi_mitras')->get();
        $ket_akhir = $data->first()->deskripsi . ' ' . $request->keterangan;
        informasi_mitra::where([['id',1]])->update(['deskripsi'=>$ket_akhir]);

        return redirect('/infomitra');
    }
    public function ubah_info(Request $request)
    {
        if ($request->alamat == null || $request->no_telp == null || $request->keterangan == null) {
            session()->flash('editEmpty', 'Silahkan Isi Semua Data');
            return redirect()->back()->withErrors(['editEmpty', 'Silahkan Isi Semua Data']);
        }

        informasi_mitra::where([['id',1]])->update(['alamat'=>$request->alamat, 'no_telepon'=>$request->no_telp, 'deskripsi'=>$request->keterangan]);

        return redirect('/infomitra');
    }
    public function hapus_info(Request $request)
    {
        informasi_mitra::where([['id',1]])->update(['deskripsi'=>null]);

        return redirect('/infomitra');
    }
    public function logout() 
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
