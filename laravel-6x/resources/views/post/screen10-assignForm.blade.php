@extends('devices.screen10-devices')
@section('popupContent')

    <section>
        <div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{$post->id}}: {{$post->name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" onsubmit="add(event)" id="assignForm">
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
                                <button type="Submit" class="btn btn-primary" id="saveButton">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
