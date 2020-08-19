@extends('layout')
@section('content')

    <h1>Screen 07</h1>
    <form role="form" method="post" id="changePasswordForm" action="{{url('/users/' . $editUser->id . '/password/update')}}"
          enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="card-body">
            <div class="form-group" id="formHeader">
                <label><h2>Thay đổi mật khẩu: <span id="nameInfoH2">{{$editUser->first_name . ' ' . $editUser->last_name}}</span></h2></label>
            </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mật khẩu mới</label>
                <label class="star"> (*)</label>
                <input type="password" class="form-control" id="new_password" data-validation="length"
                       minlength="6" data-msg-minlength="Ít nhất 6 ký tự!" name="new_password">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" id="confirm_new_password" data-validation="length"
                       data-validation-length="min6" data-validation-error-msg="Ít nhất 6 ký tự, ít nhất 1 ký tự hoa,
                       1 ký tự đặc biệt!" name="confirm_new_password">
            </div>

            <div class="form-group">
                <?php
                $message = Session::get('message');
                if($message == 'Cập nhật mật khẩu thành công!') {
                    echo '<div id="updateSuccessfullyMessage"><span>' . $message . '</span></div>';
                } else {
                    echo '<div id="updateFailMessage"><span>' . $message . '</span></div>';
                }
                Session::put('message', null);
                ?>
            </div>

            <div class="form-group" id="endButtonsDiv">
                <button id="goBackButton" class="btn btn-primary"><a id="goBack" href="{{url('/users/lists')}}"><< Quay lại</a></button>
                <button type="submit" id="submitButton" class="btn btn-primary">Thay đổi</button>
            </div>
        </div>
        <!-- /.card-body -->

    </form>

@endsection
