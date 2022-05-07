@extends('app')
@section('title', 'Kedelai Kamila')

@section('import')
<link href="{{ mix('css/produk.css') }}" rel="stylesheet" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
@endsection

<body>
@section('content')
    <div style="background-color: rgba(6, 27, 35, 1);">
        <div class="fade modal" id="chatShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content bg-white text-black">
                    @if (Auth::guard('admin')->check())
                        <div class="modal-header">
                            <?php $produk = DB::table('akun_pembelis')->where('id',$id)->get(); ?>
                            @foreach ($produk as $key => $data)
                                <h5 class="modal-title" id="staticBackdropLabel"><b>{{ $data->nama }}</b></h5>
                            @endforeach
                            <a href="javascript:history.back()"><button type="button" class="btn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
                        </div>
                        <form class="modal-body text-black" action="/chat/{{ $id }}" method="post">
                            @csrf
                            <div>
                                <?php $produk = DB::table('chat_messages')->where('id_pembeli',$id)->get(); ?>
                                @foreach ($produk as $key => $data)
                                    @if ($data->role == 'pembeli')
                                        <div class="row">
                                            <div class="d-flex">
                                                <p style="background-color:darkslategray; word-break: break-all; color:white">{{ $data->message }}</p>
                                                <div style="width: 120px;"></div>
                                            </div>
                                            <p style="font-size: calc(0.1rem + 0.5vw);">{{ $data->created_at }}</p>
                                        </div>
                                    @elseif ($data->role == 'admin')
                                        <div class="row">
                                            <div class="d-flex">
                                                <div class="me-auto" style="width: 180px;"></div>
                                                <p style="margin-bottom: 10px; background-color: skyblue; text-align: right;">{{ $data->message }}</p>
                                            </div>
                                            <p style="font-size: calc(0.1rem + 0.5vw); text-align: right;">{{ $data->created_at }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="modal-footer mt-4 input-group">
                                <input type="text" name="message" id="message" class="form-control" placeholder="Masukkan Pesan" style="margin">
                                <button type="submit" class="btn btn-success shadow-none"><i class="bi bi-arrow-up"></i></button>
                            </div>
                        </form>
                    @elseif (Auth::guard('web')->check())
                        <div class="modal-header text-center">
                            <h5 class="modal-title" id="staticBackdropLabel"><b>Admin</b></h5>
                            <a href="javascript:history.back()"><button type="button" class="btn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
                        </div>
                        <form class="modal-body text-black" action="/chat/{{ $id }}" method="post">
                            @csrf
                            <div>
                                <?php $produk = DB::table('chat_messages')->where('id_pembeli',$id)->get(); ?>
                                @foreach ($produk as $key => $data)
                                    @if ($data->role == 'pembeli')
                                        <div class="row">
                                            <div class="d-flex">
                                                <div class="me-auto" style="width: 180px;"></div>
                                                <p style="background-color: skyblue; text-align: right; word-break: break-all;">{{ $data->message }}</p>
                                            </div>
                                            <p style="font-size: calc(0.1rem + 0.5vw); text-align:right;">{{ $data->created_at }}</p>
                                        </div>
                                    @elseif ($data->role == 'admin')
                                        <div class="row">
                                            <div class="d-flex">
                                                <p style="margin-bottom: 10px; background-color:darkslategray; color:white">{{ $data->message }}</p>
                                                <div style="width: 120px;"></div>
                                            </div>
                                            <p style="font-size: calc(0.1rem + 0.5vw);">{{ $data->created_at }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="modal-footer mt-4 input-group">
                                <input type="text" name="message" id="message" class="form-control" placeholder="Masukkan Pesan" style="margin">
                                <button type="submit" class="btn btn-success shadow-none"><i class="bi bi-arrow-up"></i></button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.onload = () => {
            $('#chatShow').modal('show');
        }
    </script>
@endsection
</body>