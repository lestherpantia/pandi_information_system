<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LGU-Pandi Resident Information System</title>

    {{--  ADMIN LTE CSS  --}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    {{--  ADMIN FONTS  --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    {{-- JS SCRIPTS --}}
    {{--  jQuery  --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    {{--  BOOTSTRAP  --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
</head>
<body>



<style>

    .main-wrapper {
        overflow: hidden;
    }

    .left {
        background-image: url("public/image/background/background.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        box-shadow: 2px 1px 5px 1px #888888;
    }

    .right {

    }


    .logo {
        margin: 50px 0px 0px 50px;
        width: 150px;
    }

    .logo_2 {
        display: none;
        position: absolute;
        top: 50px;
        left: 50px;
        width: 150px;
    }

    .card {
        width: 70%;
    }

    .card-header {
        color: #000;
        font-weight: 600;
        border-bottom: 3px solid #74b9ff;
    }

    @media all and (max-width: 1000px) {
        .card {
            width: 90%;
        }
    }

    @media all and (max-width: 720px) {
        .card {
            width: 70%;
        }

        .left {
            display: none;
        }

        .right {
            background-image: url("public/image/background/background.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .right .logo_2 {
            display: block;
        }
    }



</style>

<div class="main-wrapper container-fluild">

    <div class="row">

        <div class="left col-md-8">
            <img class="logo" src="{{ asset('image/icons/Green Apple Transparent.png') }}" alt="">
        </div>

        <div class="right col-sm-12 col-md-4 d-flex justify-content-center align-items-center" style="height: 100vh">

            <img class="logo_2" src="{{ asset('image/icons/Green Apple Transparent.png') }}" alt="">

            <div class="card login-box">

                <div class="card-header">
                    Admin Login
                </div>

                <div class="card-body">

                    <form action="" method="post">
                        {{ csrf_field() }}
                        {{-- Email field --}}
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                </div>
                            </div>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>

                        {{-- Password field --}}
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                   placeholder="{{ __('adminlte::adminlte.password') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                </div>
                            </div>
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>

                        {{-- Login field --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="icheck-primary">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">{{ __('adminlte::adminlte.remember_me') }}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type=submit class="btn btn-block rounded {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                                    <span class="fas fa-sign-in-alt"></span>
                                    {{ __('adminlte::adminlte.sign_in') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>










































