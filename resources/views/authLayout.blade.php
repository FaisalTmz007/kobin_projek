<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="{{asset("./assets/img/webLogo.png")}}" type="image/x-icon">

    <title>@yield('title')</title>

    <style>
      .btn-auth{
        border: none;
        margin-bottom: 24px;
        background-color: #DA7B29;
        height: 40px;
        width: 100%;
        font-weight: 600;
        font-size: 16px;
        color: #FFFFFF;
        border-radius: 8px;
      } 
      .admin-selection button {
        border: 1px solid #DA7B29;
        background-color: white;
        color: #DA7B29;
        font-weight: 600;
        height: 40px;
        width: 100px;
        border-radius: 60px;
        margin-right: 15px;
        transition: all 0.5s ease-out;
      }

      .admin-selection button:hover {
        background-color: #DA7B29;
        color: white;
      }

      .user-selection button {
        border: none;
        background-color: #DA7B29;
        color: white;
        font-weight: 600;
        height: 40px;
        width: 100px;
        margin-right: 15px;
        border-radius: 60px;
        transition: all 0.5s ease-out;
      }
      .user-selection button:hover {
        box-shadow: 1px 1px 1px black;
      }
    </style>
  </head>
  <body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
          @if(session('success'))
          <p class="alert alert-success">{{ session('success') }}</p>
          @endif
          @if ($errors->any())
          @foreach ($errors->all() as $err)
          <p class="alert alert-danger">{{ $err }}</p>
          @endforeach
          @endif
          <div class="card login-card">
            <div class="row no-gutters">
              <div class="col-md-5">
                @yield('auth-image')
              </div>
              <div class="col-md-7 d-flex justify-content-center align-items-center">
                @yield('auth-form')
              </div>
            </div>
          </div>
        </div>
      </main>

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