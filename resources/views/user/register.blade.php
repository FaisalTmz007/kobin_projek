@extends('authLayout')

@section('title')
    Register  
@endsection

@section('auth-image')
{{-- <img class="login-card-img" src="{{asset("./assets/img/Register.png")}}" alt="">     --}}
<img src="{{asset("./assets/img/Register.png")}}" alt="login" class="login-card-img" style="max-width: 90%">
@endsection

@section('auth-form')
<div class="col-lg-7 pt-4">
    <h3 class="fw-bold py-3" style="text-align: center">Buat Akun</h3>
    <form method="POST" action="{{ route('register.action') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row w-100">
            <div class="col-lg-7 w-100">
                <input class="form-control my-3 p-2" placeholder="Nama" name="name" type="text" value="{{ old('name') }}">
            </div>
        </div>
        <div class="form-row w-100">
            <div class="col-lg-7 w-100">
                <input class="form-control my-3 p-2" placeholder="Username" name="username" type="text" value="{{ old('username') }}">
            </div>
        </div>
        <div class="form-row w-100">
            <div class="col-lg-7 w-100">
                <input class="form-control my-3 p-2" placeholder="Nomor Telepon" name="telp" type="text" value="{{ old('telp') }}">
            </div>
        </div>
        <div class="form-row w-100">
            <div class="col-lg-7 w-100">
                <input class="form-control my-3 p-2" placeholder="Alamat" name="alamat" type="text" value="{{ old('alamat') }}">
            </div>
        </div>
        <div class="form-row w-100">
            <div class="col-lg-7 w-100">
                <select class="form-select" placeholder="Pilih Role" id="role" name="role" aria-label="Default select example">
                    <option selected>Pilih Role</option>
                <option value="2">Pemilik Kebun</option>
                <option value="3">Supplier</option>
              </select>
            </div>
        </div>
        <div class="form-row w-100">
            <div class="col-lg-7 w-100">
                {{-- <input class="form-control my-3 p-2" placeholder="******" name="password" type="password"> --}}
                <input class="form-control my-3 p-2" placeholder="Password" name="password" type="password">
            </div>
        </div>
        <div class="form-row w-100">
            <div class="col-lg-7 w-100">
                {{-- <input class="form-control my-3 p-2" placeholder="******" name="password" type="password"> --}}
                <input class="form-control my-3 p-2" value="{{ old('gambar') }}" name="gambar" id="gambar" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
            </div>
            <div class="col-lg-7">
                <img class="mb-3" src="" id="output" width="150">
            </div>
        </div>
        <div class="form-row w-100">
            <div class="col-lg-7 w-100">
                <button class="btn-auth">Register</button>
            </div>
        </div>
        <div class="form-row w-100">
            <div class="col-lg-7 w-100">
                <p style="text-align: center">Sudah punya akun? <a style="text-decoration: none; color: #DA7B29" href="{{ route('login') }}"><b>Login</b></a></p>
            </div>
        </div>
    </form>
</div>
@endsection