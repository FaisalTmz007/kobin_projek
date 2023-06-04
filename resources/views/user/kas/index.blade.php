@extends('dashboardLayout')

@section('title')
    Kas
@endsection

@section('top-nav')
@if(session('success'))
<p class="alert alert-success">{{ session('success') }}</p>
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
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Pemasukan</th>
            <th scope="col">Pengeluaran</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kas as $index => $item)
        <tr>
            <td scope="row">{{ $index + 1 }}</td>
            <td>{{ $item->tanggal }}</td>
            <td>{{ $item->jumlah_masuk }}</td>
            <td>{{ $item->jumlah_keluar }}</td>
            <td>{{ $item->keterangan }}</td>
            <td>
                <a href="{{ url('user/kas/'.$item->id.'/edit') }}">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ownerModal">Ubah</button>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="w-100 d-flex flex-row-reverse">
    <a class="nav-link" href="{{ route('kas.create') }}" style="color: white">
        <button type="button" class="btn btn-primary">
            <span style="color: white" class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 5l0 14"></path>
                    <path d="M5 12l14 0"></path>
                 </svg>
              </span>
              <span class="nav-link-title">
                Tambah
              </span>
        </button>
    </a>
    {{-- {{$userId}} --}}
</div>

@endsection