@extends('dashboardLayout')

@section('title')
    Cek Ongkir
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
<div>
    <div class="d-flex justify-content-around mt-4 row" >
        <div class="container w-100 col" style="background-color: #F4F4F4; padding: 0px 30px 30px 30px; border-radius: 10px">
        <form action="{{ route('cekOngkir') }}" method="POST" >
            @csrf
            <h2 class="fw-bolder mt-3">Hasil</h2>
            <div class="mt-4">
                <label for="origin"><b>Kota Asal</b></label>
                <select name="origin" id="origin" class="form-control" required style="background-color: #E6E6E6; height: 40px; margin-top: 10px">
                    <option value="">Pilih Kota Asal</option>
                    @foreach ($cities as $city)
                    <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <label for="destination"><b>Kota Tujuan</b></label>
                <select name="destination" id="destination" class="form-control" style="background-color: #E6E6E6; height: 40px; margin-top: 10px" required>
                    <option value="">Pilih Kota Tujuan</option>
                    @foreach ($cities as $city)
                    <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <label for="weight"><b>Berat Paket (gr)</b></label>
                <input type="number" name="weight" id="weight" class="form-control" style="background-color: #E6E6E6; height: 40px; margin-top: 10px" required>
            </div>
            <div class="mt-3">
                <label for="courier"><b>Kurir</b></label>
                <select name="courier" id="courier" class="form-control" style="background-color: #E6E6E6; height: 40px; margin-top: 10px" required>
                    <option value="">Pilih Kurir</option>
                    <option value="jne">JNE</option>
                    <option value="pos">POS</option>
                    <option value="tiki">TIKI</option>
                </select>
            </div>
            <div class="mt-3">
                <input type="submit" name="cekOngkir" class="btn-submit">
            </div>
        </form>
        </div>
    
        <div style="margin-left: 30px; background-color: #F4F4F4; border-radius: 10px" class="w-100 col">
            @if ($ongkir != '')
            <div class="w-100 container">
                <h2 class="fw-bolder mt-3">Cek Harga Ongkir</h2>

                <div>
                    <p class="fw-bolder mt-4">Kota Asal</p>
                    <p>{{ $ongkir['origin_details']['city_name'] }}</p>
                    <p class="fw-bolder">Kota Tujuan</p>
                    <p>{{ $ongkir['destination_details']['city_name'] }}</p>
                    <p class="fw-bolder">Berat Barang</p>
                    <p>{{ $ongkir['query']['weight'] }} gram</p>
        
                    @foreach ($ongkir['results'] as $item)
                        <div>
                            <p class="fw-bolder">Ekspedisi</p>
                            <p for="name" class="">{{ $item['name'] }}</p>
                            <p class="fw-bolder">Layanan</p>
                            @foreach ($item['costs'] as $costs)
                                <div class="mb-2">
                                    <label for="service">Nama Layanan : {{ $costs['service'] }}</label>
        
                                    @foreach ($costs['cost'] as $cost)
                                        <div class="mb-2">
                                            <label for="cost">Harga : {{ $cost['value'] }}</label>
                                            <br>
                                            <label for="etd">Estimasi : {{ $cost['etd'] }} hari</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
                <div class="">
                    <h2>Silahkan Masukkan data untuk</h2>
                </div>
                <div class="">
                    <h2 class="">melihat harga ongkir</h2>
                </div>
            </div>
    
            @endif
        </div>
    </div>

    

</div>
@endsection