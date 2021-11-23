<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>

    {{--  ADMIN LTE CSS  --}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">


    {{--  ADMIN FONTS  --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

</head>

<style>
    body {
        width: 100%;
        height: 100vh;
        margin: 0;
        padding: 0;
        background: #fff;
    }

    header {
        width: 100%;
        padding: 20px 40px 30px;
    }

    header img {
        width: 150px;
    }

    header h3 {
        margin: 0;
        font-weight: bold;
    }

    header .logo {
        width: 120px;
    }


    @media all and (max-width: 1097px) {
        header {
            padding: 30px 30px 0;
        }

        header img {
            width: 150px;
        }

        header .logo {
            width: 100px;
        }

        header h3 {
            text-align: right;
        }
    }

    footer {
        position: fixed;
        background: #fff;
        width: 100%;
        bottom: 0;
        padding: 10px 0;
    }
</style>

<body>

{{-- JS SCRIPTS --}}

{{--  jQuery  --}}
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

{{--  BOOTSTRAP  --}}
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

{{--  APP JS FOR VUE JS  --}}
<script src="{{ asset('js/app.js') }}" defer></script>


@yield('header')


<div class="content">
    @yield('content')
</div>

@yield('footer')



</body>
</html>
