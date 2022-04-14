@extends('app')
@section('title', 'Kedelai Kamila')

@section('import')
<link href="{{ mix('css/app.css') }}" rel="stylesheet" >
<link href="{{ mix('css/landing.css') }}" rel="stylesheet" >
<script defer src="{{ mix('js/landing.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection

<body style="overflow: hidden"> 
@section('landing')
    {{-- <div>
        <?php
        // if(isset($_POST['create'])){
        //     $
        // }
        ?>
    </div> --}}
    <div>
        <div class="modal fade" id="LoginShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-custom text-white">
                    <div class="modal-header border-0 text-center">
                        <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Masuk</b></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="modal-body needs-validation" novalidate>
                        <div class="has-validation">
                            <input type="text" class="form-control" placeholder="Masukkan Email" required>
                            <input type="password" class="form-control mt-4" placeholder="Password" required>
                        </div>
                        <div class="mt-3">
                            <a href="#">Lupa Password?</a> <br>
                        </div>
                    <div class="border-0 d-flex">
                        <a href="" class="mt-3 me-auto" data-bs-toggle="modal" data-bs-target="#RegisterShow">Belum Punya Akun? Daftar Akun</a>
                        <button type="submit" class="btn btn-success shadow-none"><b>Masuk</b></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="RegisterShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-custom text-white">
                    <div class="modal-header border-0 text-center">
                        <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Daftar</b></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="modal-body needs-validation" novalidate>
                        <div class="has-validation">
                            <input type="text" class="form-control" placeholder="Masukkan Email" required>
                            <input type="password" class="form-control mt-4" placeholder="Password" required>
                            <input type="text" class="form-control mt-4" placeholder="Masukkan nama" required>
                            <input type="text" class="form-control mt-4" placeholder="Masukkan alamat" required>
                            <select class="form-select mt-4">
                                <option value="1">Laki-Laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </div>
                    <div class="border-0 d-flex mt-4">
                        <a href="" class="me-auto" data-bs-toggle="modal" data-bs-target="#LoginShow">Sudah Punya Akun? Masuk Akun</a>
                        <button type="submit" class="btn btn-success shadow-none"><b>Daftar</b></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

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
            <a href="#"><img class="home1" src="img/home.png"></a>
            <a href="#"><img class="user1" src="img/user.png"></a>
        </div>

        <div class="title1">
            <h1><b>Beli Produk Olahan <br>Kedelai Online?</b></h1>
        </div>

        <div class="title-text">
            <p>Kedelai Kamila mengolah kedelai menjadi produk berkualitas melalui tangan seorang ahli dengan harga yang bersahabat menuju tujuan anda.</p> 
        </div>

        <button type="button" class="btn btn-success btn-landing shadow-none" data-bs-toggle="modal" data-bs-target="#LoginShow"><b>Masuk / Daftar</b></button>  
    </div>
@endsection
</body>