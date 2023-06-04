<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("./css/admindashboard.css")}}">

    <title>Admin | Owner Management</title>

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
                <h3>Daftar Permintaan Reset</h3>
            </div>
            <div class="container d-flex flex-column justify-content-around align-items-center mt-5">
                <div class="card" style="width: 100%">
                    <div class="card-body" style="width: 100%">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password Baru</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody id="table-content">
                                @foreach ($resetUser as $item)
                                @if ($item->username == 'NULL')
                                    @continue
                                @endif
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->username}}</td>
                                    <td>{{$item->passwordBaru}}</td>
                                    <td>
                                        @if ($item->role == 2)
                                        <form action="{{ url('admin/reset-user/owner/'.$item->fk_owner) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-warning">Reset password</button>
                                        </form>
                                        @elseif ($item->role == 3)
                                        <form action="{{ url('admin/reset-user/supplier/'.$item->fk_supplier) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-warning">Reset password</button>
                                        </form>
                                        @endif
                                    </td>
                                  </tr>
                                @endforeach
                            </tbody>
                            
                          </table>
                    </div>
                </div>
            </div>
        </div>

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