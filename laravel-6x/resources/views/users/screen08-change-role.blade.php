@extends('layout')
@section('content')

    <h1>Screen 08</h1>
    <form role="form" method="post" id="changePasswordForm" action="{{url('/users/' . $editUser->id . '/role/update')}}"
          enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="card-body">
            <div class="form-group" id="formHeader">
                <label><h2>Change Role: <span id="nameInfoH2">{{$editUser->first_name . ' ' . $editUser->last_name}}</span></h2></label>
            </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Role</label>
                <label class="star"> (*)</label>
            </div>
            <div class="form-group">
                <input type="radio" class="radioRole" name="role" id="admin" value="1"
                       @if($editUser->role == 1)
                       checked
                    @endif
                >
                <label class="radioLabel">Admin</label>
                <input type="radio" class="radioRole" name="role" id="user" value="2"
                       @if($editUser->role == 2)
                       checked
                    @endif
                >
                <label class="radioLabel">User</label>
            </div>

            <div class="form-group">
                <?php
                $message = Session::get('message');
                if($message == 'Cập nhật role thành công!') {
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
