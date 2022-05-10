<?php

namespace App\Http\Controllers;

use App\Models\chat_message;
use App\Models\akun_admin;
use App\Models\akun_pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register', [
            'title' => 'register'
        ]);
    }

    public function data_pembeli($id)
    {
        return view('akunpembeli', [
            'id' => $id
        ]);
    }

    public function index_chat($id)
    {
        return view('chat', [
            'id' => $id
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

        return redirect('/login');
    }

    public function edit(Request $request)
    {   
        if (Auth::guard('admin')->check()) {

            if ($request->email == null || $request->password == null) {
                session()->flash('Empty', 'Silahkan Isi Semua Data');
                return redirect()->back()->withErrors(['Empty', 'Silahkan Isi Semua Data'])->withInput();
            }

            $validateData = $request->validate([
                'email' => 'required|email:rfc,dns',
                'password' => 'required|min:6|max:15',
            ]);
            
            $validateData['password'] = bcrypt($validateData['password']);
            
            akun_admin::where('id',Auth::guard('admin')->id())->update($validateData);
        }
        else if (Auth::guard('web')->check()) {

            if ($request->gambar == null || $request->email == null || $request->password == null || $request->nama == null || $request->nomor_telp == null || $request->alamat == null || $request->jenis_kelamin == null) {
                session()->flash('Empty', 'Silahkan Isi Semua Data');
                return redirect()->back()->withErrors(['Empty', 'Silahkan Isi Semua Data'])->withInput();
            }

            $validateData = $request->validate([
                'gambar' => 'required|image|file',
                'email' => 'required|email:rfc,dns',
                'password' => 'required|min:6|max:15',
                'nama' => 'required|max:30',
                'nomor_telp' => 'required|min:10|max:14',
                'alamat' => 'required',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan'
            ]);

            if($request->file('gambar')) {
                $validateData['gambar'] = $request->file('gambar')->store('post-image');
            }
            
            $validateData['password'] = bcrypt($validateData['password']);
            
            akun_pembeli::where('id',Auth::id())->update($validateData);
        }

        return redirect(('/profil'));
    }

    public function chat(Request $request, $id)
    {
        if (Auth::guard('admin')->check()) {

            $validateData = $request->validate([
                'message' => 'min:1|max:255',
            ]);
        
            chat_message::create(array_merge(['id_pembeli'=>$id], ['role'=>'admin'], $validateData));
        }
        else if (Auth::guard('web')->check()) {

            $validateData = $request->validate([
                'message' => 'min:1|max:255',
            ]);

            chat_message::create(array_merge(['id_pembeli'=>Auth::id()], ['role'=>'pembeli'], $validateData));
        }

        return redirect()->back();
    }
}
