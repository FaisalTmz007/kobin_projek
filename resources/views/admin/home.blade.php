<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("./css/admindashboard.css")}}">

    <title>Admin Dashboard</title>


  </head>
  <body>
        <nav class="navbar navbar-dark" style="background-color: #1A120B; height: 60px">
            <div class="container">
                <div class="w-100 d-flex justify-content-between">
                    <div class="container-fluid">
                        <a class="navbar-brand mb-0 h1 d-flex flex-row bd-highlight" href="{{ route('admin') }}">Halaman Admin</a>
                    </div>
                    <div class="container-fluid">
                        <a href="{{ route('adminlogout') }}" class="navbar-brand mb-0 d-flex flex-row-reverse bd-highlight" style="font-size: 16px">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container d-flex justify-content-around align-items-center" style="height: 100%">
            <a href="{{ route('ownerManagement') }}" class="card-menu container d-flex flex-column justify-content-center align-items-center text-decoration-none" style="color: #000000">
                <div class="card-content-1">
                    <img src="{{asset("./assets/img/userManagement.png")}}" alt="">
                    <p class="text-center mt-1 fw-bold">Kelola Akun User</p>
                </div>
                <div class="card-button">
                    <button>Buka</button>
                </div>
            </a>
            <a href="{{ route('premium-manager') }}" class="card-menu container d-flex flex-column justify-content-center align-items-center text-decoration-none" style="color: #000000">
                <div class="card-content-1">
                    <img src="{{asset("./assets/img/premiumManagement.png")}}" alt="">
                    <p class="text-center mt-3 fw-bold">Kelola Fitur Premium</p>
                </div>
                <div class="card-button">
                    <button>Buka</button>
                </div>
            </a>
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