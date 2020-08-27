<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceUser;
use App\Models\RequestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class RequestController extends Controller
{
    public function authLogin()
    {
        if (Session::get('sUser')) {
            return redirect('me');
        } else {
            return redirect('login')->send();
        }
    }

    public function isAdmin()
    {
        $this->authLogin();
        $user = Session::get('sUser');
        if (isset($user->role)) {
            if ($user->role == 1)
                return 1;
        }
        return 0;
    }

    public function showMyRequestsList()
    {
        $this->authLogin();
        $allMyRequests = DB::table('requests')
            ->leftJoin('device_users', 'device_users.request_id', '=', 'requests.id')
            ->leftJoin('users', 'users.id', '=', 'requests.leader_id')
            ->where('requests.user_id', '=', Session::get('sUser')->id)
            ->select('requests.*', 'device_users.handover_at', 'device_users.released_at', 'users.first_name',
                'users.last_name', 'users.email')->get();
        return view('requests.screen13-my-requests')->with('allMyRequests', $allMyRequests);
    }

    public function showRequestInfo($requestId)
    {
        $this->authLogin();
        $requestInfo = DB::table('device_users')
            ->join('devices', 'devices.id', '=', 'device_users.device_id')
            ->where('request_id', '=', $requestId)->first();
        return response()->json($requestInfo);
    }

    public function showRequestsList()
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $inStockDevices = Device::where('status', 1)->get();
            $allRequestOfUsers = DB::table('requests')
                ->leftJoin('device_users', 'device_users.request_id', '=', 'requests.id')
                ->leftJoin('users as user_table', 'user_table.id', '=', 'requests.user_id')
                ->leftJoin('users as leader_table', 'leader_table.id', '=', 'requests.leader_id')
                ->select('requests.*', 'device_users.handover_at', 'device_users.released_at',
                    'user_table.first_name as user_first_name', 'user_table.last_name as user_last_name',
                    'user_table.email as user_email', 'leader_table.first_name as leader_first_name',
                    'leader_table.last_name as leader_last_name', 'leader_table.email as leader_email')->get();

            return view('requests.screen14-requests-of-users')->with('allRequestOfUsers', $allRequestOfUsers)
                ->with('inStockDevices', $inStockDevices);
        } else return redirect('me');
    }

    public function deleteRequest($requestId)
    {
        $this->authLogin();
        $deleteRequest = RequestModel::find($requestId);
        if (isset($deleteRequest)) {
            $res = RequestModel::destroy($requestId);
            if ($res) {
                response()->json([
                    'status' => '1',
                    'msg' => 'success'
                ]);
            } else {
                response()->json([
                    'status' => '0',
                    'msg' => 'fail'
                ]);
            }
        }
        return redirect('/requests/me');
    }

    public function deleteMyRequest($requestId)
    {
        $this->authLogin();
        $this->deleteRequest($requestId);
        return redirect('/requests/me');
    }

    public function deleteUserRequest($requestId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $this->deleteRequest($requestId);
            return redirect('/requests/lists');
        } else return redirect('me');
    }

    public function approveRequest(Request $req, $requestId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $data = $req->all();
            $request = RequestModel::find($requestId);
            if (isset($request)) {
                // Edit requests table
                $request->status = 2;
                $request->approved_at = date('Y-m-d');
                $request->leader_id = Session::get('sUser')->id;
                // Create new record at device_user table
                $deviceUser = new DeviceUser();
                $deviceUser->user_id = $request->user_id;
                $deviceUser->device_id = $data['assignedDevice'];
                $deviceUser->request_id = $requestId;
                $deviceUser->handover_at = $data['handoverDay'];
                // Edit at devices table
                $device = Device::find($data['assignedDevice']);
                $device->status = 2;
                $request->save();
                $deviceUser->save();
                $device->save();
            }
            return redirect('/requests/lists');
        } else return redirect('me');
    }

    public function rejectRequest($requestId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $request = RequestModel::find($requestId);
            if (isset($request)) {
                $request->status = 3;
                $request->leader_id = Session::get('sUser')->id;
                $request->save();
            }
            return redirect('/requests/lists');
        } else return redirect('me');
    }

    public function addRequest()
    {
        $this->authLogin();
        return view('requests.screen15-add-edit-request')->with('user', Session::get('sUser'));
    }

    public function saveRequest(Request $req)
    {
        $this->authLogin();
        $request = new RequestModel();
        $request->user_id = Session::get('sUser')->id;
        $request->reason = $req->reasonOfRequest;
        $request->status = 1;
        $request->save();
        Session::put('message', 'Cập nhật thông tin thành công!');
        $getRequest = RequestModel::orderBy('id', 'desc')->first();
        return redirect('/requests/' . $getRequest->id . '/edit');
    }

    public function editRequest($requestId)
    {
        $this->authLogin();
        $editRequest = RequestModel::find($requestId);
        if (isset($editRequest)) {
            return view('requests.screen15-add-edit-request')->with('user', Session::get('sUser'))
                ->with('editRequest', $editRequest);
        } else return redirect('me');
    }

    public function updateRequest(Request $req, $requestId)
    {
        $this->authLogin();
        $request = RequestModel::find($requestId);
        $request->user_id = Session::get('sUser')->id;
        $request->reason = $req->reasonOfRequest;
        $request->status = 1;
        $request->save();
        Session::put('message', 'Cập nhật thông tin thành công!');
        $getRequest = RequestModel::orderBy('id', 'desc')->first();
        return redirect('/requests/' . $getRequest->id . '/edit');
    }
}
