@extends('dashboardLayout')

@section('title')
    Ubah Profile
@endsection

@section('top-nav')
    @if ($errors->any())
        @foreach ($errors->all() as $err)
          <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
    @endif
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
            <form action="{{url('/user/ubah-profile-owner'.Auth::guard('owner')->user()->id_owner)}}" method="POST" enctype="multipart/form-data" class="w-100 mt-3">
                @csrf
                <div class="container w-100 m-auto">                            
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" value="{{Auth::guard('owner')->user()->name}}" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" value="{{Auth::guard('owner')->user()->username}}" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" value="{{Auth::guard('owner')->user()->alamat}}" class="form-control" name="alamat" id="alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="telp" class="form-label">Nomor Telepon</label>
                        <input type="text" value="{{Auth::guard('owner')->user()->telp}}" class="form-control" name="telp" id="telp" required>
                    </div>
                    <div class="mb-3">
                        <div class="col-lg-7 w-100">
                            {{-- <input class="form-control my-3 p-2" placeholder="******" name="password" type="password"> --}}
                            <label for="gambar" class="form-label">Foto Profile</label>
                            <input class="form-control my-3 p-2" value="{{ old('gambar') }}" name="gambar" id="gambar" type="file" accept="image/*" required onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        {{-- <div class="col-lg-7">
                            <img class="mb-3" src="{{asset(Auth::guard('owner')->user()->gambar)}}" id="output" width="150">
                        </div> --}}
                    </div>
                </div>
                <div class="mt-4 mb-2 d-flex justify-content-between align-items">
                    <a href="{{ url()->previous() }}" class="btn btn-default mt-2">Back</a>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </form>
            @elseif(Auth::guard('supplier')->check())
            <img src="{{ asset(Auth::guard('supplier')->user()->gambar) }}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover"></img>
            <form action="{{url('/user/ubah-profile-supplier'.Auth::guard('supplier')->user()->id_supplier)}}" method="POST" enctype="multipart/form-data" class="w-100 mt-3">
                @csrf
                <div class="container w-100 m-auto">                            
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" value="{{Auth::guard('supplier')->user()->name}}" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" value="{{Auth::guard('supplier')->user()->username}}" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" value="{{Auth::guard('supplier')->user()->alamat}}" class="form-control" name="alamat" id="alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="telp" class="form-label">Nomor Telepon</label>
                        <input type="text" value="{{Auth::guard('supplier')->user()->telp}}" class="form-control" name="telp" id="telp">
                    </div>
                    <div class="mb-3">
                        <div class="col-lg-7 w-100">
                            {{-- <input class="form-control my-3 p-2" placeholder="******" name="password" type="password"> --}}
                            <label for="gambar" class="form-label">Foto Profile</label>
                            <input class="form-control my-3 p-2" value="{{ old('gambar') }}" name="gambar" id="gambar" type="file" accept="image/*" required onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        {{-- <div class="col-lg-7">
                            <img class="mb-3" src="{{asset(Auth::guard('supplier')->user()->gambar)}}" id="output" width="150">
                        </div> --}}
                    </div>
                </div>
                <div class="mt-2 mb-2 d-flex justify-content-between align-items">
                    <a href="{{ url()->previous() }}" class="btn btn-default mt-2">Back</a>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection