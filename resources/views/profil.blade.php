@extends('app')
@section('title', 'Kedelai Kamila')

@section('import')
<link href="{{ mix('css/profil.css') }}" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
        
        <a href ="#"><img src="https://picsum.photos/200" class="rounded-circle fotoProfil"></a>
        <div class="profil1">
            <h4>Nama Pembeli</h4>
            <h6>Nomor Telepon : 00000</h6>
            <h6>Email : loremipsum</h6>
            <h6>Password : ******</h6>
            <h6>Alamat : loremipsum</h6>
            <h6>Jenis Kelamin : Lorem</h6>
        </div>
    </div>
@endsection
</body>