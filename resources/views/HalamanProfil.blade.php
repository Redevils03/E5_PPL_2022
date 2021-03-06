@extends('app')
@section('title', 'Kedelai Kamila')

@section('import')
<link href="{{ mix('css/profil.css') }}" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
            @if (session()->has('Empty')) 
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('Empty') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <script type="text/javascript">
                $( document ).ready(function() {
                    $('#editShow').modal('show');
                });
            </script>
        @endif

        {{-- navbar atas --}}
        <div class="d-flex">
            <h4 class="me-auto kedelai1"><b>Kedelai Kamila</b></h4>
            <div class="rectangle1 d-flex">
                <a href="/produk" class="aPadd"><img class="home1" src="img/home.png"></a>
                <a href="" class="aVisit aPadd"><img class="home1" src="img/user.png"></a>
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

        {{-- Konfirmasi Logout --}}
        <div class="modal fade" id="logoutShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-custom text-white">
                    <form action="/logout" method="post">
                        @csrf
                        <div class="mt-3 modal-header border-0 text-center">
                            <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Keluar Akun?</b></h5>
                            <a><button type="submit" class="btn btn-success shadow-none" style="margin-right: 15px;"><b>Iya</b></button></a>
                            <a href="/profil"><button type="button" class="btn btn-danger shadow-none"><b>Tidak</b></button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Tampilan profil --}}
        @if (Auth::guard('admin')->check())
            <img src='img/foto_null.png' class='rounded-circle fotoProfil'>
            <div class="profil1">
                <br> <h3 class="namapem">Kedelai Kamila</h3> <br>
                <h6 class="identitas">
                Email &emsp;&emsp;&emsp;&emsp;&emsp;&ensp;: {{ Auth::guard('admin')->user()->email }} <br><br>
                Password &emsp;&emsp;&emsp;&ensp;: Secured <br><br>
                </h6>
            </div>
        @elseif (Auth::guard('web')->check())
            @if (empty(Auth::user()->foto))
                <img src='img/foto_null.png' class='rounded-circle fotoProfil'>
            @else
                <img src="{{ asset('storage/' . Auth::user()->foto) }}" class='rounded-circle fotoProfil'>
            @endif
            <div class="profil1">
                <br> <h3 class="namapem"> {{Auth::user()->nama}}</h3> <br>
                <h6 class="identitas">
                Nomor Telepon &emsp;: {{Auth::user()->nomor_telp}} <br><br>
                Email &emsp;&emsp;&emsp;&emsp;&emsp;&ensp;: {{Auth::user()->email}} <br><br>
                Password &emsp;&emsp;&emsp;&ensp;: Secured <br><br>
                Alamat &emsp;&emsp;&emsp;&emsp;&ensp;: {{Auth::user()->alamat}} <br><br>
                Jenis Kelamin &emsp;&ensp;: {{Auth::user()->jenis_kelamin}} <br><br>
                </h6>
            </div>
        @endif

        {{-- Modal formulir edit pembeli --}}
        <div class="modal fade" id="editShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-custom text-white">
                    <div class="modal-header border-0 text-center">
                        <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Edit Data Profil</b></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="modal-body text-black" action="/edit" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (Auth::guard('admin')->check())
                            <div>
                                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        Mohon isikan email dengan format yang sesuai.
                                    </div>
                                @enderror
                                <input name="password" id="password" type="password" class="form-control mt-4 @error('password') is-invalid @enderror" placeholder="Password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        Mohon isikan password dengan minimal 6 karakter dan maksimal 15 karakter.
                                    </div>
                                @enderror
                            </div>
                            <div class="border-0 d-flex mt-4">
                                <p class="me-auto"></p>
                                <button type="submit" class="btn btn-success shadow-none"><b>Edit</b></button>
                            </div>
                        @elseif (Auth::guard('web')->check())
                            <div>
                                <label style="color: white; font-weight: 600;">Upload Gambar</label>
                                <input  name='foto' class="form-control" type="file" placeholder="Foto Profil">
                                <input type="email" name="email" id="email" class="mt-4 form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email" value="{{Auth::user()->email}}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        Mohon isikan email dengan format yang sesuai.
                                    </div>
                                @enderror
                                <input name="password" id="password" type="password" class="form-control mt-4 @error('password') is-invalid @enderror" placeholder="Password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        Mohon isikan password dengan minimal 6 karakter dan maksimal 15 karakter.
                                    </div>
                                @enderror
                                <input name="nama" id="nama" type="text" class="form-control mt-4 @error('nama') is-invalid @enderror" placeholder="Masukkan nama" value="{{Auth::user()->nama}}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        Mohon isikan nama dengan maksimal 30 karakter.
                                    </div>
                                @enderror
                                <input name="nomor_telp" id="nomor_telp" type="number" class="form-control mt-4 @error('nomor_telp') is-invalid @enderror" placeholder="Masukkan nomor telepon" value="{{Auth::user()->nomor_telp}}">
                                @error('nomor_telp')
                                    <div class="invalid-feedback">
                                        Mohon isikan nomor telepon yang valid.
                                    </div>
                                @enderror
                                <input name="alamat" id="alamat" type="text" class="form-control mt-4 @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat" value="{{Auth::user()->alamat}}">
                                @error('nomor_telp')
                                    <div class="invalid-feedback">
                                        Mohon isikan alamat tempat tinggal saat ini.
                                    </div>
                                @enderror
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select mt-4 @error('jenis_kelamin') is-invalid @enderror" value="{{ old ('jenis_kelamin') }}" invalid="">
                                    <option value="" disabled selected hidden>Jenis Kelamin</option>
                                    <option value="laki-laki">Laki-Laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        Mohon pilih jenis kelamin yang sesuai.
                                    </div>
                                @enderror
                            </div>
                            <div class="border-0 d-flex mt-4">
                                <p class="me-auto"></p>
                                <button type="submit" class="btn btn-success shadow-none"><b>Ubah</b></button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        {{-- Tombol edit dan logout --}}
        <div class="d-flex profil1">
            <div>
                <button type="submit" class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#editShow" style="margin-right: 30px;"> Edit </button>
            </div>
            <button type="submit" class="btn btn-danger shadow-none" data-bs-toggle="modal" data-bs-target="#logoutShow"> Logout </button>
        </div>
    </div>
@endsection
</body>