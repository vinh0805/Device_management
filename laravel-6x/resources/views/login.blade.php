{{--@if (count($errors) >0)--}}
{{--    <ul>--}}
{{--        @foreach($errors->all() as $error)--}}
{{--            <li class="text-danger"> {{ $error }}</li>--}}
{{--        @endforeach--}}
{{--    </ul>--}}
{{--@endif--}}
{{--<form action="{{url('login-confirm-password')}}" method="post">--}}
{{--    @csrf--}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/ionicons.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{asset('public/frontend/fonts/font.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/frontend/css/stylesheet.css')}}">

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <h1>Quản lý thiết bị</h1>
        <h2>Đăng nhập</h2>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <?php
        $message = Session::get('message');
        if($message) {
            echo '<span id="loginError">' . $message . '</span>';
            Session::put('message', null);
        }
        ?>

        <div class="card-body login-card-body">
            <form action="{{url('login-confirm')}}" method="post">
            {{csrf_field()}}
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4"></div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" id="loginButton">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('public/frontend/css/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/frontend/css/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/frontend/css/dist/js/adminlte.min.js')}}"></script>
</body>
</html>

{{--</form>--}}
