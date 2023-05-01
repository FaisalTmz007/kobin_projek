@extends('dashboardLayout')

@section('title')
    Ganti Password
@endsection

@section('top-nav')
<div class="container d-flex">
    <a href="{{ route('profile') }}" style="color: black" class="mt-1 me-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
        </svg>
    </a>
    <h1>Ganti Password</h1>
</div>
@endsection

@section('content')

<div class="row d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @if(session('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('password.action') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Old Password <span class="text-danger"></span></label>
                        <input class="form-control" name="old_password" type="password" required>
                    </div>
                    <div class="mb-3">
                        <label>New Password <span class="text-danger"></span></label>
                        <input class="form-control" name="new_password" type="password" required>
                    </div>
                    <div class="mb-3">
                        <label>New Password Confirmation<span class="text-danger"></span></label>
                        <input class="form-control" name="new_password_confirmation" type="password" required>
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-warning">Ganti Password</button>
                    </div>
                </form>
            </div>
        </div>
        
        
    </div>
</div>
@endsection