@extends('layout')
@section('content')

    <h1>Screen 11</h1>
    <form role="form" method="post" id="editDeviceForm" action="@if(isset($editDevice)){{url('devices/' . $editDevice->id . '/update/')}}
        @else{{url('devices/save')}}@endif" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="card-body">
            <div class="form-group" id="formHeader">
                <label>
                    <h2 id="formHeader">
                        @if(isset($editDevice))
                            Thay đổi thông tin thiết bị <span id="nameInfoH2">{{$editDevice->name}}</span>
                        @else
                            Thêm thiết bị
                        @endif
                    </h2>
                </label>
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
                <label for="exampleInputEmail1">Danh mục</label>
                <label class="star"> (*)</label>
                <label for="deviceCategory"></label>
                <select class="form-control" id="deviceCategory" name="deviceCategory">
                    <option value="1" @if(isset($editDevice) && $editDevice->category == 1)selected @endif>1-Screen</option>
                    <option value="2" @if(isset($editDevice) && $editDevice->category == 2)selected @endif>2-Mouse</option>
                    <option value="3" @if(isset($editDevice) && $editDevice->category == 3)selected @endif>3-Keyboard</option>
                    <option value="4" @if(isset($editDevice) && $editDevice->category == 4)selected @endif>4-Case</option>
                    <option value="5" @if(isset($editDevice) && $editDevice->category == 5)selected @endif>5-Phone</option>
                    <option value="6" @if(isset($editDevice) && $editDevice->category == 6)selected @endif>6-Laptop</option>
                    <option value="7" @if(isset($editDevice) && $editDevice->category == 7)selected @endif>7-Chair</option>
                    <option value="8" @if(isset($editDevice) && $editDevice->category == 8)selected @endif>8-Table</option>
                    <option value="9" @if(isset($editDevice) && $editDevice->category == 9)selected @endif>9-Hash disk</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tên sản phẩm</label>
                <label class="star"> (*)</label>
                <label for="deviceName"></label>
                <input type="text" class="form-control" id="deviceName" placeholder="Name" value=
                "@if(isset($editDevice)){{$editDevice->name}}@endif"
                       maxlength="32" data-msg-required="Bạn phải nhập trường này!" required name="deviceName">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Giá</label>
                <label for="devicePrice"></label>
                <input type="text" class="form-control" id="devicePrice" placeholder="Price" value=
                "@if(isset($editDevice)){{$editDevice->price}}@endif" name="devicePrice">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mô tả</label>
                <label for="deviceDescription"></label>
                <textarea type="text" class="form-control" rows="6" id="deviceDescription"
                          name="deviceDescription">@if(isset($editDevice)){{$editDevice->description}}@endif</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Trạng thái</label>
                <label class="star"> (*)</label>
                <label for="deviceStatus"></label>
                <select class="form-control" id="deviceStatus" name="deviceStatus">
                    <option value="1" @if(isset($editDevice) && $editDevice->status == 1)selected @endif>1-Trong kho</option>
                    <option value="2" @if(isset($editDevice) && $editDevice->status == 2)selected @endif>2-Đang sử dụng</option>
                    <option value="3" @if(isset($editDevice) && $editDevice->status == 3)selected @endif>3-Thanh lý</option>
                </select>
            </div>
            <div class="form-group" id="endButtonsDiv">
                <button type="button" id="goBackButton" onclick="window.history.back()" class="btn btn-primary"><< Quay lại</button>
                <button type="submit" id="submitButton" class="btn btn-primary">Thay đổi</button>
            </div>
        </div>
        <!-- /.card-body -->
    </form>

@endsection
