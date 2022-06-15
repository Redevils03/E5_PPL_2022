<?php

namespace App\Http\Controllers;

use App\Models\data_produk;
use App\Models\pembelian;
use App\Models\detail_pembelian;
use App\Models\data_pendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk');
    }

    public function terima($id)
    {
        pembelian::where([['id',$id],['id_pembeli',Auth::id()],['status_pembayaran','Diterima']])->update(['barang_diterima'=>'Diterima']);

        return redirect(('/daftarpembelian'));
    }

    public function terima_pembayaran($id)
    {
        pembelian::where([['id',$id],['status_pembayaran',null]])->update(['status_pembayaran'=>'terima']);

        return redirect(('/daftarpembelian'));
    }

    public function admin_konfirmasi($id)
    {
        pembelian::where([['id',$id]])->update(['status_pembayaran'=>'Diterima']);

        return redirect(('/daftarpembelian'));
    }

    public function bayar(Request $request, $id)
    {
        if ($request->metode == null) {
            session()->flash('bayarEmpty', 'Silahkan Isi Semua Data');
            return redirect()->back()->withErrors(['bayarEmpty', 'Silahkan Isi Semua Data'])->withInput();
        }
        if ($request['metode'] == 'COD') {
            pembelian::where([['id',$id],['id_pembeli',Auth::id()],['metode_pembayaran',null]])->update(['metode_pembayaran'=>'COD']);
        } else {
            if ($request->foto == null) {
                session()->flash('bayarEmpty', 'Silahkan Isi Semua Data');
                return redirect()->back()->withErrors(['bayarEmpty', 'Silahkan Isi Semua Data'])->withInput();
            }

            $validateData = $request->validate([
                'foto' => 'required|image|file',
                'metode' => 'required'
            ]);

            if($request->file('foto')) {
                $validateData['foto'] = $request->file('foto')->store('post-image');
            }
            pembelian::where([['id',$id],['id_pembeli',Auth::id()],['metode_pembayaran',null]])->update(['metode_pembayaran'=>$validateData['foto']]);
        }

        return redirect(('/daftarpembelian'));
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

    public function tambah_pendapatan(Request $request)
    {
        if ($request->nama_produk == null || $request->pendapatan == null || $request->pengeluaran == null || $request->keuntungan == null || $request->note == null) {
            session()->flash('Empty', 'Silahkan Isi Semua Data');
            return redirect()->back()->withErrors(['Empty', 'Silahkan Isi Semua Data'])->withInput();
        }
        
        $validateData = $request->validate([
            'nama_produk' => 'required',
            'pendapatan' => 'required',
            'pengeluaran' => 'required',
            'keuntungan' => 'required',
            'note' => 'required'
        ]);

        data_pendapatan::create($validateData);

        return redirect('/pendapatan');
    }

    public function hapus_pendapatan($id)
    {
        data_pendapatan::where('id',$id)->delete();
        return redirect(('/pendapatan'));
    }
    public function hapus($id)
    {
        data_produk::where('id',$id)->delete();
        return redirect(('/produk'));
    }
    public function hapus_pembelian($id)
    {
        $coba = DB::table('pembelians')->where([['id_pembeli',Auth::id()],['metode_pembayaran',null]])->get();
        $jumlah_produk = DB::table('detail_pembelians')->where([['id_pembelian',$coba->first()->id],['id_produk',$id]])->get();
        $jumlah_skrg = DB::table('data_produks')->where('id',$id)->get();
        $jumlah_baru = $jumlah_skrg->first()->jumlah_produk + $jumlah_produk->first()->jumlah;

        data_produk::where('id',$id)->update(['jumlah_produk'=>$jumlah_baru]);
        detail_pembelian::where([['id_pembelian',$coba->first()->id],['id_produk',$id]])->delete();

        $total_harga = DB::table('detail_pembelians')->where('id_pembelian',$coba->first()->id)->sum('total');
        pembelian::where([['id_pembeli',Auth::id()],['metode_pembayaran',null]])->update(['total'=>$total_harga]);
        return redirect(('/daftarpembelian'));
    }

    public function hapus_pembayaran($id)
    {
        pembelian::where([['id',$id]])->update(['status_pembayaran'=>null]);

        return redirect(('/daftarpembelian'));
    }

    public function admin_hapus_pembelian($id)
    {
        $coba = DB::table('pembelians')->where([['id',$id],['status_pembayaran',null]])->delete();
        $detail = DB::table('detail_pembelians')->where([['id_pembelian',$id]])->get();
        foreach ($detail as $key => $value) {
            $produk = DB::table('data_produks')->where('id',$value->id_produk)->get();
            $jumlah_baru = $produk->first()->jumlah_produk + $value->jumlah;

            data_produk::where('id',$value->id_produk)->update(['jumlah_produk'=>$jumlah_baru]);
            detail_pembelian::where([['id_pembelian',$id],['id_produk',$value->id_produk]])->delete();
        }
        return redirect(('/daftarpembelian'));
    }

    public function edit(Request $request, $id)
    {   
        if ($request->gambar == null || $request->nama_produk == null || $request->jumlah_produk == null || $request->harga_produk == null || $request->harga_asli == null) {
            session()->flash('editEmpty', 'Silahkan Isi Semua Data');
            return redirect()->back()->withErrors(['editEmpty', 'Silahkan Isi Semua Data'])->withInput();
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
    public function edit_pembelian(Request $request, $id)
    {
        if ($request->nama_produk == null || $request->jumlah_produk == null) {
            session()->flash('editEmpty', 'Silahkan Isi Semua Data');
            return redirect()->back()->withErrors(['editEmpty', 'Silahkan Isi Semua Data'])->withInput();
        }

        // Update detail pembelian
        $coba = DB::table('pembelians')->where([['id_pembeli',Auth::id()],['metode_pembayaran',null]])->get();
        $jumlah_produk = DB::table('detail_pembelians')->where([['id_pembelian',$coba->first()->id],['id_produk',$id]])->get();
        $jumlah_skrg = DB::table('data_produks')->where('id',$id)->get();

        $dict = json_decode($request->nama_produk);
        $produk = DB::table('data_produks')->where('nama_produk',$dict->nama)->get();
        if ($id == $produk->first()->id) {
            // update stok produk lama
            if ($request->jumlah_produk > $jumlah_produk->first()->jumlah) {
                $jumlah_baru = $jumlah_skrg->first()->jumlah_produk - ($request->jumlah_produk - $jumlah_produk->first()->jumlah);
            } else {
                $jumlah_baru = $jumlah_skrg->first()->jumlah_produk + ($jumlah_produk->first()->jumlah - $request->jumlah_produk);
            }
            data_produk::where('id',$id)->update(['jumlah_produk'=>$jumlah_baru]);

            // update pembelian
            $total = $produk->first()->harga_produk * $request->jumlah_produk;
            detail_pembelian::where([['id_pembelian', $coba->first()->id], ['id_produk', $id]])->update(['jumlah'=>$request->jumlah_produk,'total'=>$total]);

        } else {
            // Update stok produk lama
            $jumlah_baru = $jumlah_skrg->first()->jumlah_produk + $jumlah_produk->first()->jumlah;
            data_produk::where('id',$id)->update(['jumlah_produk'=>$jumlah_baru]);

            $jumlah_skrg = DB::table('data_produks')->where('id',$produk->first()->id)->get();
            $jumlah_baru = $jumlah_skrg->first()->jumlah_produk - $request->jumlah_produk;
            data_produk::where('id',$produk->first()->id)->update(['jumlah_produk'=>$jumlah_baru]);

            try {
                // update pembelian
                $jumlah_produk = DB::table('detail_pembelians')->where([['id_pembelian',$coba->first()->id],['id_produk',$produk->first()->id]])->get();
                $jumlah_baru = $jumlah_produk->first()->jumlah + intval($request->jumlah_produk);
                $total = $produk->first()->harga_produk * $jumlah_baru;
                detail_pembelian::where([['id_pembelian', $coba->first()->id], ['id_produk', $produk->first()->id]])->update(['jumlah'=>$jumlah_baru, 'total'=>$total]);

            } catch (\Exception $e) {
                
                $total = $produk->first()->harga_produk * intval($request->jumlah_produk);
                detail_pembelian::where([['id_pembelian', $coba->first()->id], ['id_produk', $id]])->update(['id_produk'=>$produk->first()->id, 'nama_produk'=>$produk->first()->nama_produk, 'harga'=>$produk->first()->harga_produk, 'jumlah'=>intval($request->jumlah_produk), 'total'=>$total]);
                detail_pembelian::where([['id_pembelian',$coba->first()->id],['id_produk',$id]])->delete();

            }
        }

        // update total harga di pembelian
        $total_harga = DB::table('detail_pembelians')->where('id_pembelian',$coba->first()->id)->sum('total');
        pembelian::where([['id_pembeli',Auth::id()],['metode_pembayaran',null]])->update(['total'=>$total_harga]);

        return redirect(('/daftarpembelian'));
    }
    public function edit_pendapatan(Request $request, $id)
    {
        if ($request->nama_produk == null || $request->pendapatan == null || $request->pengeluaran == null || $request->keuntungan == null || $request->note == null) {
            session()->flash('editEmpty', 'Silahkan Isi Semua Data');
            return redirect()->back()->withErrors(['editEmpty', 'Silahkan Isi Semua Data'])->withInput();
        }
        
        $validateData = $request->validate([
            'nama_produk' => 'required',
            'pendapatan' => 'required',
            'pengeluaran' => 'required',
            'keuntungan' => 'required',
            'note' => 'required'
        ]);

        data_pendapatan::where([['id',$id]])->update($validateData);

        return redirect('/pendapatan');
    }
    public function beli(Request $request, $id)
    {
        if ($request->jumlah_produk == null) {
            session()->flash('beliEmpty', 'Silahkan Isi Semua Data');
            return redirect()->back()->withErrors(['beliEmpty', 'Silahkan Isi Semua Data']);
        }

        $coba = DB::table('pembelians')->where([['id_pembeli',Auth::id()],['metode_pembayaran',null]])->get();
        $produk = DB::table('data_produks')->where('id',$id)->get();

        if($coba->count() == 0)
        {
            pembelian::create(array_merge(['id_pembeli' => Auth::id()], ['total'=> null], ['metode_pembayaran'=> null], ['status_pembyaran'=> null], ['barang_diterima'=> null]));
        }

        $coba = DB::table('pembelians')->where([['id_pembeli',Auth::id()],['metode_pembayaran',null]])->get();
        try {

            $detail = DB::table('detail_pembelians')->where([['id_pembelian', $coba->first()->id], ['id_produk',$id]])->get();
            $jumlah_baru = $detail->first()->jumlah + intval($request->jumlah_produk);
            $total = $produk->first()->harga_produk * $jumlah_baru;
            detail_pembelian::where([['id_pembelian', $coba->first()->id], ['id_produk', $id]])->update(['jumlah'=>$jumlah_baru,'total'=>$total]);

        } catch (\Exception $e) {

            $total = $produk->first()->harga_produk * intval($request->jumlah_produk);
            detail_pembelian::create(array_merge(['id_pembelian'=> $coba->first()->id], ['id_produk'=> $id], ['nama_produk'=>$produk->first()->nama_produk], ['harga'=>$produk->first()->harga_produk], ['jumlah'=>intval($request->jumlah_produk)], ['total'=> $total]));

        }

        $total_harga = DB::table('detail_pembelians')->where('id_pembelian',$coba->first()->id)->sum('total');
        pembelian::where([['id_pembeli',Auth::id()],['metode_pembayaran',null]])->update(['total'=>$total_harga]);

        $update_jumlah = $produk->first()->jumlah_produk - intval($request->jumlah_produk);
        data_produk::where('id',$id)->update(['jumlah_produk'=> $update_jumlah]);

        return redirect('/produk');
    }
}
