@extends('app')
@section('title', 'Kedelai Kamila')

@section('import')
<link href="{{ mix('css/profil.css') }}" rel="stylesheet" >
<link href="{{ mix('css/produk.css') }}" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<style>
    .foto {
        width: calc(5rem + 1vw);
        padding: 10px;
    }
    .nama_pem {
        margin-top: 25px;
        margin-left: 20px;
        font-weight: 600;
    }
</style>
@endsection

<body>
@section('content')
    <div>
        {{-- navbar atas --}}
        <div class="d-flex">
            <h4 class="me-auto kedelai1"><b>Kedelai Kamila</b></h4>
            <div class="rectangle1 d-flex">
                <a href="/produk" class="aPadd"><img class="home1" src="img/home.png"></a>
                <a href="/profil" class="aPadd"><img class="home1" src="img/user.png"></a>
                <div class="dropdown">
                    <a href="" class="aPadd" id="imageDropdown" data-bs-toggle="dropdown">
                        <img class="drop1" src="img/drop.png">
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="imageDropdown">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/chat/{{ Auth::id() }}">Chat Admin</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="">Daftar Pembelian</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <h2 class="mt-5" style="text-align: center; color: white;">Daftar Pembelian</h2>
        <div class="container-fluid">
            <h4 style="color: white;">Pembelian Saat ini</h4>
            <div class="row justify-content-center">
                <table class="table table-primary table-striped mt-4">
                    <?php 
                    $produk = DB::table('pembelians')->where([['id',Auth::id()],['barang_diterima',null]])->get();
                    $detail = DB::table('detail_pembelians')->where('id_pembelian',$produk->first()->id)->get();
                    ?>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Nama Produk</th>
                            <th>Harga per Unit</th>
                        </tr>
                    </thead>
                    @foreach ($detail as $key => $data)
                        <tbody id="data">
                            <tr>
                                <td>{{ $data->created_at }}</td>
                                <td>{{ $data->jumlah }}</td>
                                <td>{{ $data->nama_produk }}</td>
                                <td>{{ $data->harga }}</td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                <?php $total = DB::table('detail_pembelians')->where('id_pembelian',$produk->first()->id)->sum('total') ?>
                <h5 style="color: white;"> Total Pembayaran : {{ $total }}</h5>
                
            </div>
            <button type="submit" class="btn btn-danger shadow-none">Bayar</button>
            <h4 class="mt-4" style="color: white;">Pembelian Terdahulu</h4>
        </div>
    </div>
@endsection
</body>