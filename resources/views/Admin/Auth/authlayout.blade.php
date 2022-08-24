
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('pvm_assets/plugins/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('pvm_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('pvm_assets/css/adminlte.min.css')}}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        @yield('authlogin')
        @yield('authregister')



        <!-- jQuery -->
    <script src="{{asset('pvm_assets/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
    <script src="{{asset('pvm_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
    <script src="{{asset('pvm_assets/js/adminlte.min.js')}}"></script>
</body>

</html>
