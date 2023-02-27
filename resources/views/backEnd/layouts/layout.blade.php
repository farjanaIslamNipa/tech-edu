<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--- FAVICONS --->
    <link rel="icon" href="{{ asset('images/favicon/favicon-192.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/favicon/favicon-180.png') }}" />

    <title> {{ config('app.name') }}: Back Office  @yield('title') </title>
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">

    <!-- Font Awesome -->
{{--    <link rel="stylesheet" href="{{asset('css/backEnd/fontawesome-free/css/all.min.css')}}">--}}
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/backEnd/all.min.css')}}">
    <!-- icheck bootstrap -->

    <link rel="stylesheet" href="{{asset('css/backEnd/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/backEnd/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/backEnd/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/backEnd/custom.css') }}">
    @yield('css')

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    @include('backEnd.includes.topNav')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('backEnd.includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div id="app">
        @yield('content')
    </div>

    <!-- /.content-wrapper -->

    @include('backEnd.includes.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<script src="{{ mix('js/app.js') }}"></script>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('js/backEnd/jquery.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script src="{{asset('js/backEnd/bootstrap.bundle.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('js/backEnd/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js/backEnd/demo.js') }}"></script>
<script src="{{ asset('js/backEnd/summernote-bs4.min.js') }}"></script>

<!--datepicker-->
<script src="{{ asset('js/backEnd/moment/moment.min.js') }}"></script>
<script src="{{ asset('js/backEnd/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.js') }}"></script>
@yield('scripts')
</body>
</html>
