<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("./css/admindashboard.css")}}">

    <title>Admin | Supplier Management</title>

    <style>
        .user-selection button {
            border: none;
            background-color: transparent;
            font-size: 16px;
            font-weight: 600;
            display: inline-block;
            position: relative;
        }
        .user-selection button::after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 4px;
            bottom: 0;
            left: 0;
            background-color: #DA7B29;
            transform-origin: bottom right;
            transition: transform 0.3s ease-out;
        }

        .user-selection button:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }
    </style>

  </head>
  <body>
        <nav class="navbar navbar-dark" style="background-color: #1A120B; height: 60px">
            <div class="container">
                <div class="w-100 d-flex justify-content-between">
                    <div class="container-fluid d-flex">
                        <a href="{{ route('admin') }}" style="color: white" class="mt-1 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                        </a>
                        <a class="navbar-brand mb-0 h1 d-flex flex-row bd-highlight">User Management</a>
                    </div>
                    <div class="container-fluid">
                        <a href="{{ route('adminlogout') }}" class="navbar-brand mb-0 d-flex flex-row-reverse bd-highlight" style="font-size: 16px">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
        @if (session('edit'))
            <p class="alert alert-success">{{session('edit')}}</p>
        @endif
        @if (session('password'))
            <p class="alert alert-success">{{session('password')}}</p>
        @endif
        <div class="container mt-4">
            <div class="container fw-bold">
                <h3>Daftar Supplier</h3>
            </div>
            <div class="d-flex align-items-center mt-3">
                <div class="container">
                    <div class="input-group mt-2">
                        <form action="{{ route('supplierManagement') }}" method="GET">
                            @csrf
                            <div class="input-group">
                                <input type="search" name="cari" style="max-width: 200px" class="form-control rounded" placeholder="Cari Pengguna" aria-label="Search" aria-describedby="search-addon" />
                                <button type="button" class="btn btn-warning">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="container d-flex flex-row-reverse">
                    <div class="d-flex justify-content-evenly">
                        <div class="user-selection">
                            <a href="{{route('ownerManagement')}}">
                                <button class="px-2 me-3">Pemilik Kebun</button>
                            </a>
                        </div>
                        <div class="user-selection">
                            <a href="{{route('supplierManagement')}}">
                                <button class="px-4">Supplier</button>
                            </a>
                        </div>
                    </div>
            
                </div>
            </div>
            <div class="container d-flex flex-column justify-content-around align-items-center mt-5">
                <div class="card" style="width: 100%">
                    <div class="card-body" style="width: 100%">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody id="table-content">
                                @if ($suppliers->count() > 0)
                                @foreach ($suppliers as $supplier)
                                <tr>
                                  <th scope="row">{{$loop->iteration}}</th>
                                  <td>{{$supplier['name']}}</td>
                                  <td>{{$supplier['username']}}</td>
                                  <td>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#supplierLihat-{{$supplier->id_supplier}}">Lihat</button>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#supplierEdit-{{$supplier->id_supplier}}">Edit</button>
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#supplierPass-{{$supplier->id_supplier}}">Reset Password</button>
                                  </td>
                                </tr>
                                @endforeach
                                @else
                                </tr>
                                    <td></td>
                                    <td>Username tidak tersedia.</td>
                                    <td></td>
                                    <td></td>
                                <tr>
                                @endif
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Lihat Modal -->
        @foreach ($suppliers as $supplier)
        <div class="modal fade" id="supplierLihat-{{$supplier->id_supplier}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container w-100 m-auto">
                            <div class="image d-flex justify-content-center">
                                <img src="{{asset($supplier->gambar)}}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover" alt="Avatar" />
                            </div>
                            <div>
                                <label for="supplierUsername"><b>Username</b></label>
                                <p name="supplierUsername" id="supplierUsername" >{{$supplier->username}}</p>
                                <label for="supplierAlamat"><b>Alamat</b></label>
                                <p name="supplierAlamat" id="supplierAlamat">{{$supplier->alamat}}</p>
                                <label for="supplierTelp"><b>Nomor Telepon</b></label>
                                <p name="supplierTelp" id="supplierTelp">{{$supplier->telp}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- Edit Modal -->
        @foreach ($suppliers as $supplier)
        <div class="modal fade" id="supplierEdit-{{$supplier->id_supplier}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ url('admin/supplierManagement/edit'. $supplier->id_supplier) }}">
                            @csrf
                            <div class="container w-100 m-auto">                            
                                <div class="mb-3">
                                  <label for="name" class="form-label">Nama</label>
                                  <input type="text" class="form-control" name="name" id="name" value="{{$supplier->name}}" required>
                                </div>
                                <div class="mb-3">
                                  <label for="username" class="form-label">Username</label>
                                  <input type="text" class="form-control" name="username" id="username" value="{{$supplier->username}}" required>
                                </div>
                                <div class="mb-3">
                                  <label for="alamat" class="form-label">Alamat</label>
                                  <input type="text" class="form-control" name="alamat" id="alamat" value="{{$supplier->alamat}}" required>
                                </div>
                                <div class="mb-3">
                                  <label for="telp" class="form-label">Nomor Telepon</label>
                                  <input type="text" class="form-control" name="telp" id="telp" value="{{$supplier->telp}}" required>
                                </div>
                                <div class="mb-3">
                                    <div class="col-lg-7 w-100">
                                        {{-- <input class="form-control my-3 p-2" placeholder="******" name="password" type="password"> --}}
                                        <label for="gambar" class="form-label">Foto Profil</label>
                                        <input class="form-control mb-3 p-2" value="{{ old('gambar') }}" name="gambar" id="gambar" type="file" accept="image/*" required onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                    <div class="col-lg-7">
                                        <img class="mb-3" src="{{asset($supplier->gambar)}}" id="output" width="150">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" style="color: black;" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-warning fw-bold" style="color: white;">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- Ganti Password Modal -->
        @foreach ($suppliers as $supplier)
        <div class="modal fade" id="supplierPass-{{$supplier->id_supplier}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- @if($errors->any())
                        @foreach($errors->all() as $err)
                            <p class="alert alert-danger">{{ $err }}</p>
                        @endforeach
                        @endif --}}
                        <form method="POST" action="{{ url('admin/supplierManagement/password'. $supplier->id_supplier) }}">
                            @csrf
                            <div class="container w-100 m-auto">                            
                                <div class="mb-3">
                                  <label for="password" class="form-label">Masukkan Password Baru</label>
                                  <input type="password" class="form-control" name="password" id="password" value="" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" style="color: black;" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-warning fw-bold" style="color: white;">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>