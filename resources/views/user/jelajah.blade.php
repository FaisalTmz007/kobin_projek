@extends('dashboardLayout')

@section('title')
    Jelajah User
@endsection

@section('top-nav')
<div class="d-flex justify-content-between">
    <div>
        <h2 class="fw-bolder mt-3">Jelajahi Pengguna Lain</h2>
    </div>
    <div>
        <form action="{{ route('jelajah') }}" method="GET">
            @csrf
            <div class="input-group">
                <input type="search" name="search" class="form-control rounded" placeholder="Cari Pengguna" aria-label="Search" aria-describedby="search-addon" />
                <button type="button" class="btn btn-outline-warning">Cari</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('content')
{{-- {{$own}} --}}
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Lengkap</th>
        <th scope="col">Username</th>
        <th scope="col">Alamat</th>
        <th scope="col">Role</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
        @if ($user->count()>0)
            @php
                $i=1;
            @endphp
            @foreach ($own as $item)
            @if ($item->username == 'NULL')
                @continue
            @endif
            <tr>
            <th scope="row">{{$i}}</th>
            <td>{{$item->name}}</td>
            <td>{{$item->username}}</td>
            <td>{{$item->alamat}}</td>
            <td>{{$item->getRole['nama_role']}}</td>
            <td>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ownerModal-{{$item->id_owner}}">Lihat</button>
            </td>
            </tr>
            @php
                $i++;
            @endphp
            @endforeach
            @foreach ($supp as $dt)
            @if ($dt->username == 'NULL')
                @continue
            @endif
            <tr>
            <th scope="row">{{$i}}</th>
            <td>{{$dt->name}}</td>
            <td>{{$dt->username}}</td>
            <td>{{$dt->alamat}}</td>
            <td>{{$dt->ambilRole['nama_role']}}</td>
            <td>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#supplierModal-{{$dt->id_supplier}}">Lihat</button>
            </td>
            </tr>
            @php
                $i++;
            @endphp
            @endforeach
        @else
            <tr>
                <td></td>
                <td></td>
                <td>Username tidak tersedia.</td>
                <td></td>
                <td></td>
                <td></td>
            </tr> 
        @endif
        
        
        @foreach ($own as $item)
        <!-- Modal -->
        <div class="modal fade" id="ownerModal-{{$item->id_owner}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detail Pengguna</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="container w-100 m-auto">
                      <div class="image d-flex justify-content-center">
                          <img src="{{asset($item->gambar)}}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover" alt="Avatar" />
                      </div>
                      <div class="mt-4">
                          <label for="name"><b>Nama Lengkap</b></label>
                          <p class="mt-2" name="name" id="name" >{{$item->name}}</p>
                          <label for="username"><b>Username</b></label>
                          <p class="mt-2" name="username" id="username" >{{$item->username}}</p>
                          <label for="alamat"><b>Alamat</b></label>
                          <p class="mt-2" name="alamat" id="alamat">{{$item->alamat}}</p>
                          <label for="telp"><b>Nomor Telepon</b></label>
                          <p class="mt-2" name="telp" id="telp">{{$item->telp}}</p>
                          <label for="role"><b>Role</b></label>
                          <p class="mt-2" name="role" id="role">{{$item->getRole['nama_role']}}</p>
                      </div>
                  </div>
              </div>
          </div>
          </div>
        </div>
        @endforeach
        
        
        @foreach ($supp as $dt)
        <!-- Modal -->
        <div class="modal fade" id="supplierModal-{{$dt->id_supplier}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container w-100 m-auto">
                            <div class="image d-flex justify-content-center">
                                <img src="{{asset($dt->gambar)}}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover" alt="Avatar" />
                            </div>
                            <div class="mt-4">
                                <label for="supplierName"><b>Nama Lengkap</b></label>
                                <p class="mt-2" name="supplierName" id="supplierName" >{{$dt->name}}</p>
                                <label for="supplierUsername"><b>Username</b></label>
                                <p class="mt-2" name="supplierUsername" id="supplierUsername" >{{$dt->username}}</p>
                                <label for="supplierAlamat"><b>Alamat</b></label>
                                <p class="mt-2" name="supplierAlamat" id="supplierAlamat">{{$dt->alamat}}</p>
                                <label for="supplierTelp"><b>Nomor Telepon</b></label>
                                <p class="mt-2" name="supplierTelp" id="supplierTelp">{{$dt->telp}}</p>
                                <label for="supplierRole"><b>Role</b></label>
                                <p class="mt-2" name="supplierRole" id="supplierRole">{{$dt->ambilRole['nama_role']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
    </tbody>
  </table>
  

@endsection
