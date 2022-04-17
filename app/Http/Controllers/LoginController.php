<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $credentials = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);
        
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/produk');
        }

        return back()->with('loginError', 'email atau password salah!');
    }
}
