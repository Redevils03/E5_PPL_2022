@extends('app')
@section('title', 'Kedelai Kamila')

@section('import')
<link href="{{ mix('css/landing.css') }}" rel="stylesheet" >
<script defer src="{{ mix('js/landing.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection

<body style="overflow: hidden"> 
@section('content')
    <div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}

        <div class="modal fade" id="LoginShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-custom text-white">
                    <div class="modal-header border-0 text-center">
                        <h5 class="modal-title w-100" id="staticBackdropLabel"><b>Masuk</b></h5>
                        <a href="/"><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></a>
                    </div>
                    <form class="modal-body" action="/login" method="post">
                        @csrf
                        <div>
                            <input name="email" id="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email" required value="{{ old ('email') }}">
                            @error('email')
                                <div class="invalid-feeback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <input name="password" id="password" type="password" class="form-control mt-4" placeholder="Password" required>
                        </div>
                        {{-- <div class="mt-3">
                            <a href="#">Lupa Password?</a> <br>
                        </div> --}}
                        <br>
                    <div class="border-0 d-flex">
                        <a href="/register" class="mt-3 me-auto">Belum Punya Akun? Daftar Akun</a>
                        <button type="submit" class="btn btn-success shadow-none"><b>Masuk</b></button>
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
    <script type="text/javascript">
        window.onload = () => {
            $('#LoginShow').modal('show');
        }
    </script>
    @if (count($errors) > 0)
        <script type="text/javascript">
            $( document ).ready(function() {
                $('#LoginShow').modal('show');
            });
        </script>
    @endif
@endsection
</body>