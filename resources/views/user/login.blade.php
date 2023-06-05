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
    <h2 class="fw-bold py-3">Selamat Datang!</h2>
    <h5 class="pb-3">Anda berada di halaman login User</h5>
    <div class="d-flex">
        <a href="{{route('login_admin')}}" class="admin-selection"><button>Admin</button></a>
        <a href="{{route('login')}}" class="user-selection"><button>User</button></a>
    </div>
    <form method="POST" action="{{ route('login.action') }}">
        @csrf
        <div class="form-row w-100">
            <div class="col-lg-7 w-100">
                <input class="form-control my-3 p-2" placeholder="Username" name="username" type="text" value="{{ old('username') }}">
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
                <button class="btn-auth">Login</button>
            </div>
        </div>
        <div class="form-row w-100">
            <div class="col-lg-7 w-100">
                <p style="text-align: center">Belum punya akun? <a style="text-decoration: none; color: #DA7B29" href="{{ route('register_user') }}"><b>Register</b></a></p>
            </div>
            <div>
                {{-- <p style="text-align: center"><a style="text-decoration: none; color: #DA7B29"  href="{{ route('resetPassword') }}">Lupa Password</a></p> --}}
            </div>
        </div>
    </form>
</div>
@endsection