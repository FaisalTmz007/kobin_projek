@extends('authLayout')

@section('auth-image')
    <img src="https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" alt="login" class="login-card-img">
@endsection

@section('auth-form')
<div class="col-lg-7">
    <h1 class="fw-bold py-3">Selamat Datang</h1>
    <h5 class="pb-3">Anda berada di halaman login Admin</h5>
    <form method="POST" action="{{ route('login_admin.action') }}">
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
    </form>
</div>
@endsection