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
<html lang="en">
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
    <link rel="stylesheet" href="{{asset('public/frontend/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/js/jquery-validation-1.19.2/demo/css/screen.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/stylesheet.css')}}">

</head>
<body class="hold-transition login-page">
<section class="menu-top" id="header">
{{--    Menu--}}
    <ul class="menu">
        <li class="menu"><a href="{{url('/me')}}" ><img src="{{url('public/frontend/images/KIAI_logo.PNG')}}" alt="Logo"></a></li>
        <li class="menu text"><a href="{{url('/devices/me')}}">Thiết bị của tôi</a></li>
        <li class="menu text"><a href="#">Yêu cầu của tôi</a></li>
        <li class="menu text"><a href="{{url('/devices/lists')}}">Danh sách thiết bị</a></li>
        <li class="menu text"><a href="{{url('/devices/lists/users')}}">Danh sách thiết bị của nhân viên</a></li>
        <li class="menu text"><a href="#">Danh sách yêu cầu</a></li>
        <li class="menu text"><a href="{{url('/users/lists/')}}">Danh sách user</a></li>
        <li class="menu avatar"><img src="{{url('public/frontend/images/avatars/' . Session::get('sUser')->avatar)}}" alt="avatar" id="avatar"></li>
        <li class="menu text name">
            <a href="{{url('logout')}}">
                <?php
                $user = Session::get('sUser');
                if(isset($user)) {
                    echo $user->first_name . ' ' . $user->last_name;
                }
                ?>
            </a>
        </li>
    </ul>
</section>

{{--Content--}}
@yield('content')

<!-- jQuery -->
<script src="{{asset('public/frontend/css/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/frontend/css/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/frontend/css/dist/js/adminlte.min.js')}}"></script>

{{--<script src="{{asset('public/frontend/js/jquery-1.12.4.js')}}"></script>--}}
<script src="{{asset('public/backend/js/jquery-validation-1.19.2/lib/jquery.mockjax-2.2.1.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery-ui.js')}}"></script>
<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            dateFormat: "dd/mm/yy",
            defaultDate: "0d",
            changeYear: true,
            changeMonth: true,
            yearRange: "1980:2020"
        });
    });
</script>

<script src="{{asset('public/backend/js/jquery-validation-1.19.2/dist/jquery.validate.js')}}"></script>
<script>
    $("#editProfileForm").validate();
    $().ready(function () {
        $("#changePasswordForm").validate({
            rules: {
                password: "required",
                new_password: {
                    required: true,
                    strongPassword: true
                },
                confirm_new_password: {
                    required: true,
                    strongPassword: true,
                    equalTo: "#new_password"
                }
            }
        })

        $("#editDeviceForm").validate({
            rules: {
                devicePrice: {
                    required: true,
                    number: true
                }
            }
        })
    })
</script>
<script src="{{asset('public/backend/js/jquery-validation-1.19.2/src/localization/messages_vi.js')}}"></script>
<script src="{{asset('public/backend/js/jquery-validation-1.19.2/src/additional/strongPassword.js')}}"></script>
</body>
</html>

{{--</form>--}}
