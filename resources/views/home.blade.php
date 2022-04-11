<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="css/style.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet"> 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Kedelai Kamila, Penyedia Olahan Kedelai Online</title>
    <style>
        body {
            background-color: rgba(6, 27, 35, 1);
            font-family: 'Quicksand';
        }

        .kedelai{
            color: rgba(54, 211, 154, 1);
            margin-left: 100px; 
            margin-top: 30px;
        }

        .rectangle1 {
            position: absolute;
            top: 0;
            right: 0;
            border-radius: 0px 0px 0px 25px;
            background-color: rgba(54, 211, 154, 1);
            height: 70px;
            width: 210px;
        }

        .home1 {
            height: 35px;
            margin-left: 50px;
            margin-top: 15px;
            padding: 0;
        }

        .user1 {
            height: 35px;
            margin-left: 50px;
            margin-top: 15px;
            padding: 0;
        }

        .title {
            color: white;
            margin-left: 100px;
            margin-top: 200px;
            font-size: 40px;
            font-weight: bolder;
            line-height: 250%;
            width: 755px;
        }

        .title-text {
            color: white;
            font-size: 25px;
            margin-left: 100px;
            font-weight: 100;
            width: 600px;
        }

        /* .btn {
            margin-left: 100px;
            font-weight: bolder;
            background-color: rgba(54, 211, 154, 1);
            height: 70px;
            width: 210px;
        } */
    </style>
</head>
<body>
    <h4 class="kedelai">Kedelai Kamila</h4>
    <div class="rectangle1">
        <a href="#"><img class="home1" src="img/home.png"></a>
        <a href="#"><img class="user1" src="img/user.png"></a>
    </div>
    <div class="title">
        <h1>Beli Produk Olahan <br>Kedelai Online?</h1>
    </div>
    <div class="title-text">
        <p>Kedelai Kamila mengolah kedelai menjadi produk berkualitas melalui tangan seorang ahli dengan harga yang bersahabat menuju tujuan anda.</p> 
    </div>
    <button type="button" class="btn btn-success"> Masuk / Daftar </button>  

    <script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>
</body>
</html>