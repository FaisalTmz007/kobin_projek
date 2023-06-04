@extends('authLayout')

@section('title')
    Login  
@endsection

@section('auth-image')

<img src="{{asset("./assets/img/Login.png")}}" alt="login" class="login-card-img" style="max-width: 90%">
{{-- <img src="https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" alt="login" class="login-card-img"> --}}
@endsection

@section('auth-form')
<div class="col-lg-7">
    <h2 class="fw-bold py-3">Reset Password</h2>
    <h6 class="pb-3">Masukkan data yang sesuai untuk mengajukan reset password</h6>
    <form method="POST" action="{{ route('createReset') }}">
        @csrf
        <div class="form-row w-100">
            <div class="col-lg-7 w-100">
                <input class="form-control my-3 p-2" placeholder="Username" name="username" type="text" value="{{ old('username') }}" required>
            </div>
        </div>
        <div class="form-row w-100">
            <div class="col-lg-7 w-100">
                <input class="form-control my-3 p-2" placeholder="Permintaan Password" name="password" type="password" value="{{ old('password') }}" required>
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
                <button class="btn-auth my-3 p-2">Reset Password</button>
            </div>
        </div>
        <div class="form-row w-100">
            <div class="col-lg-7 w-100">
                <p style="text-align: center">Kembali ke halaman <a style="text-decoration: none; color: #DA7B29" href="{{ route('login') }}"><b>Login</b></a></p>
            </div>
        </div>
    </form>
</div>
@endsection