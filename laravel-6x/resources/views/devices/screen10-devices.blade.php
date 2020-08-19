
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
    <h1 style="text-align: center">Screen 10</h1>
    <div class="addUserButton">
        <button class="btn btn-primary"><a href="{{url('/devices/add')}}">+Thêm thiết bị</a></button>
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
                                <th>Danh mục</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Mô tả</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($allDevices as $key => $device)
                                <tr>
                                    <td>{{$device->id}}</td>
                                    <td>
                                        @switch($device->category)
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
                                    <td>{{$device->code}}</td>
                                    <td>{{$device->name}}</td>
                                    <td>{{$device->description}}</td>
                                    <td>{{number_format($device->price)}} VND</td>
                                    <td>
                                        @switch($device->status)
                                            @case(1)Trong kho
                                                @break
                                            @case(2)Đang sử dụng
                                                @break
                                            @case(3)Thanh lý
                                                @break
                                            @default
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="#" class="assign-modal-click" data-id="{{$device->id}}" data-title="{{$device->name}}">Assign</a>
                                        <a href="#" class="history-modal-click" data-id="{{$device->id}}" data-title="{{$device->name}}">History</a>
                                        <a href="{{url('devices/' . $device->id . '/edit')}}">Edit</a>
                                        <a onclick="return confirm('Bạn có muốn xóa thiết bị {{$device->name}} không?')"
                                           href="{{url('devices/' . $device->id . '/delete')}}">
                                            Delete
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

<section>
    <div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popup1Title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="assignForm">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="handover"><input type="radio" name="handoverOrReleased" id="handover" value="1"></label>
                            <label class="radioLabel">Bàn giao</label>
                            <label for="released"><input type="radio" class="radioGender" name="handoverOrReleased" id="released" value="2"></label>
                            <label class="radioLabel">Thu hồi</label>
                        </div>
                        <p>
                        <fieldset id="assignFormTopics">
                            <div class="form-group">
                                <label for="Birthday" class="col-form-label">Ngày bàn giao:</label>
                                <input type="date" class="form-control" id="handoverDay" name="handoverDay">
                            </div>
                            <div class="form-group">
                                <label for="Name" class="col-form-label">Bạn muốn bàn giao thiết bị cho:</label>
                                <select class="form-control" id="handoverUser" name="handoverUser">
                                    @foreach($allUsers as $key => $user)
                                        <option value="{{$user->last_name}}">{{$user->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Name" class="col-form-label">Thiết bị mua bởi yêu cầu:</label>
                                <select class="form-control" id="handoverRequest" name="handoverRequest">
                                    @foreach($allRequests as $key => $request)
                                        <option value="{{$request->id}}">{{$request->id}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        <fieldset id="assignFormTopics2">
                            <div class="form-group">
                                <label for="Birthday" class="col-form-label">Ngày thu hồi:</label>
                                <input type="date" class="form-control" id="releasedDay" name="releasedDay">
                            </div>
                        </fieldset>

                        </p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="Submit" class="btn btn-primary" id="submitPopup1Button">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showHistoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popup2Title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="assignForm">
                        {{csrf_field()}}
                        <!-- Main content -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Tên nhân viên</th>
                                                    <th>Ngày bàn giao</th>
                                                    <th>Ngày thu hồi</th>
                                                </tr>
                                                </thead>
                                                <thead id="showHistoryModalContent">

                                                </thead>
{{--                                                @foreach($allDevices  as $key => $device)--}}
{{--                                                    <tr>--}}
{{--                                                        <td id="showHistoryModalUserName"></td>--}}
{{--                                                        <td id="showHistoryModalHandoverAt"></td>--}}
{{--                                                        <td id="showHistoryModalReleasedAt"></td>--}}
{{--                                                    </tr>--}}
{{--                                                @endforeach--}}
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>

                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
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
    // Assign
    $('.assign-modal-click').click(function () {
        // $id = $(this).atrr('id');
        // $.post('devices/lists/get-device-info/', {id:$id}, function (data) {
        // })
        $('#assignModal').modal('show');
        $('#popup1Title').text($(this).data('id') + ': ' + $(this).data('title'));
    })

    // $('submitPopup1Button').click(function () {
    //     $.ajax({
    //         type : 'POST',
    //         url : '/devices/lists/assign/' + $(this).data('id'),
    //         data: {
    //             '_token': $('input[name=_token]').val(),
    //             'id': $("#fid").val(),
    //             'title': $('#t').val(),
    //             'body': $('#b').val()
    //         },
    //         success: function(data) {
    //             $('.post' + data.id).replaceWith(" "+
    //                 "<tr class='post" + data.id + "'>"+
    //                 "<td>" + data.id + "</td>"+
    //                 "<td>" + data.title + "</td>"+
    //                 "<td>" + data.body + "</td>"+
    //                 "<td>" + data.created_at + "</td>"+
    //                 "<td><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-trash'></span></button></td>"+
    //                 "</tr>");
    //         }
    //     });
    //     $('#assignModal').modal('hide');
    // });

    // Show history
    $('.history-modal-click').click(function () {
        $('#showHistoryModal').modal('show');
        $('#popup2Title').text('Lịch sử bàn giao thiết bị ' + $(this).data('id') + ': ' + $(this).data('title'));
        $.ajax({
            type : 'POST',
            url : '/devices/lists/showHistory/' + $(this).data('id'),
            data : {

            }
        })
    });

    // $('#saveButton').click(function() {
    //     $.ajax({
    //         type : 'POST',
    //         url : 'addPost',
    //         data : {
    //             '_token' : $('input[name=_token]').val(),
    //             'title' : $('input[name=title]').val(),
    //             'body' : $('input[name=body]').val()
    //         },
    //         success: function (data) {
    //             if (data.errors) {
    //                 $('.error').removeClass('hidden');
    //                 $('.error').text(data.errors.title);
    //                 $('.error').text(data.errors.body);
    //             } else {
    //                 $('.error').remove();
    //                 $('#table').append("<tr class='post" + data.id + "'>"+
    //                     "<td>" + data.id + "</td>"+
    //                     "<td>" + data.title + "</td>"+
    //                     "<td>" + data.body + "</td>"+
    //                     "<td>" + data.created_at + "</td>"+
    //                     "<td><a class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.title +
    //                         "' data-body='" + data.body + "'>"+
    //                     "<i class='fa fa-eye'></i></a>"+
    //                     "<a class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title +
    //                         "' data-body='" + data.body + "'>"+
    //                     "<i class='glyphicon glyphicon-pencil'></i></a>"+
    //                     "<td><a class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-title='" + data.title +
    //                         "' data-body='" + data.body + "'>"+
    //                     "<i class='glyphicon glyphicon-trash'></i></a>"+
    //                     "<td>"+
    //                     "<tr>"
    //                 );
    //             }
    //         }
    //     });
    //     $('#title').val('');
    //     $('#body').val('');
    // })
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
