@extends('dashboardLayout')

@section('title')
    Pembayaran Berhasil
@endsection
        
@section('content')
<div class="container h-100 d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
    {{-- qr --}}
    <div>
        <div class="card p-3 d-flex flex-column justify-content-center align-items-center">
            <div class="card-body w-100 d-flex flex-column justify-content-center align-items-center">
                <div class="alert alert-success">
                    Pembayaran berhasil dilakukan, silahkan menunggu admin untuk konfirmasi pembayaran
                </div>
            </div>
        </div>
    </div>

</div>
@endsection