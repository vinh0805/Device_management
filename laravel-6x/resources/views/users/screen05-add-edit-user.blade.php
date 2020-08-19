@extends('layout')
@section('content')

    <h1>Screen 05</h1>
    <form role="form" method="post" id="editProfileForm" action="
        @if(isset($editUser))
            {{url('users/' . $editUser->id . '/update/')}}
        @else
            {{url('users/save')}}
        @endif
        " enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="card-body">
            <div class="form-group" id="formHeader">
                <label>
                    <h2 id="formHeader">
                        @if(isset($editUser))
                            Thông tin của <span id="nameInfoH2">{{$editUser->first_name . ' ' . $editUser->last_name}}</span>
                        @else
                            Thêm User
                        @endif
                    </h2>
                </label>
                <span id="changeRoleSpan">
                    <button class="btn btn-primary" id="changePassButton">
                        <a href="{{url('me/password/')}}">
                            Change Role
                        </a>
                    </button>
                </span>
                <span id="changePassSpan2">
                    <button class="btn btn-primary" id="changePassButton">
                        <a href="{{url('me/password/')}}">
                            Thay đổi mật khẩu
                        </a>
                    </button>
                </span>
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
            <div class="form-group">
                <label for="exampleInputEmail1">Họ và tên đệm</label>
                <label class="star"> (*)</label>
                <input type="text" class="form-control" id="inputFisrtName" placeholder="First name" value=
                       "@if(isset($editUser)){{$editUser->first_name}}@endif"
                       maxlength="32" data-msg-required="Bạn phải nhập trường này!" required name="first_name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tên</label>
                <label class="star"> (*)</label>
                <input type="text" class="form-control" id="inputLastName" placeholder="Last name" value=
                       "@if(isset($editUser)){{$editUser->last_name}}@endif"
                       maxlength="32" data-msg-required="Bạn phải nhập trường này!" required name="last_name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Địa chỉ email</label>
                <input type="email" class="form-control" id="inputEmail1" placeholder="Email" value=
                    "@if(isset($editUser)){{$editUser->email}}@endif" name="email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Giới tính</label>
            </div>
            <div class="form-group">
                <input type="radio" class="radioGender" name="gender" id="male" value="1"
                    @if(isset($editUser) && ($editUser->gender == 1))
                        checked
                    @endif
                >
                <label class="radioLabel">Nam</label>
                <input type="radio" class="radioGender" name="gender" id="female" value="2"
                    @if(isset($editUser) && ($editUser->gender == 2))
                       checked
                    @endif
                >
                <label class="radioLabel">Nữ</label>
            </div>
            <div class="form-group">
                <label for="inputBirthday">Ngày sinh</label>
                <?php
                if (isset($editUser))
                    $date = (isset($_POST["datepicker"])) ? $_POST["datepicker"] : $editUser->birthday;
                else $date = (isset($_POST["datepicker"])) ? $_POST["datepicker"] : "";
                ?>
                <input class="form-control" readonly="readonly" id="datepicker" name="datepicker" placeholder="Birthday"
                       value="<?php echo $date; ?>">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Địa chỉ</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Enter address" value=
                    "@if(isset($editUser)){{$editUser->address}}@endif" name="address">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Avatar</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" id="exampleInputFile" name="avatar">
                    </div>
                </div>
            </div>
            <div class="form-group" id="endButtonsDiv">
                <button id="goBackButton" onclick="window.history.back()" class="btn btn-primary"><< Quay lại</button>
                <button type="submit" id="submitButton" class="btn btn-primary">Thay đổi</button>
            </div>
        </div>
        <!-- /.card-body -->

    </form>

@endsection
