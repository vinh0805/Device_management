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
    <h1 style="text-align: center">Screen 14</h1>
    <div class="addUserButton">
        <button class="btn btn-primary"><a href="{{url('/requests/add')}}">Thêm yêu cầu</a></button>
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
                                <th>Nhân viên yêu cầu</th>
                                <th>Lý do</th>
                                <th>Ngày tạo</th>
                                <th>Tình trạng</th>
                                <th>Người xác nhận</th>
                                <th>Ngày xác nhận</th>
                                <th>Bàn giao</th>
                                <th>Ngày bàn giao</th>
                                <th style="min-width: 57px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allRequestOfUsers as $key => $requestOfUser)
                                <tr>
                                    <td>{{$requestOfUser->id}}</td>
                                    <td class="showUserName"><b>{{$requestOfUser->user_first_name}} {{$requestOfUser->user_last_name}}</b>
                                        <p class="showUserEmail">{{$requestOfUser->user_email}}</p></td>
                                    <td>{{$requestOfUser->reason}}</td>
                                    <td>{{date('Y-m-d', strtotime($requestOfUser->created_at))}}</td>
                                    <td>
                                        @switch($requestOfUser->status)
                                            @case(1)<label class="newStatus">New</label>
                                            @break
                                            @case(2)<label class="approvedStatus">Approved</label>
                                            @break
                                            @case(3)<label class="rejectedStatus">Rejected</label>
                                            @break
                                            @case(4)<label class="completedStatus">Completed</label>
                                            @break
                                            @default
                                        @endswitch
                                    </td>
                                    <td class="showUserName"><b>{{$requestOfUser->leader_first_name}} {{$requestOfUser->leader_last_name}}</b>
                                        <p class="showUserEmail">{{$requestOfUser->leader_email}}</p></td>
                                    <td>@if(isset($requestOfUser->approved_at))
                                            {{date('Y-m-d', strtotime($requestOfUser->approved_at))}}@endif</td>
                                    <td>
                                        @if($requestOfUser->status == 4 || $requestOfUser->status == 2)
                                            <a href="#" class="request-info-modal-click" data-id="{{$requestOfUser->id}}">#{{$requestOfUser->id}}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($requestOfUser->status == 4 || $requestOfUser->status == 2)
                                            {{date('Y-m-d', strtotime($requestOfUser->handover_at))}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($requestOfUser->status == 1)
                                            <a href="#" data-id="{{$requestOfUser->id}}" class="assign-modal-click">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </a>
                                            <a onclick="return confirm('Bạn có muốn từ chối yêu cầu {{$requestOfUser->id}} không?')"
                                               href="{{url('requests/' . $requestOfUser->id . '/reject')}}">
                                                <i class="fa fa-ban" aria-hidden="true"></i>
                                            </a>
                                            <a onclick="return confirm('Bạn có muốn xóa yêu cầu {{$requestOfUser->id}} không?')"
                                               href="{{url('requests/' . $requestOfUser->id . '/delete')}}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
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
    <div class="modal fade" id="showRequestInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popup1Title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="show-request-info-row"><b>Danh mục:</b></div>
                        <label id="RequestInfoModalCategory" class="show-request-info-row2"></label>
                    </div>
                    <div>
                        <div class="show-request-info-row"><b>Mã sản phẩm:</b></div>
                        <label id="RequestInfoModalCode" class="show-request-info-row2"></label>
                    </div>
                    <div>
                        <div class="show-request-info-row"><b>Tên sản phẩm:</b></div>
                        <label id="RequestInfoModalName" class="show-request-info-row2"></label>
                    </div>
                    <div>
                        <div class="show-request-info-row"><b>Ngày bàn giao:</b></div>
                        <label id="RequestInfoModalHandoverAt" class="show-request-info-row2"></label>
                    </div>
                    <div>
                        <div class="show-request-info-row"><b>Ngày thu hồi:</b></div>
                        <label id="RequestInfoModalReleasedAt" class="show-request-info-row2"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="assignDeviceToUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popup2Title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="assignForm" method="post">
                        {{@csrf_field()}}
                        <div class="form-group">
                            <label>Bạn muốn bàn giao sản phẩm: </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <select class="form-control" name='assignedDevice'>
                                    @foreach($inStockDevices as $device)
                                        <option value="{{$device->id}}">{{$device->id}} - {{$device->code}}: {{$device->name}}</option>
                                    @endforeach
                                </select>
                            </label>
                            <div class="form-group">
                                <label for="Birthday" class="col-form-label">Ngày bàn giao:</label>
                                <label for="handoverDay"></label><input type="date" class="form-control" id="handoverDay" name="handoverDay">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="Submit" class="btn btn-primary" id="submitPopup1Button">Bàn giao</button>
                        </div>
                    </form>
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
            "autoWidth": true,
        });
    });
</script>

<script type="text/javascript">
    // Approve request
    $('.assign-modal-click').click(function () {
        if (confirm('Bạn có muốn chấp thuận yêu cầu ' + $(this).data('id') + ' không?')) {
            $('#assignDeviceToUserModal').modal('show');
            $('#popup2Title').text('Bàn giao sản phẩm cho yêu cầu ' + $(this).data('id') + ':');
            $('#assignForm').attr('action', '{{url('/requests/')}}' + '/' + $(this).data('id') + '/approve');
        }
    })

    // Show request info
    $('.request-info-modal-click').click(function () {
        $('#showRequestInfoModal').modal('show');
        $.ajax({
            type : 'get',
            url : 'me/show-request-info/' + $(this).data('id'),
            dataType : 'json',

            success: function (response) {
                console.log(response);
                $('#popup1Title').text('Bàn giao ' + response["code"] + ' - ' + response["name"]);
                switch (response["category"]) {
                    case 1:
                        $('#RequestInfoModalCategory').text('Screen');
                        break;
                    case 2:
                        $('#RequestInfoModalCategory').text('Mouse');
                        break;
                    case 3:
                        $('#RequestInfoModalCategory').text('Keyboard');
                        break;
                    case 4:
                        $('#RequestInfoModalCategory').text('Case');
                        break;
                    case 5:
                        $('#RequestInfoModalCategory').text('Phone');
                        break;
                    case 6:
                        $('#RequestInfoModalCategory').text('Laptop');
                        break;
                    case 7:
                        $('#RequestInfoModalCategory').text('Chair');
                        break;
                    case 8:
                        $('#RequestInfoModalCategory').text('Table');
                        break;
                    case 9:
                        $('#RequestInfoModalCategory').text('Hard Disk');
                        break;
                    default: break;
                }
                $('#RequestInfoModalCode').text(response["code"]);
                $('#RequestInfoModalName').text(response["name"]);
                $('#RequestInfoModalHandoverAt').text(response["handover_at"]);
                $('#RequestInfoModalReleasedAt').text(response["released_at"]);
            }
        })
    });
</script>
{{--Validate data when released--}}
<script src="{{asset('public/backend/js/jquery-validation-1.19.2/dist/jquery.validate.js')}}"></script>
<script type="text/javascript">
    $().ready(function () {
        $("#assignForm").validate({
            rules: {
                handoverDay: "required"
            }
        });
    });
</script>

</body>
</html>
