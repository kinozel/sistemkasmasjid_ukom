<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="icon" href="{{asset('mosque2.png')}}">
    <title>Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css"> <!-- Tambahkan Bootstrap CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
</head>
<body >
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-8">
            <div class="card" style="width: 100%;">
            

                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="bgnewlogin.png" alt="Gambar Card" class="img-fluid">
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card-body">
                            @if(Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                            @endif
                            <form action="{{ route('auth.login') }}" method="POST">


                                @csrf 
                            <h5 class="card-title text-center custom-login-text-2">LOGIN</h5>
                            <div class="form-group">
                            <label for="username" class="custom-username-label">USERNAME</label>
                            <input type="text" class="form-control custom-text-input" id="username" name="username">
                            <label for="password" class="custom-username-label">PASSWORD</label>
                            <input type="password" class="form-control custom-text-input" id="password" name="password">
                        </div>
                        <div class="text-danger errors">
                                    <p class="err-message"></p>
                                </div>
                        <button class="custom-login-button" type="submit">Login</button>
                        <div class="custom-register-text">
                            Belum punya akun?
                         <span>  <a href="">Daftar</a></span>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>

