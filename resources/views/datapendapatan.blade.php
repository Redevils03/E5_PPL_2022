@extends('app')
@section('title', 'Kedelai Kamila')

@section('import')
<link href="{{ mix('css/profil.css') }}" rel="stylesheet" >
<link href="{{ mix('css/produk.css') }}" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<style>
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
            @if (session()->has('Empty')) 
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('Empty') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <script type="text/javascript">
                    $( document ).ready(function() {
                        $('#tombol_tambah').click();
                    });
                </script>
                @php session()->forget('Empty') @endphp
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

        <h2 class="mt-5" style="text-align: center; color: white;">Data Pendapatan</h2>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <table class="table table-primary table-striped mt-4">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Produk</th>
                            <th>Pendapatan</th>
                            <th>Pengeluaran</th>
                            <th>Keuntungan</th>
                            <th>Keterangan</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    @php
                        $pendapatan = DB::table('data_pendapatans')->get();
                    @endphp
                    @foreach ($pendapatan as $key => $data)
                        {{-- Konfirmasi hapus --}}
                        <div class="modal fade" id="konfirShow{{ $data->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-custom text-white">
                                    <div class="modal-header border-0 text-center">
                                        <h5 class="modal-title w-100" id="staticBackdropLabel">Hapus Data?</h5>
                                        <a href="/hapus_pendapatan/{{ $data->id }}"><button type="button" class="btn btn-success shadow-none" style="margin-right: 15px;"><b>Iya</b></button></a>
                                        <a href="/pendapatan"><button type="button" class="btn btn-danger shadow-none" ><b>Tidak</b></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <tbody id="data">
                            <tr>
                                <td>{{ $data->updated_at }}</td>
                                <td>{{ $data->nama_produk }}</td>
                                <td>{{ $data->pendapatan }}</td>
                                <td>{{ $data->pengeluaran }}</td>
                                <td>{{ $data->keuntungan }}</td>
                                <td>{{ $data->note }}</td>
                                <td><a><button type="button" id="tombol_edit" class="btn btn-success btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#editShow{{ $data->id }}"><i class="bi bi-pencil-square"></i></button></a></td>
                                <td><a><button type="button" class="btn btn-danger btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#konfirShow{{ $data->id }}"><i class="bi bi-trash3-fill"></i></button></a></td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>

                {{-- Formulir modal edit data --}}
                <div class="modal fade" id="editShow{{ $data->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content bg-custom text-white">
                            <div class="modal-header border-0 text-center">
                                <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Ubah Data Pendapatan</b></h5>
                                <a href="/pendapatan"><button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button></a>
                            </div>
                            <form class="modal-body text-black" action="/edit_pendapatan/{{ $data->id }}" method="post">
                                @csrf
                                <div>
                                    @php
                                        $detail = DB::table('data_pendapatans')->where('id',$data->id)->get();
                                    @endphp
                                    <input type="text" name="nama_produk" id="nama" class="mt-4 form-control" placeholder="Masukkan Nama Produk" value="{{ $detail->first()->nama_produk }}">
                                    <input name="pendapatan" id="pendapatan" type="number" class="form-control mt-4" placeholder="Masukkan Jumlah Pendapatan" value="{{ $detail->first()->pendapatan }}">
                                    <input name="pengeluaran" id="pengeluaran" type="number" class="form-control mt-4" placeholder="Masukkan Jumlah Pengeluaran" value="{{ $detail->first()->pengeluaran }}">
                                    <input name="keuntungan" id="keuntungan" type="number" class="form-control mt-4" placeholder="Masukkan Jumlah Keuntungan" value="{{ $detail->first()->keuntungan }}">
                                    <input name="note" id="note" type="text" class="form-control mt-4" placeholder="Masukkan Keterangan" value="{{ $detail->first()->note }}">
                                </div>
                                <div class="border-0 d-flex mt-4">
                                    <p class="me-auto"></p>
                                    <button type="submit" class="btn btn-success shadow-none"><b>Ubah</b></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Formulir modal tambah data --}}
                <div class="modal fade" id="tambahShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content bg-custom text-white">
                            <div class="modal-header border-0 text-center">
                                <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Tambah Data Pendapatan</b></h5>
                                <a href="/pendapatan"><button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button></a>
                            </div>
                            <form class="modal-body text-black" action="/tambah_pendapatan" method="post">
                                @csrf
                                <div>
                                    <input type="text" name="nama_produk" id="nama" class="mt-4 form-control" placeholder="Masukkan Nama Produk">
                                    <input name="pendapatan" id="pendapatan" type="number" class="form-control mt-4" placeholder="Masukkan Jumlah Pendapatan">
                                    <input name="pengeluaran" id="pengeluaran" type="number" class="form-control mt-4" placeholder="Masukkan Jumlah Pengeluaran">
                                    <input name="keuntungan" id="keuntungan" type="number" class="form-control mt-4" placeholder="Masukkan Jumlah Keuntungan">
                                    <input name="note" id="note" type="text" class="form-control mt-4" placeholder="Masukkan Keterangan">
                                </div>
                                <div class="border-0 d-flex mt-4">
                                    <p class="me-auto"></p>
                                    <button type="submit" class="btn btn-success shadow-none"><b>Tambah</b></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @php
                    $item = DB::table('data_pendapatans')->sum('keuntungan');
                @endphp
                <h5 style="color: white;"> Total Keuntungan : {{ $item }}</h5> 
                <a><button type="button" id="tombol_tambah" class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#tambahShow">Tambah</button></a>
            </div>
        </div>
    </div>
@endsection
</body>