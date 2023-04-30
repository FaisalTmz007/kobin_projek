@extends('dashboardLayout')

@section('top-nav')
    <div class="container d-flex">
        <a href="{{ route('profile') }}" style="color: black" class="mt-1 me-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
        </a>
        <h1>Ubah Profile</h1>
    </div>
@endsection

@section('content')
<div class="container d-flex flex-column justify-content-around align-items-center mt-5">
    <div class="card w-50">
        <div class="mt-4 card-body d-flex flex-column justify-content-around align-items-center">
            @if(Auth::guard('owner')->check())
            <img src="{{ asset(Auth::guard('owner')->user()->gambar) }}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover"></img>
            <form action="{{url('/user/ubah-profile-owner'.Auth::guard('owner')->user()->id_owner)}}" method="POST" class="w-100 mt-3">
                @csrf
                <div class="container w-100 m-auto">                            
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="telp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" name="telp" id="telp">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat">
                    </div>
                </div>
                <div class="mt-4 mb-2 d-flex justify-content-around align-items">
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </form>
            @elseif(Auth::guard('supplier')->check())
            <img src="{{ asset(Auth::guard('supplier')->user()->gambar) }}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover"></img>
            <form action="{{url('/user/ubah-profile-supplier'.Auth::guard('supplier')->user()->id_supplier)}}" method="POST" class="w-100 mt-3">
                @csrf
                <div class="container w-100 m-auto">                            
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="telp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" name="telp" id="telp">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat">
                    </div>
                </div>
                <div class="mt-2 mb-2 d-flex justify-content-around align-items">
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection