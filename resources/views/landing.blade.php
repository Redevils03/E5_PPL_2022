@extends('app')
@section('title', 'Kedelai Kamila')

@section('import')
<link href="{{ mix('css/app.css') }}" rel="stylesheet" >
<link href="{{ mix('css/landing.css') }}" rel="stylesheet" >
@endsection

<body style="overflow: hidden"> 
@section('landing')
    <div>
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

        <button type="button" class="btn btn-success"><b>Masuk / Daftar</b></button>  
    </div>
@endsection
</body>