@extends('dashboardLayout')

@section('title')
    Cek Resi
@endsection

@section('top-nav')
<div class="d-flex justify-content-evenly">
    <div class="button-navigation">
        <a href="{{ route('resi') }}">
            <button>
                Cek Resi
            </button>
        </a>
    </div>
    <div class="button-navigation">
        <a href="{{ route('ongkir') }}">
            <button>
                Cek Ongkir
            </button>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="">
    <div class="d-flex justify-content-around mt-4" >
        <div class="container w-100" style="background-color: #F4F4F4; padding: 0px 30px 30px 30px; border-radius: 10px">
            <form action="{{ route('cekResi') }}" method="POST">
                @csrf
                <h2 class="fw-bolder mt-3">Cek Resi</h2>
                <div class="mt-3">
                    <label for="awb"><b>Nomor Resi</b></label>
                    <input type="text" name="awb" id="awb" class="form-control" style="background-color: #E6E6E6; height: 40px; margin-top: 10px" required>
                </div>
                <div class="mt-3">
                    <label for="courier"><b>Jenis Ekspedisi</b></label>
                    <select name="courier" id="courier" class="form-control" style="background-color: #E6E6E6; height: 40px; margin-top: 10px" required>
                        <option value="">Pilih Ekspedisi</option>
                        @foreach ($ekspedisi as $item)
                            <option value="{{ $item['code'] }}">{{ $item['description'] }}</option>
                         @endforeach
                        
                    </select>
                    {{-- {{ $courier['code'] }} --}}
                </div>
                <div class="mt-3">
                    <input type="submit" name="cekResi" class="btn-submit">
                </div>
            </form>
        </div>

        @isset($summary)
        @if ($response_status == 200)
            <div style="margin-left: 30px; background-color: #F4F4F4; padding: 0px 30px 30px 30px; border-radius: 10px" class="w-100">
                <h2 class="fw-bolder mt-3">Hasil</h2>
                    <div class="mt-3">
                        <p class="mb-0">Nomor Resi</p>
                        <h3>{{ $summary['awb'] }}</h3>
                    </div>
                    <div class="mt-3">
                        <p class="mb-0">Tanggal Pengiriman</p>
                        <h3>{{ $summary['date'] }}</h3>
                    </div>
                    <div class="mt-3">
                        <p class="mb-0">Pengirim</p>
                        <h3>{{ $detail['shipper'] }}</h3>
                    </div>
                    <div class="mt-3">
                        <p class="mb-0">Penerima</p>
                        <h3>{{ $detail['receiver'] }}</h3>
                    </div>
                </div>
            </div>
        
            <div class="mt-4 w-100" style="background-color: #F4F4F4; padding: 0px 30px 30px 10px; border-radius: 10px">
                <ul class="list-group list-group-light">
                    <h2 class="fw-bolder mt-3 ml-10">Status Pengiriman</h2>
                    @foreach ($history as $riwayat)
                        <li class="list-group-item border-0">
                            <h3>{{ $riwayat['date'] }}</h3>
                            <p>{{ $riwayat['desc'] }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @endisset
        <div style="margin-left: 30px; background-color: #F4F4F4; border-radius: 10px" class="w-100 d-flex justify-content-center align-items-center">
            @if ($response_status == 400)
            <h3 class="text-center">Maaf nomor resi tidak dapat ditemukan</h3>
            @else
                @if ($response_status == 200)
                    
                @else
                    <h3 class="text-center">Masukkan nomor resi dan nama ekspedisi<br>untuk melihat data pengiriman barang</h3>
                @endif
            @endif
        </div>
        
    
</div>
@endsection