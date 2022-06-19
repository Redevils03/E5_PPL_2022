@extends('app')
@section('title', 'Kedelai Kamila')

@section('import')
<link href="{{ mix('css/profil.css') }}" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<style>
    .namapem {
        font-size: calc(1.3em + 2vw);
        font-weight: 600;
    }

    .identitas {
        font-size: calc(0.8em + 0.7vw);
    }

    .btn {
        font-weight: 600;
    }

    select[invalid=""] {
        font-weight: 600;
        color: rgb(104, 104, 104);
    }
    option[value=""][disabled] {
        display: none;
    }
    option {
        font-weight: 100;
        color: black;
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
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#tombol_edit").click(); 
                    });
                </script>
                @php session()->forget('editEmpty') @endphp
            @endif
            @if (session()->has('Empty')) 
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('Empty') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#tombol_tambah").click(); 
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

        {{-- Tampilan Informasi --}}
        @php
            $data = DB::table('informasi_mitras')->get();
        @endphp
        <div class="profil1" style="margin-right: 40px">
            <br> <h3 class="namapem"> Kedelai Kamila </h3> <br>
            <h6 class="identitas">
            Nomor Telepon &emsp;: {{ $data->first()->no_telepon }} <br><br>
            Alamat &emsp;&emsp;&emsp;&emsp;&ensp;: {{ $data->first()->alamat }} <br><br>
            Keterangan : {{  $data->first()->deskripsi  }}
            </h6>
        </div>
        @if (Auth::guard('admin')->check())
            <a style="margin-left: 70px;"><button type="button" id="tombol_tambah" class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#tambahShow">Tambah</button></a>
            <a style="margin-left: 10px;"><button type="button" id="tombol_edit" class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#editShow"><i class="bi bi-pencil-square"></i></button></a>
            <a style="margin-left: 10px;"><button type="button" class="btn btn-danger shadow-none" data-bs-toggle="modal" data-bs-target="#konfirShow"><i class="bi bi-trash3-fill"></i></button></a>
        @endif

        {{-- Konfirmasi hapus --}}
        <div class="modal fade" id="konfirShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-custom text-white">
                    <div class="modal-header border-0 text-center">
                        <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Hapus Keterangan?</b></h5>
                        <a href="/hapus_info"><button type="button" class="btn btn-success shadow-none" style="margin-right: 15px;"><b>Iya</b></button></a>
                        <a href="/infomitra"><button type="button" class="btn btn-danger shadow-none" ><b>Tidak</b></button></a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Formulir modal tambah data --}}
        <div class="modal fade" id="tambahShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-custom text-white">
                    <div class="modal-header border-0 text-center">
                        <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Tambah Data Pendapatan</b></h5>
                        <a href="/infomitra"><button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button></a>
                    </div>
                    <form class="modal-body text-black" action="/tambah_info" method="post">
                        @csrf
                        <div>
                            <input type="text" name="keterangan" id="keterangan" class="mt-4 form-control" placeholder="Masukkan Keterangan Tambahan">
                        </div>
                        <div class="border-0 d-flex mt-4">
                            <p class="me-auto"></p>
                            <button type="submit" class="btn btn-success shadow-none"><b>Tambah</b></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal formulir edit informasi --}}
        <div class="modal fade" id="editShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-custom text-white">
                    <div class="modal-header border-0 text-center">
                        <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Edit Data Informasi</b></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="modal-body text-black" action="/ubah_info" method="post">
                        @csrf
                        <div>
                            @php
                                $data = DB::table('informasi_mitras')->get();
                            @endphp
                            <input type="text" name="alamat" id="alamat" class="mt-4 form-control" placeholder="Masukkan Alamat" value="{{ $data->first()->alamat }}">
                            <input type="number" name="no_telp" id="no_telp" class="mt-4 form-control" placeholder="Masukkan Nomor Telepon" value="{{ $data->first()->no_telepon }}">
                            <input type="text" name="keterangan" id="keterangan" class="mt-4 form-control" placeholder="Masukkan Keterangan Tambahan" value="{{ $data->first()->deskripsi }}">
                        </div>
                        <div class="border-0 d-flex mt-4">
                            <p class="me-auto"></p>
                            <button type="submit" class="btn btn-success shadow-none"><b>Ubah</b></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
</body>