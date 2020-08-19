
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
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css//plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
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

<section id="content">
    <h1 style="text-align: center">Screen 04</h1>
    <div class="addUserButton">
        <button class="btn btn-primary"><a href="{{url('users/add/')}}">+Add User</a></button>
    </div>
    <div class="wrapper">
        <!-- Main content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Địa chỉ</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($allUser as $key => $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td><img class="avatar" src="{{url('public/frontend/images/avatars/' . $value->avatar)}}"></td>
                                    <td>{{$value->first_name . ' ' . $value->last_name}}</td>
                                    @if($value->email_verified_at)
                                        <td class="verifiedEmail">{{$value->email}}</td>
                                    @else
                                        <td>{{$value->email}}</td>
                                    @endif
                                    <td>
                                        @if($value->gender == 1)
                                            Male
                                        @elseif($value->gender == 2)
                                            Female
                                        @endif
                                    </td>
                                    <td>{{$value->birthday}}</td>
                                    <td>{{$value->address}}</td>
                                    <td>
                                        @if($value->role == 1)
                                            Admin
                                        @elseif($value->role == 2)
                                            User
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('users/' . $value->id . '/password')}}"><i class="fas fa-key"></i></a>
                                        <a href="{{url('users/' . $value->id . '/role')}}"><i class="fas fa-user"></i></a>
                                        <a href="{{url('users/' . $value->id . '/edit')}}"><i class="fas fa-edit"></i></a>
                                        <a onclick="return confirm('Bạn có muốn xóa tài khoản {{$value->email}} không?')"
                                           href="{{url('users/' . $value->id . '/delete')}}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

</section>


<!-- jQuery -->
<script src="{{asset('public/frontend/css/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/frontend/css/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('public/frontend/css/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/frontend/css/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/frontend/css/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/frontend/css/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/frontend/css/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>
</html>

</body>
</html>

{{--</form>--}}
