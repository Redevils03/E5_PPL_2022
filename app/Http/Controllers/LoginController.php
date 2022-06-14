<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// C_Login
class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'login'
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

    public function logout() 
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
