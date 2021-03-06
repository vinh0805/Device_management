@extends('layout')
@section('content')

    <h1>Screen 02</h1>
    <form role="form" method="post" id="editProfileForm" action="{{url('update-profile/' . $user->id)}}"
          enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="card-body">
            <div class="form-group" id="formHeader">
                <label><h2>Thông tin của tôi</h2></label>
                <span id="changePassSpan">
                    <button class="btn btn-primary" id="changePassButton">
                        <a href="{{url('me/password/')}}">
                            Thay đổi mật khẩu
                        </a>
                    </button>
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Họ và tên đệm</label>
                <label class="star"> (*)</label>
                <input type="text" class="form-control" id="inputFisrtName" placeholder="First name" value="{{$user->first_name}}"
                       maxlength="32" data-msg-required="Bạn phải nhập trường này!" required name="first_name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tên</label>
                <label class="star"> (*)</label>
                <input type="text" class="form-control" id="inputLastName" placeholder="Last name" value="{{$user->last_name}}"
                       maxlength="32" data-msg-required="Bạn phải nhập trường này!" required name="last_name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Địa chỉ email</label>
                <input type="email" class="form-control" id="inputEmail1" placeholder="Enter email" value="{{$user->email}}" name="email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Giới tính</label>
            </div>
            <div class="form-group">
                <input type="radio" class="radioGender" name="gender" id="male" value="1"
                       @if($user->gender == 1)
                           checked
                       @endif
                >
                <label class="radioLabel">Nam</label>
                <input type="radio" class="radioGender" name="gender" id="female" value="2"
                       @if($user->gender == 2)
                           checked
                       @endif
                >
                <label class="radioLabel">Nữ</label>
            </div>
            <div class="form-group">
                <label for="inputBirthday">Ngày sinh</label>
                <?php
                $date = (isset($_POST["datepicker"])) ? $_POST["datepicker"] : $user->birthday;
                ?>
                <input class="form-control" readonly="readonly" id="datepicker" name="datepicker" placeholder="Birthday"
                       value="<?php echo $date; ?>">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Địa chỉ</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Enter address" value="{{$user->address}}" name="address">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Avatar</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" id="exampleInputFile" name="avatar">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php
                $message = Session::get('message');
                if($message) {
                    echo '<div id="updateSuccessfullyMessage"><span>' . $message . '</span></div>';
                    Session::put('message', null);
                }
                ?>
            </div>

            <div class="form-group" id="endButtonsDiv">
                <button type="submit" id="submitButton" class="btn btn-primary">Thay đổi</button>
            </div>
        </div>
        <!-- /.card-body -->

    </form>

@endsection
