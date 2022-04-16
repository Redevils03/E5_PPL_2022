@extends('app')
@section('title', 'Kedelai Kamila')

@section('import')
<link href="{{ mix('css/produk.css') }}" rel="stylesheet" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection

<body>
@section('content')
    <div>
        <div class="d-flex">
            <h4 class="me-auto kedelai1"><b>Kedelai Kamila</b></h4>
            <div class="rectangle1 d-flex">
                <a href=""><img class="home1" src="img/home.png"></a>
                <a href="#"><img class="home1" src="img/user.png"></a>
                <div class="dropdown">
                    <a href="#" id="imageDropdown" data-bs-toggle="dropdown">
                        <img class="home1" src="img/drop.png">
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="imageDropdown">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" style="margin-left: 50px;">Menu item 1</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 2</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 3</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 4</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <h2 class="mt-5" style="text-align: center; color: white;">Katalog Produk</h2>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <?php
                $x = 1;
                while ($x <= 10) {
                    echo "
                    <div class='col-12 col-md-5 col-lg-4 col-xxl-3'>
                        <div class='card mb-4' style='width: 100%;'>
                            <img class='card-img-top' src='https://picsum.photos/200/300'>
                            <div class='card-body'>
                                <h5 class='card-title text-center'>Nama Produk</h5>
                                <p class='card-text text-justify'> Deskripsi </p>
                            </div>
                        </div>
                    </div>
                    ";
                    $x++;
                }
                ?>
            </div>
        </div>
    </div>
@endsection
</body>