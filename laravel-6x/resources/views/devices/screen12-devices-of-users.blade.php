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
        <li class="menu text"><a href="{{url('/requests/me')}}">Yêu cầu của tôi</a></li>
        <li class="menu text"><a href="{{url('/devices/lists')}}">Danh sách thiết bị</a></li>
        <li class="menu text"><a href="{{url('/devices/lists/users')}}">Danh sách thiết bị của nhân viên</a></li>
        <li class="menu text"><a href="{{url('/requests/lists')}}">Danh sách yêu cầu</a></li>
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
                            <tbody>
                            @foreach($allDevicesOfUsers as $key => $deviceOfUsers)
                                <tr>
                                    <td>{{$deviceOfUsers->id}}</td>
                                    <td class="showUserName"><b>{{$deviceOfUsers->first_name}} {{$deviceOfUsers->last_name}}</b>
                                        <p class="showUserEmail">{{$deviceOfUsers->email}}</p></td>
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
                                            <a href="#" class="request-modal-click" data-id="{{$deviceOfUsers->request_id}}"
                                               data-title="{{$deviceOfUsers->first_name}} {{$deviceOfUsers->last_name}}"
                                               data-content="{{$deviceOfUsers->reason}}">
                                                #{{$deviceOfUsers->request_id}}
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($deviceOfUsers->released_at == null || $deviceOfUsers->released_at == '0000-00-00')
                                            <a href="#" class="released-modal-click" data-main="{{$deviceOfUsers->code}}"
                                               data-title="{{$deviceOfUsers->first_name}} {{$deviceOfUsers->last_name}}"
                                               data-content="{{$deviceOfUsers->name}}" data-id="{{$deviceOfUsers->device_id}}">Thu hồi</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
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

<section>
    <div class="modal fade" id="releasedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popup1Title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="releasedForm" method="post">
                        {{csrf_field()}}
                        <div class="form-group" hidden>
                            <label for="handover"><input name="handoverOrReleased" value="2"></label>
                        </div>
                        <fieldset id="assignFormTopics2">
                            <div class="form-group">
                                <label for="Birthday" class="col-form-label">Ngày thu hồi:</label>
                                <label for="releasedDay"></label><input type="date" class="form-control" id="releasedDay" name="releasedDay">
                            </div>
                        </fieldset>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="Submit" class="btn btn-primary" id="submitPopup1Button">Thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="showRequestInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popup2Title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group showRequestInfoModalContent1"></div>
                    <div class="form-group showRequestInfoModalContent2"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
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
    });
</script>
<script type="text/javascript">
    $('.released-modal-click').click(function () {
        $('#popup1Title').text('Thu hồi ' + $(this).data('main') + ': ' + $(this).data('content') + ' của nhân viên ' + $(this).data('title'));
        $('#releasedForm').attr('action', '{{url('/devices/lists/released/')}}' + '/' + $(this).data('id'));
        $('#releasedModal').modal('show');
    })
    $('.request-modal-click').click(function () {
        $('#popup2Title').text('Yêu cầu #' + $(this).data('id'));
        $('.showRequestInfoModalContent1').text('Nhân viên ' + $(this).data('title') + ' đã yêu cầu thiết bị. Lý do: ');
        $('.showRequestInfoModalContent2').text($(this).data('content'));
        $('#showRequestInfoModal').modal('show');
    })
</script>

{{--Validate data when released--}}
<script src="{{asset('public/backend/js/jquery-validation-1.19.2/dist/jquery.validate.js')}}"></script>
<script type="text/javascript">
    $().ready(function () {
        $("#releasedForm").validate({
            rules: {
                releasedDay: "required"
            }
        });
    });
</script>
</body>
</html>
