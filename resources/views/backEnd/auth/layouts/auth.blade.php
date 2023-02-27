<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ config('app.name') }} | @yield('title') </title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/backEnd/fontawesome-free/css/all.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/backEnd/all.min.css')}}">
    <!-- icheck bootstrap -->

    <link rel="stylesheet" href="{{asset('css/backEnd/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->

    <link rel="stylesheet" href="{{asset('css/backEnd/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Admin @yield('page-title')</b></a>
    </div>

    <div class="card">
        @yield('content')

    </div>
</div>

<!-- jQuery -->

<script src="{{asset('js/backEnd/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->

<script src="{{asset('js/backEnd/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->

<script src="{{asset('js/backEnd/adminlte.min.js')}}"></script>
</body>
</html>
