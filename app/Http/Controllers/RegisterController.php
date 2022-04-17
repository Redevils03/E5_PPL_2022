<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

        User::create($validateData);
    }

}
