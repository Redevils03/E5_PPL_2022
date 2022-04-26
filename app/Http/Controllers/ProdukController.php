<?php

namespace App\Http\Controllers;

use App\Models\data_produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk');
    }

    public function index_edit($id)
    {
        return view('editproduk', [
            'id' => $id
        ]);
    }

    public function tambah(Request $request)
    {
        
        $validateData = $request->validate([
            'gambar' => 'required',
            'nama_produk' => 'required',
            'jumlah_produk' => 'required',
            'harga_produk' => 'required',
            'harga_asli' => 'required'
        ]);
        
        data_produk::create($validateData);
        
        // $request->session()->flash('success', 'Akun berhasil dibuat, silahkan login');

        return redirect(('/produk'));
    }
    public function hapus($id)
    {
        data_produk::where('No_id',$id)->delete();
        return redirect(('/produk'));
    }

    public function edit(Request $request, $id)
    {     
        $validateData = $request->validate([
            'gambar' => 'required',
            'nama_produk' => 'required',
            'jumlah_produk' => 'required',
            'harga_produk' => 'required',
            'harga_asli' => 'required'
        ]);
            
        data_produk::where('No_id',$id)->update($validateData);

        return redirect(('/produk'));
    }
}
