<?php

namespace App\Http\Controllers;

use App\Models\data_produk;
use App\Models\pembelian;
use App\Models\detail_pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk');
    }

    public function index_beli($id)
    {
        return view('beliproduk', [
            'id' => $id
        ]);
    }

    public function tambah(Request $request)
    {
        if ($request->gambar == null || $request->nama_produk == null || $request->jumlah_produk == null || $request->harga_produk == null || $request->harga_asli == null) {
            session()->flash('Empty', 'Silahkan Isi Semua Data');
            return redirect()->back()->withErrors(['Empty', 'Silahkan Isi Semua Data'])->withInput();
        }

        $validateData = $request->validate([
            'gambar' => 'required|image|file',
            'nama_produk' => 'required',
            'jumlah_produk' => 'required',
            'harga_produk' => 'required',
            'harga_asli' => 'required'
        ]);
        
        if($request->file('gambar')) {
            $validateData['gambar'] = $request->file('gambar')->store('post-image');
        }

        data_produk::create($validateData);

        return redirect(('/produk'));
    }
    public function hapus($id)
    {
        data_produk::where('id',$id)->delete();
        return redirect(('/produk'));
    }

    public function edit(Request $request, $id)
    {   
        if ($request->gambar == null || $request->nama_produk == null || $request->jumlah_produk == null || $request->harga_produk == null || $request->harga_asli == null) {
            session()->flash('Empty', 'Silahkan Isi Semua Data');
            return redirect()->back()->withErrors(['Empty', 'Silahkan Isi Semua Data'])->withInput();
        }

        $validateData = $request->validate([
            'gambar' => 'required|image|file',
            'nama_produk' => 'required',
            'jumlah_produk' => 'required',
            'harga_produk' => 'required',
            'harga_asli' => 'required'
        ]);
        
        if($request->file('gambar')) {
            $validateData['gambar'] = $request->file('gambar')->store('post-image');
        }

        data_produk::where('id',$id)->update($validateData);

        return redirect(('/produk'));
    }

    public function beli(Request $request, $id)
    {
        $coba = DB::table('pembelians')->where([['id',Auth::id()],['barang_diterima',null]])->get();
        $produk = DB::table('data_produks')->where('id',$id)->get();

        if($coba->count() == 0)
        {
            pembelian::create(array_merge(['id_pembeli' => Auth::id()], ['total'=> null], ['metode_pembayaran'=> null], ['status_pembyaran'=> null], ['barang_diterima'=> null]));
        }

        $coba = DB::table('pembelians')->where([['id',Auth::id()],['barang_diterima',null]])->get();
        $total = $produk->first()->harga_produk * intval($request->jumlah_produk);

        detail_pembelian::create(array_merge(['id_pembelian'=> $coba->first()->id], ['id_produk'=> $id], ['nama_produk'=>$produk->first()->nama_produk], ['harga'=>$produk->first()->harga_produk], ['jumlah'=>intval($request->jumlah_produk)], ['total'=> $total]));

        $update_jumlah = $produk->first()->jumlah_produk - intval($request->jumlah_produk);

        data_produk::where('id',$id)->update(['jumlah_produk'=> $update_jumlah]);

        return redirect('/produk');
    }
}
