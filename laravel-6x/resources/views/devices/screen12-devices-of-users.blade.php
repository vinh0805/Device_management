
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
    <link rel="stylesheet" href="{{asset('public/frontend/fonts/font.css')}}">
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
    <h1 style="text-align: center">Screen 12</h1>
    <div class="addUserButton">
        <button class="btn btn-primary"><a href="{{url('/requests/lists')}}">D/s yêu cầu</a></button>
    </div>
    <div class="addUserButton">
        <button class="btn btn-primary"><a href="{{url('/devices/lists')}}">D/s thiết bị</a></button>
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
                                <th>Tên nhân viên</th>
                                <th>Danh mục</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Ngày bàn giao</th>
                                <th>Ngày thu hồi</th>
                                <th>Yêu cầu</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($allDevicesOfUsers as $key => $deviceOfUsers)
                                <tr>
                                    <td>{{$deviceOfUsers->id}}</td>
                                    <td>{{$deviceOfUsers->name}}</td>
                                    <td>
                                        @switch($deviceOfUsers->category)
                                            @case(1)Screen
                                            @break
                                            @case(2)Mouse
                                            @break
                                            @case(3)Keyboard
                                            @break
                                            @case(4)Case
                                            @break
                                            @case(5)Phone
                                            @break
                                            @case(6)Laptop
                                            @break
                                            @case(7)Chair
                                            @break
                                            @case(8)Table
                                            @break
                                            @case(9)Hard disk
                                            @default
                                        @endswitch
                                    </td>
                                    <td>{{$deviceOfUsers->code}}</td>
                                    <td>{{$deviceOfUsers->name}}</td>
                                    <td>{{$deviceOfUsers->handover_at}}</td>
                                    <td>
                                        @if($deviceOfUsers->released_at != null && $deviceOfUsers->released_at != '0000-00-00')
                                            {{$deviceOfUsers->released_at}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($deviceOfUsers->released_at != null && $deviceOfUsers->released_at != '0000-00-00')
                                            <a href="#" id="request{{$deviceOfUsers->request_id}}">#{{$deviceOfUsers->request_id}}</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="modal-click" id="takeBack{{$deviceOfUsers->id}}">Thu hồi</a>
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
<script src="{{asset('public/frontend/css/dist/js/demo.js')}}"></script>
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

<script type="text/javascript">
    $('.modal-click').click(function () {
        // $.post('devices/lists/get-device-info', {id:6}, function (data) {
        //
        // })
        $('#assignModal').modal('show');
    })
</script>
<script src="{{asset('public/backend/js/jquery-validation-1.19.2/dist/jquery.validate.js')}}"></script>
<script type="text/javascript">
    $().ready(function () {
        $("#assignForm").validate({
            rules: {
                handoverOrReleased: "required",
                handoverDay: {
                    required: "#handover:checked"
                },
                handoverUser: {
                    required: "#handover:checked"
                },
                handoverDevice: {
                    required: "#handover:checked"
                },
                releasedDay: {
                    required: "#released:checked"
                }
            }
        });

        let handover = $("#handover");
        let initial = handover.is(":checked");
        if (!initial)
            $("#assignFormTopics").attr("style", "display: none");
        else $("#assignFormTopics").attr("style", "visibility: visible");

        handover.click(function() {
            let initial = handover.is(":checked");
            if (!initial)
                $("#assignFormTopics").attr("style", "display: none");
            else $("#assignFormTopics").attr("style", "visibility: visible");

            let initial2 = released.is(":checked");
            if (!initial2)
                $("#assignFormTopics2").attr("style", "display: none");
            else $("#assignFormTopics2").attr("style", "visibility: visible");
        })

        let released = $("#released");
        let initial2 = released.is(":checked");
        if (!initial2)
            $("#assignFormTopics2").attr("style", "display: none");
        else $("#assignFormTopics2").attr("style", "visibility: visible");

        released.click(function() {
            let initial = handover.is(":checked");
            if (!initial)
                $("#assignFormTopics").attr("style", "display: none");
            else $("#assignFormTopics").attr("style", "visibility: visible");

            let initial2 = released.is(":checked");
            if (!initial2)
                $("#assignFormTopics2").attr("style", "display: none");
            else $("#assignFormTopics2").attr("style", "visibility: visible");
        });
    });

</script>

</body>
</html>

{{--</form>--}}
