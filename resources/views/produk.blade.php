@extends('app')
@section('title', 'Kedelai Kamila')

@section('import')
<link href="{{ mix('css/produk.css') }}" rel="stylesheet" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
@endsection

<body>
@section('content')
    <div>
        {{-- Formulir modal tambah produk --}}
        <div class="modal fade" id="tambahShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-custom text-white">
                    <div class="modal-header border-0 text-center">
                        <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Tambah Produk</b></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="modal-body text-black" action="/produk" method="post">
                        @csrf
                        <div>
                            <label style="color: white; font-weight: 600;">Upload Gambar</label>
                            <input  name='gambar' class="form-control" type="file" placeholder="Gambar Produk" required>
                            <input type="text" name="nama_produk" id="nama" class="mt-4 form-control" placeholder="Masukkan Nama Produk">
                            <input name="jumlah_produk" id="jumlah" type="number" class="form-control mt-4" placeholder="Masukkan Jumlah Produk">
                            <input name="harga_produk" id="harga" type="number" class="form-control mt-4" placeholder="Masukkan Harga Produk">
                            <input name="harga_asli" id="harga_asli" type="number" class="form-control mt-4" placeholder="Masukkan Harga Asli Produk">
                        </div>
                        <div class="border-0 d-flex mt-4">
                            <p class="me-auto"></p>
                            <button type="submit" class="btn btn-success shadow-none"><b>Tambah</b></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Navbar atas --}}
        <div class="d-flex">
            <h4 class="me-auto kedelai1"><b>Kedelai Kamila</b></h4>
            <div class="rectangle1 d-flex">
                <a href="" class="aVisit aPadd"><img class="home1" src="img/home.png"></a>
                <a href="/profil" class="aPadd"><img class="home1" src="img/user.png"></a>
                <div class="dropdown">
                    <a href="#" class="aPadd" id="imageDropdown" data-bs-toggle="dropdown">
                        <img class="drop1" src="img/drop.png">
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="imageDropdown">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/daftarpembeli">Daftar Akun Pembeli</a></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Tambah Produk --}}
        <h2 class="mt-5" style="text-align: center; color: white;">Katalog Produk</h2>
        @if (Auth::guard('admin')->check())
            <button type="button" class="btn btn-primary shadow-none" style="margin-left: 65px;" data-bs-toggle="modal" data-bs-target="#tambahShow"><i class="bi bi-plus"></i> Tambah Produk</button>
        @endif

        {{-- Daftar Produk & Tombol Edit Hapus --}}
        <div class="container-fluid">
            <div class="row justify-content-center">
                <?php $produk = DB::table('data_produks')->get(); ?>
                @foreach ($produk as $key => $data)
                    <div class='col-12 col-md-5 col-lg-4 col-xxl-3'>
                        <div class='card mb-4' style='width: 100%;'>
                            <img class='card-img-top' src="data:image/jpg;base64,{{ chunk_split(base64_encode($data->gambar)) }}">
                            <div class='card-body'>
                                <h5 class='card-title text-center'>{{ $data->nama_produk }}</h5>
                                <p class='card-text text-justify'> 
                                    Harga Rp {{ $data->harga_produk }} <br>
                                    Sisa Stok : {{ $data->jumlah_produk }}
                                </p>
                                @if (Auth::guard('admin')->check())
                                    <a href="/editproduk/{{ $data->No_id }}"><button type="button" class="btn btn-success btn-sm shadow-none"><i class="bi bi-pencil-square"></i></button></a>
                                    <a href="/produk/{{ $data->No_id }}"><button type="button" class="btn btn-danger btn-sm shadow-none"><i class="bi bi-trash3-fill"></i></button></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
</body>