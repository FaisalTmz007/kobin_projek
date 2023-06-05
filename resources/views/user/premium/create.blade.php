@extends('dashboardLayout')

@section('title')
    Paket Premium
@endsection
        
@section('content')
<div class="container h-100 d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
    {{-- qr --}}
    <div>
        <div class="card p-3 justify-content-center align-items-center" id="qr" style="display: flex; flex-direction: column; width: 450px; height: 500px;">
            <div class="card-body w-100 d-flex flex-column justify-content-center align-items-center">
                <div class="card-body bg-light rounded-3 d-flex flex-column justify-content-center align-items-center">
                    <img src="{{asset("./assets/img/qr.png")}}" alt="">
                    <p class="fs-3 fw-bold mt-2">Scan Me</p>
                </div>
                <button type="button" class="btn btn-warning mt-2" onclick="formBukti()">Kirim bukti</button>
            </div>
        </div>
    </div>

    {{-- form --}}
    <div>
        <div class="card p-3 justify-content-center align-items-center" id="form" style="display: none; flex-direction: column; width: 450px; height: 500px;">
            <h2>Kirim Bukti Pembayaran</h2>
            <div class="card-body w-100 d-flex flex-column align-items-center">
                <form action="{{ route('premium.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (Auth::guard('owner')->check())
                    <div class="mb-3 w-100">
                        <label for="name" class="form-label">Nama</label>
                        <input type="name" class="form-control" id="name" value="{{ Auth::guard('owner')->user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenisPaket" class="form-label">Jenis Paket</label>
                        <input type="text" name="jenisPaket" class="form-control" id="jenisPaket" value="{{ $id }}" required>
                    </div>
                    <div class="form-row w-100">
                        <div class="col-lg-7 w-100">
                            {{-- <input class="form-control my-3 p-2" placeholder="******" name="password" type="password"> --}}
                            <label for="bukti" class="form-label">Bukti Pembayaran</label>
                            <input class="form-control my-3 p-2" value="{{ old('bukti') }}" name="bukti" id="bukti" type="file" accept="image/*" required onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="col-lg-7">
                            <img class="mb-3" src="" id="output" width="150">
                        </div>
                    </div>
                    @elseif(Auth::guard('supplier')->check())
                    <div class="mb-3 w-100">
                        <label for="name" class="form-label">Nama</label>
                        <input type="name" class="form-control" id="name" value="{{ Auth::guard('supplier')->user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenisPaket" class="form-label">Jenis Paket</label>
                        <input type="text" name="jenisPaket" class="form-control" id="jenisPaket" value="{{ $id }}" required>
                    </div>
                    <div class="form-row w-100">
                        <div class="col-lg-7 w-100">
                            {{-- <input class="form-control my-3 p-2" placeholder="******" name="password" type="password"> --}}
                            <input class="form-control my-3 p-2" value="{{ old('bukti') }}" name="bukti" id="bukti" type="file" accept="image/*" required onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="col-lg-7">
                            <img class="mb-3" src="" id="output" width="150">
                        </div>
                    </div>
                    @endif
                    <div class="d-flex flex-row justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-default mt-2">Batal</a>
                        <button type="submit" class="btn btn-warning mt-2">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection