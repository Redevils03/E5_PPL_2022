@extends('app')
@section('title', 'Kedelai Kamila')

@section('import')
<link href="{{ mix('css/landing.css') }}" rel="stylesheet" >
<script defer src="{{ mix('js/landing.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<style>
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
    .alert{
        z-index: 2000;
    }
</style>
@endsection

<body style="overflow: hidden"> 
@section('content')
    <div>
        {{-- modal formulir --}}
        <div class="modal fade" id="RegisterShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-custom text-white">
                    <div class="modal-header border-0 text-center">
                        <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Daftar</b></h5>
                        <a href="/"><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></a>
                    </div>
                    <form class="modal-body text-black" action="/register" method="post">
                        @csrf
                        <div>
                            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email" value="{{ old ('email1') }}">
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
                            <input name="nama" id="nama" type="text" class="form-control mt-4 @error('nama') is-invalid @enderror" placeholder="Masukkan nama" value="{{ old ('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    Mohon isikan nama dengan maksimal 30 karakter.
                                </div>
                            @enderror
                            <input name="nomor_telp" id="nomor_telp" type="number" class="form-control mt-4 @error('nomor_telp') is-invalid @enderror" placeholder="Masukkan nomor telepon" value="{{ old ('nomor_telp') }}">
                            @error('nomor_telp')
                                <div class="invalid-feedback">
                                    Mohon isikan nomor telepon yang valid.
                                </div>
                            @enderror
                            <input name="alamat" id="alamat" type="text" class="form-control mt-4 @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat" value="{{ old ('alamat') }}">
                            @error('nomor_telp')
                                <div class="invalid-feedback">
                                    Mohon isikan alamat tempat tinggal saat ini.
                                </div>
                            @enderror
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select mt-4 @error('jenis_kelamin') is-invalid @enderror" invalid>
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
                        <a href="/login" class="me-auto text-white">Sudah Punya Akun? Masuk Akun</a>
                        <button type="submit" class="btn btn-success shadow-none"><b>Daftar</b></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- background landing page --}}
        <div>
            <img class="blend1 icon1" src="img/kedelai.png">
            <img class="blend1 icon2" src="img/kedelai.png">
            <img class="blend1 icon3" src="img/kedelai.png">
            <img class="blend1 icon4" src="img/kedelai.png">
            <img class="blend1 icon5" src="img/kedelai.png">
        </div>

        <div class="circle"></div>
        <h4 class="kedelai"><b>Kedelai Kamila</b></h4>
        <div class="rectangle1">
            <a><img class="home1" src="img/home.png"></a>
            <a><img class="user1" src="img/user.png"></a>
        </div>

        <div class="title1">
            <h1><b>Beli Produk Olahan <br>Kedelai Online?</b></h1>
        </div>

        <div class="title-text">
            <p>Kedelai Kamila mengolah kedelai menjadi produk berkualitas melalui tangan seorang ahli dengan harga yang bersahabat menuju tujuan anda.</p> 
        </div>

        <button class="btn btn-success btn-landing shadow-none"><b>Masuk / Daftar</b></button>  
    </div>

    {{-- Selalu tampilkan modal pada halaman --}}
    <script type="text/javascript">
        window.onload = () => {
            $('#RegisterShow').modal('show');
        }
    </script>

    {{-- Tetap tampilkan modal saat ada input error --}}
    @if (count($errors) > 0)
        <script type="text/javascript">
            $( document ).ready(function() {
                $('#RegisterShow').modal('show');
            });
        </script>
    @endif
@endsection
</body>