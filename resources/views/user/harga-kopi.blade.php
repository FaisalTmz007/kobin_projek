@extends('dashboardLayout')

@section('title')
    Harga Kopi
@endsection

@section('top-nav')

<div class="container">
    <div class="d-flex justify-content-between">
        <div>
            <h2 class="fw-bolder mt-3">Harga Kopi Arabika Pasaran</h2>
        </div>
        {{-- <div>
            <form action="#" method="">
                @csrf
                <div class="input-group">
                    <input type="search" name="search" class="form-control rounded" placeholder="Cari Jenis Kopi" aria-label="Search" aria-describedby="search-addon" />
                    <button type="button" class="btn btn-outline-warning">Cari</button>
                </div>
            </form>
        </div> --}}
    </div>
</div>
@endsection
        
@section('content')
    <div class="container">
        <div class="top-content">
            <p>Update Bulan Ini</p>
            <p class="p-2 border border-3 rounded-3 bg-dark text-white" id='onlymonth'></p>
        </div>
        <div class="table-price">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Per Tanggal</th>
                    <th scope="col">Harga</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                    <tr>
                        <td>{{$dt['date']}}</td>
                        <td>{{$dt['value']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection