<?php

namespace App\Http\Controllers;

use App\Models\akun_pembeli;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register', [
            'title' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:6|max:15',
            'nama' => 'required|max:30',
            'nomor_telp' => 'required|min:10|max:14',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan'
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        akun_pembeli::create($validateData);
        
        $request->session()->flash('success', 'Akun berhasil dibuat, silahkan login');

        return redirect(('/login'));
    }

}
