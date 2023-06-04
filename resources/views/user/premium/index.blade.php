@extends('dashboardLayout')

@section('title')
    Paket Premium
@endsection
        
@section('content')
@if(session('success'))
<p class="alert alert-success">{{ session('success') }}</p>
@endif
<div class="container h-100 d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
    <div class="card w-50 p-3 justify-content-center align-items-center" id="paket" style="display: flex; flex-direction: column">
        <div class="card-title">
            <h2>
                <div>
                    Aktifkan Paket Premium
                </div>
                <div>
                    untuk Menikmati Fitur Ini
                </div>
            </h2>
        </div>
        <div class="card-body w-100 d-flex justify-content-around">
            @foreach ($premium as $pre)
            @if ($pre->id == 2)
            <div class="card w-50 p-2 mx-1">
                <div class="card-title">
                    <h3>{{ $pre->jenis_paket }}</h3>
                </div>
                <div class="card-body p-0">
                    <h4>Promo</h4>
                    <p>Rp {{ $pre->harga }}/tahun</p>
                    <a href="{{ url('user/premium/'.$pre->id) }}">
                        <button type="button" class="btn btn-warning">Beli</button>
                    </a>
                </div>
            </div>
            @else
            <div class="card w-50 p-2 mx-1">
                <div class="card-title">
                    <h3>{{ $pre->jenis_paket }}</h3>
                </div>
                <div class="card-body p-0">
                    <h4>Basic</h4>
                    <p>Rp {{ $pre->harga }}/bulan</p>
                    <a href="{{ url('user/premium/'.$pre->id) }}">
                        <button type="button" class="btn btn-warning">Beli</button>
                    </a>
                </div>
            </div>    
            @endif
            @endforeach
        </div>
    </div>

    {{-- qr --}}
    {{-- <div>
        <div class="card p-3 justify-content-center align-items-center" id="qr" style="display: none; flex-direction: column; width: 450px; height: 500px;">
            <div class="card-body w-100 d-flex flex-column justify-content-center align-items-center">
                <div class="card-body bg-light rounded-3 d-flex flex-column justify-content-center align-items-center">
                    <img src="{{asset("./assets/img/qr.png")}}" alt="">
                    <p class="fs-3 fw-bold mt-2">Scan Me</p>
                </div>
                <button type="button" class="btn btn-warning mt-2">Kirim bukti</button>
            </div>
        </div>
    </div> --}}

    {{-- form --}}
    {{-- <div>
        <div class="card p-3 justify-content-center align-items-center" id="form" style="display: none; flex-direction: column; width: 450px; height: 500px;">
            <h2>Kirim Bukti Pembayaran</h2>
            <div class="card-body w-100 d-flex flex-column align-items-center">
                <form action="">
                    @if (Auth::guard('owner')->check())
                    <div class="mb-3 w-100">
                        <label for="exampleInputPassword1" class="form-label">Nama</label>
                        <input type="name" class="form-control" id="exampleInputPassword1" value="{{ Auth::guard('owner')->user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Bukti Pembayaran</label>
                        <input class="form-control" type="file" id="formFile">
                      </div>
                    @elseif(Auth::guard('supplier')->check())
                    <div class="mb-3 w-100">
                        <label for="exampleInputPassword1" class="form-label">Nama</label>
                        <input type="name" class="form-control" id="exampleInputPassword1" value="{{ Auth::guard('supplier')->user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Bukti Pembayaran</label>
                        <input class="form-control" type="file" id="formFile">
                      </div>
                    @endif
                </form>
                <button type="button" class="btn btn-warning mt-2">Kirim</button>
            </div>
        </div>
    </div> --}}

</div>
@endsection