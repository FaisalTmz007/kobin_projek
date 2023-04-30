@extends('dashboardLayout')

@section('title')
    Home
@endsection

@section('top-nav')
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