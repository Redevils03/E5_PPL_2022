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
        <div class="modal fade" id="dataShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-custom text-white">
                    <?php $produk = DB::table('akun_pembelis')->where('id', $id)->get(); ?>
                    @foreach ($produk as $key => $data)
                        <div class="modal-header border-0 text-center">
                            <h5 class="modal-title w-100" id="staticBackdropLabel"><b>{{ $data->nama }}</b></h5>
                            <a href="/daftarpembeli"><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></a>
                        </div>
                        <div class="modal-body text-white">
                            @csrf
                            <h4>
                                Nomor Telepon &emsp;: {{$data->nomor_telp}} <br><br>
                                Email &emsp;&emsp;&emsp;&emsp;&emsp;&ensp;: {{$data->email}} <br><br>
                                Alamat &emsp;&emsp;&emsp;&emsp;&ensp;: {{$data->alamat}} <br><br>
                                Jenis Kelamin &emsp;&ensp;: {{$data->jenis_kelamin}} <br><br>
                            </h4>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        navbar atas
        <div class="d-flex">
            <h4 class="me-auto kedelai1"><b>Kedelai Kamila</b></h4>
            <div class="rectangle1 d-flex">
                <a href="" class="aPadd"><img class="home1" src="img/home.png"></a>
                <a href="" class="aPadd"><img class="home1" src="img/user.png"></a>
                <div class="dropdown">
                    <a href="" class="aPadd" id="imageDropdown" data-bs-toggle="dropdown">
                        <img class="drop1" src="img/drop.png">
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="imageDropdown">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="">Daftar Akun Pembeli</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <h2 class="mt-5" style="text-align: center; color: white;">Daftar Akun Pembeli</h2>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <table class="table table-primary table-striped mt-4">
                    <?php $produk = DB::table('akun_pembelis')->get(); ?>
                    @foreach ($produk as $key => $data)
                        <tbody id="data">
                            <tr>
                                <td class="col-2">
                                    @php
                                    if (empty($data->gambar)) {
                                        echo "
                                        <img src='img/foto_null.png' class='rounded-circle foto'>
                                        ";
                                    } else {
                                        $foto = 'data:image/jpeg;base64,' . base64_encode($data->gambar);
                                        echo "
                                        <img src={$foto} class='rounded-circle'>
                                        ";
                                    }
                                    @endphp
                                </td>
                                <td class="col-8"><h3 class="nama_pem">{{ $data->nama }}</h3></td>
                                <td class="col-1">
                                    <button href="" type="submit" name='chat' class="btn btn-success shadow-none nama_pem foto"><i class="bi bi-chat-left-dots-fill"></i></button>  
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.onload = () => {
            $('#dataShow').modal('show');
        }
    </script>
@endsection
</body>