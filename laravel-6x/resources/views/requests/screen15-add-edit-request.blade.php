@extends('layout')
@section('content')
    <h1>Screen 15</h1>
    <form role="form" method="post" id="AddEditRequestForm" action="@if(isset($editRequest)){{url('requests/' . $editRequest->id . '/update/')}}
    @else{{url('requests/save')}}@endif" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="card-body">
            <div class="form-group"><p></p></div>
            <div class="form-group" id="formHeader">
                <h2>@if(isset($editRequest))Sửa yêu cầu <span id="nameInfoH2">{{$editRequest->id}}</span>
                    @else Thêm yêu cầu
                    @endif
                </h2>
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
                <label for="exampleInputEmail1">Lý do</label>
                <label class="star"> (*)</label>
            </div>
            <div>
                <p><label id="reasonOfRequest-error" class="error" for="reasonOfRequest"></label></p>
                <label for="reasonOfRequest"></label>
                <textarea id="reasonOfRequest" rows="8" cols="50" name="reasonOfRequest"
                >@if(isset($editRequest)){{$editRequest->reason}}@endif</textarea>
            </div>
            <div class="form-group" id="endButtonsDiv">
                <button id="goBackButton" onclick="window.history.back()" class="btn btn-primary"><< Quay lại</button>
                <button type="submit" id="submitButton" class="btn btn-primary">Lưu</button>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
@endsection
