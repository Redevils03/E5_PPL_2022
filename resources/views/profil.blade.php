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
</style>
@endsection

<body>
@section('content')
    <div>
        <div class="d-flex">
            <h4 class="me-auto kedelai1"><b>Kedelai Kamila</b></h4>
            <div class="rectangle1 d-flex">
                <a href="" class="aPadd"><img class="home1" src="img/home.png"></a>
                <a href="#" class="aVisit aPadd"><img class="home1" src="img/user.png"></a>
                <div class="dropdown">
                    <a href="#" class="aPadd" id="imageDropdown" data-bs-toggle="dropdown">
                        <img class="drop1" src="img/drop.png">
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="imageDropdown">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 1</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 2</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 3</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 4</a></li>
                    </ul>
                </div>
            </div>
        </div>

        @if (Auth::guard('admin')->check())
            <h1>Admin masuk</h1>
        @elseif (Auth::guard('web')->check())
            @php
            if (empty(Auth::user()->foto)) {
                echo "
                <img src='img/foto_null.png' class='rounded-circle fotoProfil'>
                ";
            } else {
                $foto = 'data:image/jpeg;base64,' . base64_encode(Auth::user()->foto);
                echo "
                <img src={$foto} class='rounded-circle fotoProfil'>
                ";
            }
            @endphp
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
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn btn-danger"> Logout </button>
        </form>
    </div>
@endsection
</body>