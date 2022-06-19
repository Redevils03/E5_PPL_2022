@extends('app')
@section('title', 'Kedelai Kamila')

@section('import')
<link href="{{ mix('css/profil.css') }}" rel="stylesheet" >
<link href="{{ mix('css/produk.css') }}" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<style>
    .foto {
        width: calc(5rem + 1vw);
        padding: 10px;
    }
    .nama_pem {
        margin-top: 25px;
        margin-left: 20px;
        font-weight: 600;
    }
    .alert {
        z-index: 2000;
    }
</style>
@endsection

<body>
@section('content')
    <div>
        {{-- Tetap tampilkan modal saat ada input error --}}
        @if (count($errors) > 0)
            @if (session()->has('editEmpty')) 
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('editEmpty') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @php session()->forget('editEmpty') @endphp
            @endif
            @if (session()->has('bayarEmpty')) 
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('bayarEmpty') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <script type="text/javascript">
                    $( document ).ready(function() {
                        $('#tombol_bayar').click();
                    });
                </script>
                @php session()->forget('bayarEmpty') @endphp
            @endif
        @endif
        {{-- navbar atas --}}
        <div class="d-flex">
            <h4 class="me-auto kedelai1"><b>Kedelai Kamila</b></h4>
            <div class="rectangle1 d-flex">
                <a href="/produk" class="aPadd"><img class="home1" src="img/home.png"></a>
                <a href="/profil" class="aPadd"><img class="home1" src="img/user.png"></a>
                <div class="dropdown">
                    <a href="" class="aPadd" id="imageDropdown" data-bs-toggle="dropdown">
                        <img class="drop1" src="img/drop.png">
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="imageDropdown">
                        @if (Auth::guard('admin')->check())
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/daftarpembeli">Daftar Akun Pembeli</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/pendapatan">Data Pendapatan</a></li>
                        @elseif (Auth::guard('web')->check())
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/chat/{{ Auth::id() }}">Chat Admin</a></li>
                        @endif
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/daftarpembelian">Daftar Pembelian</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/infomitra">Informasi Mitra</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <h2 class="mt-5" style="text-align: center; color: white;">Daftar Pembelian</h2>
        <div class="container-fluid">
            <h4 style="color: white;">Pembelian Saat ini</h4>
            @if (Auth::guard('admin')->check())
                <?php
                try {
                    $df_pem = DB::table('pembelians')->whereNotNull('metode_pembayaran')->where([['barang_diterima', null]])->get();
                    $notnull = True;
                } catch (\Exception $e) {
                    $notnull = False;
                }
                ?>
                @if ($notnull)
                @foreach ($df_pem as $item)
                    @if ($item->total != 0)
                    <?php
                        $pembeli = DB::table('akun_pembelis')->where([['id',$item->id_pembeli]])->get();
                        $detail = DB::table('detail_pembelians')->where('id_pembelian',$item->id)->get();  
                    ?>
                    <div class="row justify-content-center">
                        <table class="table table-primary table-striped mt-4">
                            <h5 style="color: white">{{ $pembeli->first()->nama }}</h5>
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Nama Produk</th>
                                    <th>Harga per Unit</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            @foreach ($detail as $key => $data)
                                <tbody id="data">
                                    <tr>
                                        <td>{{ $data->created_at }}</td>
                                        <td>{{ $data->jumlah }}</td>
                                        <td>{{ $data->nama_produk }}</td>
                                        <td>{{ $data->harga }}</td>
                                        <td>{{ $data->total }}</td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>

                        {{-- Formulir Bayar --}}
                        <div class="modal fade" id="bayarForm{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-custom text-white">
                                    <div class="modal-header border-0 text-center">
                                        <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Pembayaran</b></h5>
                                        <a href="/daftarpembelian"><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></a>
                                    </div>
                                    <div style="color: white">
                                        @php
                                            $var = DB::table('pembelians')->where([['id',$item->id],['barang_diterima', null]])->get();
                                        @endphp
                                        @if ($var->first()->metode_pembayaran == 'COD')
                                            <p style="margin-left: 20px">Pembayaran Melalui : COD</p>
                                        @else
                                            <div class="justify">

                                            </div>
                                            <img src="{{ asset('storage/' . $var->first()->metode_pembayaran) }}" width="495">
                                        @endif
                                    </div>
                                    <div class="border-0 d-flex mt-4">
                                        <p class="me-auto"></p>
                                        <a href="/terima_pembayaran/{{ $item->id }}"><button type="submit" class="btn btn-success shadow-none" style="margin-right: 20px; margin-bottom:20px;"><b>Konfirmasi</b></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Konfirmasi hapus --}}
                        <div class="modal fade" id="konfirShow{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-custom text-white">
                                    <div class="modal-header border-0 text-center">
                                        <h5 class="modal-title w-100" id="staticBackdropLabel">Hapus Pesanan?</h5>
                                        <a href="/admin_hapus_pembelian/{{ $item->id }}"><button type="button" class="btn btn-success shadow-none" style="margin-right: 15px;"><b>Iya</b></button></a>
                                        <a href="/daftarpembelian"><button type="button" class="btn btn-danger shadow-none" ><b>Tidak</b></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Konfirmasi hapus --}}
                        <div class="modal fade" id="konfir_Show{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-custom text-white">
                                    <div class="modal-header border-0 text-center">
                                        <h5 class="modal-title w-100" id="staticBackdropLabel">Hapus Pembayaran?</h5>
                                        <a href="/hapus_pembayaran/{{ $item->id }}"><button type="button" class="btn btn-success shadow-none" style="margin-right: 15px;"><b>Iya</b></button></a>
                                        <a href="/daftarpembelian"><button type="button" class="btn btn-danger shadow-none" ><b>Tidak</b></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 style="color: white;"> Total Pembayaran : {{ $item->total }}</h5> 
                        @if ($item->metode_pembayaran != null && $item->status_pembayaran == null)
                            <div style="display: inline-flex">
                                <a><button id="tombol_bayar" type="button" class="btn btn-danger btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#bayarForm{{ $item->id }}">Pembayaran</button></a>
                                <a style="margin-left: 10px;"><button type="button" class="btn btn-danger shadow-none" data-bs-toggle="modal" data-bs-target="#konfirShow{{ $item->id }}"><i class="bi bi-trash3-fill"></i></button></a>
                            </div>
                        @elseif ($item->metode_pembayaran != null && $item->status_pembayaran == 'terima' && $item->barang_diterima != 'Diterima')
                            <div style="display: inline-flex">
                                <a href="/admin_konfirmasi/{{ $item->id }}"><button type="submit" class="btn btn-success shadow-none">Konfirmasi</button></a>
                                <a style="margin-left: 10px;"><button type="button" class="btn btn-danger shadow-none" data-bs-toggle="modal" data-bs-target="#konfir_Show{{ $item->id }}">Hapus Pembayaran</button></a>
                                {{-- <a style="margin-left: 10px;"><button type="button" class="btn btn-danger shadow-none" data-bs-toggle="modal" data-bs-target="#konfirShow{{ $item->id }}"><i class="bi bi-trash3-fill"></i></button></a> --}}
                            </div>
                        @elseif ($item->status_pembayaran == 'Diterima' && $item->barang_diterima != 'Diterima')
                            <p style="color: white;">Menunggu Pembeli Konfirmasi Penerimaan Produk...</p>
                        @endif
                    </div>
                    @endif
                @endforeach
                @endif
                <h4 class="mt-4" style="color: white;">Pembelian Terdahulu</h4>
                <?php
                try {
                    $produk = DB::table('pembelians')->where([['barang_diterima','Diterima']])->get();
                    $notnull = True;
                } catch (\Exception $e) {
                    $notnull = False;
                }
                ?>
                @if ($notnull)
                    @foreach ($produk as $key => $cek)
                        @if ($cek->metode_pembayaran != null && $cek->barang_diterima != null)
                            <?php
                            $pembeli = DB::table('akun_pembelis')->where([['id',$cek->id_pembeli]])->get();
                            $detail = DB::table('detail_pembelians')->where('id_pembelian',$cek->id)->get();
                            ?>
                            <div class="row justify-content-center">
                                <table class="table table-primary table-striped mt-4">
                                    <h5 class="mt-3" style="color: white">{{ $pembeli->first()->nama }}</h5>
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Nama Produk</th>
                                            <th>Harga per Unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    @foreach ($detail as $key => $data)
                                        <tbody id="data">
                                            <tr>
                                                <td>{{ $data->created_at }}</td>
                                                <td>{{ $data->jumlah }}</td>
                                                <td>{{ $data->nama_produk }}</td>
                                                <td>{{ $data->harga }}</td>
                                                <td>{{ $data->total }}</td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                                <h5 style="color: white;"> Total Pembayaran : {{ $cek->total }}</h5> 
                            </div>
                        @endif
                    @endforeach
                @endif
            @elseif (Auth::guard('web')->check())
                <?php
                $daftar = DB::table('data_produks')->get(); 
                $produk = DB::table('pembelians')->where([['id_pembeli',Auth::id()],['barang_diterima',null]])->get();
                try {
                    $detail = DB::table('detail_pembelians')->where('id_pembelian',$produk->first()->id)->get();
                    $notnull = True;
                } catch (\Exception $e) {
                    $notnull = False;
                }
                ?>
                @if ($notnull)
                    @foreach ($produk as $item)
                    @if ($item->total != 0)
                    <?php
                        $detail = DB::table('detail_pembelians')->where('id_pembelian',$item->id)->get(); 
                    ?>
                    <div class="row justify-content-center">
                        <table class="table table-primary table-striped mt-4">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Nama Produk</th>
                                    <th>Harga per Unit</th>
                                    <th>Total</th>
                                    @if ($item->metode_pembayaran == null)
                                        <th>Edit</th>
                                        <th>Hapus</th>
                                    @endif
                                </tr>
                            </thead>
                            @foreach ($detail as $key => $data)

                                {{-- Konfirmasi hapus --}}
                                <div class="modal fade" id="konfirShow{{ $data->id_produk }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-custom text-white">
                                            <div class="modal-header border-0 text-center">
                                                <h5 class="modal-title w-100" id="staticBackdropLabel">Hapus Produk?</h5>
                                                <a href="/pembelian/{{ $data->id_produk }}"><button type="button" class="btn btn-success shadow-none" style="margin-right: 15px;"><b>Iya</b></button></a>
                                                <a href="/daftarpembelian"><button type="button" class="btn btn-danger shadow-none" ><b>Tidak</b></button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <tbody id="data">
                                    <tr>
                                        <td>{{ $data->created_at }}</td>
                                        <td>{{ $data->jumlah }}</td>
                                        <td>{{ $data->nama_produk }}</td>
                                        <td>{{ $data->harga }}</td>
                                        <td>{{ $data->total }}</td>

                                        {{-- Formulir Edit --}}
                                        <div class="modal fade" id="editShow{{ $data->id_produk }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content bg-custom text-white">
                                                    <div class="modal-header border-0 text-center">
                                                        <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Edit Produk</b></h5>
                                                        <a href="/daftarpembelian"><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></a>
                                                    </div>
                                                    <form class="text-black" action="/editpembelian/{{ $data->id_produk }}" method="post">
                                                        @csrf
                                                        <div style="margin-left:20px; margin-right:20px;">
                                                            <label for="nama_produk" style="color: white; font-weight: 600;">Nama Produk</label>
                                                            <select class="form-control" name="nama_produk" id="nama_produk" onChange="stok(this)">
                                                                <option value="" disabled selected hidden>-</option>
                                                                @foreach ($daftar as $key => $value)
                                                                    @if ($data->id_produk == $value->id)
                                                                        <option value='{"nama":"{{ $value->nama_produk }}", "jumlah":"{{ $value->jumlah_produk + $data->jumlah }}"}'>{{ $value->nama_produk }}</option>
                                                                    @else
                                                                        <option value='{"nama":"{{ $value->nama_produk }}", "jumlah":"{{ $value->jumlah_produk}}"}'>{{ $value->nama_produk }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <input name="jumlah_produk" id="jumlah_produk" type="number" class="form-control mt-4" placeholder="Masukkan Jumlah Produk" min="1" max="2" oninvalid="setCustomValidity('Pesanan produk minimal 1 dan maksimal stok produk saat ini!')"
                                                            onchange="try{setCustomValidity('')}catch(e){}">
                                                            <script>
                                                            function stok(el){
                                                                var dict = JSON.parse(el.value);
                                                                document.getElementById("jumlah_produk").max = dict["jumlah"];
                                                                document.getElementById("jumlah_produk").placeholder = "Masukkan Jumlah Produk - Stok Produk : "+dict["jumlah"];
                                                            }
                                                            </script>
                                                        </div>
                                                        <div class="border-0 d-flex mt-4">
                                                            <p class="me-auto"></p>
                                                            <button type="submit" class="btn btn-success shadow-none" style="margin-right: 20px; margin-bottom:20px;"><b>Ubah</b></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($item->metode_pembayaran == null)
                                            <td><a><button type="button" id="tombol_edit" class="btn btn-success btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#editShow{{ $data->id_produk }}"><i class="bi bi-pencil-square"></i></button></a></td>
                                            <td><a><button type="button" class="btn btn-danger btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#konfirShow{{ $data->id_produk }}"><i class="bi bi-trash3-fill"></i></button></a></td>
                                        @endif
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                        {{-- Formulir Bayar --}}
                        <div class="modal fade" id="bayarForm{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-custom text-white">
                                    <div class="modal-header border-0 text-center">
                                        <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Pembayaran</b></h5>
                                        <a href="/daftarpembelian"><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></a>
                                    </div>
                                    <form class="text-black" action="/bayar/{{ $item->id}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div style="margin-left:20px; margin-right:20px;">
                                            <label for="metode" style="color: white; font-weight: 600;">Metode Pembayaran</label>
                                            <select class="form-control" name="metode" id="metode" onChange="stok(this)">
                                                <option value="" disabled selected hidden>-</option>
                                                <option value="COD">COD</option>
                                                <option value="E-money">E-money</option>
                                            </select>
                                            <div class="mt-4" id="bukti" style="display: none">
                                                <label style="color: white; font-weight: 600;">Upload Bukti Pembayaran</label>
                                                <input  name='foto' class="form-control" type="file">
                                                <p style="color: white">Dana / Gopay : 082140245588</p>
                                            </div>
                                            <script>
                                            function stok(el){
                                                if (el.value == "E-money") {
                                                    document.getElementById("bukti").style.display = "block";
                                                } else {
                                                    document.getElementById("bukti").style.display = "none";
                                                }
                                            }
                                            </script>
                                        </div>
                                        <div class="border-0 d-flex mt-4">
                                            <p class="me-auto"></p>
                                            <button type="submit" class="btn btn-success shadow-none" style="margin-right: 20px; margin-bottom:20px;"><b>Bayar</b></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <h5 style="color: white;"> Total Pembayaran : {{ $item->total }}</h5> 
                        @if ($item->metode_pembayaran == null)
                            <a><button id="tombol_bayar" type="button" class="btn btn-danger btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#bayarForm{{ $item->id }}">Bayar</button></a>
                        @elseif ($item->metode_pembayaran != null && ($item->status_pembayaran == 'terima' || $item->status_pembayaran == 'Diterima'))
                            <a href="/terima/{{ $item->id }}"><button type="submit" class="btn btn-success shadow-none">Terima</button></a>
                        @else
                            <p style="color: white">Menunggu Verifikasi Pembayaran...</p>
                        @endif
                    </div>                  
                    @endif
                    @endforeach
                @endif
                <h4 class="mt-4" style="color: white;">Pembelian Terdahulu</h4>
                <?php
                    $daftar = DB::table('data_produks')->get(); 
                try {
                    $produk = DB::table('pembelians')->where([['id_pembeli',Auth::id()],['barang_diterima','Diterima']])->get();
                    $notnull = True;
                } catch (\Exception $e) {
                    $notnull = False;
                }
                ?>
                @if ($notnull)
                    @foreach ($produk as $key => $cek)
                        @if ($cek->metode_pembayaran != null && $cek->barang_diterima != null)
                            <?php
                            $detail = DB::table('detail_pembelians')->where('id_pembelian',$cek->id)->get();
                            ?>
                            <div class="row justify-content-center">
                                <table class="table table-primary table-striped mt-4">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Nama Produk</th>
                                            <th>Harga per Unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    @foreach ($detail as $key => $data)
                                        <tbody id="data">
                                            <tr>
                                                <td>{{ $data->created_at }}</td>
                                                <td>{{ $data->jumlah }}</td>
                                                <td>{{ $data->nama_produk }}</td>
                                                <td>{{ $data->harga }}</td>
                                                <td>{{ $data->total }}</td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                                <h5 style="color: white;"> Total Pembayaran : {{ $cek->total }}</h5> 
                            </div>
                        @endif
                    @endforeach
                @endif
            @endif
        </div>
    </div>
@endsection
</body>