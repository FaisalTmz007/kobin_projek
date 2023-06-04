@extends('dashboardLayout')

@section('title')
    Ubah Data Kas
@endsection

@section('top-nav')
@if(session('loginowner'))
<p class="alert alert-success">{{ session('loginowner') }}</p>
@elseif(session('loginsupplier'))
<p class="alert alert-success">{{ session('loginsupplier') }}</p>
@endif
<h2 class="page-title">
{{-- Selamat Datang, {{ Auth::guard('supplier')->user()->name }} --}}
@if(Auth::guard('owner')->check())
    Selamat Datang, {{Auth::guard('owner')->user()->name}}
@elseif(Auth::guard('supplier')->check())
    Selamat Datang, {{Auth::guard('supplier')->user()->name}}
@endif
</h2>
<div class="page-pretitle">
    <p><span id='date-time'></span>.</p>
</div>
@endsection

@section('content')
<div class="container d-flex flex-column justify-content-around align-items-center mt-5">
    <div class="card w-50">
        <div class="mt-4 w-100 d-flex justify-content-center">
            Ubah Data
        </div>
        <form action="{{ url('user/kas/'.$data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mt-2 card-body d-flex flex-column justify-content-around align-items-center">
            <div class="w-100 mt-4">
                <label for="tanggal" class="mb-3 fw-bold">Tanggal</label>
                <input class="form-control" name="tanggal" type="date" value="{{$data->tanggal}}" aria-label="Disabled input example">
            </div>
            
                <div class="w-100 mt-2">
                    <label for="jumlah_masuk" class="mb-3 fw-bold">Jumlah Pemasukan</label>
                    <input class="form-control" name="jumlah_masuk" type="number" value="{{$data->jumlah_masuk}}" aria-label="Disabled input example">
                </div>
                <div class="w-100 mt-2">
                    <label for="jumlah_keluar" class="mb-3 fw-bold">Jumlah Pengeluaran</label>
                    <input class="form-control" name="jumlah_keluar" type="number" value="{{$data->jumlah_keluar}}" aria-label="Disabled input example">
                </div>
                <div class="w-100 mt-2 mb-4">
                    <label for="keterangan" class="mb-3 fw-bold">Keterangan</label>
                    <input class="form-control" name="keterangan" type="text" value="{{$data->keterangan}}" aria-label="Disabled input example">
                </div>
            </div>
            <div class=" mb-4 mx-4 d-flex justify-content-between align-items">
                <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                <button type="submit" class="btn btn-warning">Simpan</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection