@extends('dashboardLayout')

@section('title')
    @if(Auth::guard('owner')->check())
        Profile | {{Auth::guard('owner')->user()->username}}
    @elseif(Auth::guard('supplier')->check())
        Profile | {{Auth::guard('supplier')->user()->username}}
    @endif
@endsection

@section('top-nav')
    <div class="container">
        <h1>Profile</h1>
    </div>
@endsection

@section('content')
<div class="container d-flex flex-column justify-content-around align-items-center mt-5">
    <div class="card w-50">
        <div class="mt-4 card-body d-flex flex-column justify-content-around align-items-center">
            @if(Auth::guard('owner')->check())
            <img src="{{ asset(Auth::guard('owner')->user()->gambar) }}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover"></img>
            <div class="w-100 mt-4">
                <label for="name" class="mb-3 fw-bold">Nama Pengguna</label>
                {{-- <p name="name">{{Auth::guard('owner')->user()->name}}</p> --}}
                <input class="form-control" type="text" value="{{Auth::guard('owner')->user()->name}}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="w-100 mt-2">
                <label for="name" class="mb-3 fw-bold">Username</label>
                {{-- <p name="name">{{Auth::guard('owner')->user()->username}}</p> --}}
                <input class="form-control" type="text" value="{{Auth::guard('owner')->user()->username}}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="w-100 mt-2">
                <label for="name" class="mb-3 fw-bold">Nomor Telepon</label>
                {{-- <p name="name">{{Auth::guard('owner')->user()->telp}}</p> --}}
                <input class="form-control" type="text" value="{{Auth::guard('owner')->user()->telp}}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="w-100 mt-2 mb-4">
                <label for="name" class="mb-3 fw-bold">Alamat</label>
                {{-- <p name="name">{{Auth::guard('owner')->user()->alamat}}</p> --}}
                <input class="form-control" type="text" value="{{Auth::guard('owner')->user()->alamat}}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="mt-2 mb-2">
                <a href="{{route('ubah-profile')}}">
                    <button type="button" class="btn btn-warning">Ubah</button>
                </a>
            </div>
            @elseif(Auth::guard('supplier')->check())
            <img src="{{ asset(Auth::guard('supplier')->user()->gambar) }}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover"></img>
            <div class="w-100 mt-4">
                <label for="name" class="mb-3 fw-bold">Nama Pengguna</label>
                {{-- <p name="name">{{Auth::guard('supplier')->user()->name}}</p> --}}
                <input class="form-control" type="text" value="{{Auth::guard('supplier')->user()->name}}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="w-100 mt-2">
                <label for="name" class="mb-3 fw-bold">Username</label>
                {{-- <p name="name">{{Auth::guard('supplier')->user()->username}}</p> --}}
                <input class="form-control" type="text" value="{{Auth::guard('supplier')->user()->username}}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="w-100 mt-2">
                <label for="name" class="mb-3 fw-bold">Nomor Telepon</label>
                {{-- <p name="name">{{Auth::guard('supplier')->user()->telp}}</p> --}}
                <input class="form-control" type="text" value="{{Auth::guard('supplier')->user()->telp}}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="w-100 mt-2 mb-4">
                <label for="name" class="mb-3 fw-bold">Alamat</label>
                {{-- <p name="name">{{Auth::guard('supplier')->user()->alamat}}</p> --}}
                <input class="form-control" type="text" value="{{Auth::guard('supplier')->user()->alamat}}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="mt-2 mb-2">
                <a href="{{route('ubah-profile')}}">
                    <button type="button" class="btn btn-warning">Ubah</button>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection