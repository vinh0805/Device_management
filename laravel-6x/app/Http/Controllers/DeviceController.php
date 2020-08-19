<?php

namespace App\Http\Controllers;

use App\Models\DeviceUser;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Resources\UserCollection;
use App\Models\UserModel;
use App\Models\Device;
use App\Models\RequestModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
//use phpDocumentor\Reflection\DocBlock\Tags\See;
use Str;
use Session;
use Response;

class DeviceController extends Controller
{
private $screenQty = 0;
private $mouseQty = 0;
private $keyboardQty = 0;
private $caseQty = 0;
private $phoneQty = 0;
private $laptopQty = 0;
private $chairQty = 0;
private $tableQty = 0;
private $hardDiskQty = 0;

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

    public function showMyDevicesList()
    {
        $this->authLogin();

        $user = Session::get('sUser');
        $allDevices = DB::table('devices')
            ->join('device_users', 'devices.id', '=', 'device_users.device_id')
            ->where('user_id', $user->id)->where('status', '=', 2)->get();
        return view('devices/screen09-my-devices')->with('allDevices', $allDevices)->with('user', $user);
    }

    public function showDevicesList()
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $allDevices = Device::all();
            $allUsers = UserModel::all();
            $allRequests = RequestModel::all();
            return view('devices.screen10-devices')->with('allDevices', $allDevices)->with('user', Session::get('sUser'))
                ->with('allUsers', $allUsers)->with('allRequests', $allRequests);
        }
        return redirect('me')->with('user', Session::get('sUser'));
    }

    public function addDevice()
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            return view('devices.screen11-add-device')->with('user', Session::get('sUser'));
        }
        return $this->showDevicesList();
    }

    public function getQuantity($category)
    {
        switch ($category) {
            case 1:
                $codeData = Device::select('code', 'category')->where('category', 1)->orderBy('code', 'desc')->first();
                if (isset($codeData))
                    $n = ltrim(substr($codeData->code, -4), '0');
                else $n = 0;
                return (int) "$n" + 1;
            case 2:
                $codeData = Device::select('code', 'category')->where('category', 2)->orderBy('code', 'desc')->first();
                if (isset($codeData))
                    $n = ltrim(substr($codeData->code, -4), '0');
                else $n = 0;
                return (int) "$n" + 1;
            case 3:
                $codeData = Device::select('code', 'category')->where('category', 3)->orderBy('code', 'desc')->first();
                if (isset($codeData))
                    $n = ltrim(substr($codeData->code, -4), '0');
                else $n = 0;
                return (int) "$n" + 1;
            case 4:
                $codeData = Device::select('code', 'category')->where('category', 4)->orderBy('code', 'desc')->first();
                if (isset($codeData))
                    $n = ltrim(substr($codeData->code, -4), '0');
                else $n = 0;
                return (int) "$n" + 1;
            case 5:
                $codeData = Device::select('code', 'category')->where('category', 5)->orderBy('code', 'desc')->first();
                if (isset($codeData))
                    $n = ltrim(substr($codeData->code, -4), '0');
                else $n = 0;
                return (int) "$n" + 1;
            case 6:
                $codeData = Device::select('code', 'category')->where('category', 6)->orderBy('code', 'desc')->first();
                if (isset($codeData))
                    $n = ltrim(substr($codeData->code, -4), '0');
                else $n = 0;
                return (int) "$n" + 1;
            case 7:
                $codeData = Device::select('code', 'category')->where('category', 7)->orderBy('code', 'desc')->first();
                if (isset($codeData))
                    $n = ltrim(substr($codeData->code, -4), '0');
                else $n = 0;
                return (int) "$n" + 1;
            case 8:
                $codeData = Device::select('code', 'category')->where('category', 8)->orderBy('code', 'desc')->first();
                if (isset($codeData))
                    $n = ltrim(substr($codeData->code, -4), '0');
                else $n = 0;
                return (int) "$n" + 1;
            case 9:
                $codeData = Device::select('code', 'category')->where('category', 9)->orderBy('code', 'desc')->first();
                if (isset($codeData))
                    $n = ltrim(substr($codeData->code, -4), '0');
                else $n = 0;
                return (int) "$n" + 1;
            default: break;
        }
    }

    public function saveDevice(Request $request)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $data = $request->all();
            $device = new Device;
            $device->category = $data['deviceCategory'];
            $device->name = $data['deviceName'];
            $device->price = $data['devicePrice'];
            $device->description = $data['deviceDescription'];
            $device->status = $data['deviceStatus'];

            switch ($device->category) {
                case 1:
                    $code = 'MH';
                    $code .= sprintf('%04d', $this->getQuantity($device->category));
                    break;
                case 2: $code = 'CH';
                    $code .= sprintf('%04d', $this->getQuantity($device->category));
                    break;
                case 3: $code = 'BP';
                    $code .= sprintf('%04d', $this->getQuantity($device->category));
                    break;
                case 4: $code = 'C';
                    $code .= sprintf('%04d', $this->getQuantity($device->category));
                    break;
                case 5: $code = 'DT';
                    $code .= sprintf('%04d', $this->getQuantity($device->category));
                    break;
                case 6: $code = 'LT';
                    $code .= sprintf('%04d', $this->getQuantity($device->category));
                    break;
                case 7: $code = 'G';
                    $code .= sprintf('%04d', $this->getQuantity($device->category));
                    break;
                case 8: $code = 'B';
                    $code .= sprintf('%04d', $this->getQuantity($device->category));
                    break;
                case 9: $code = 'OC';
                    $code .= sprintf('%04d', $this->getQuantity($device->category));
                    break;
                default: break;
            }
            $device->code = $code;
            $device->save();
            Session::put('message', 'Cập nhật thông tin thành công!');

            $getDevice = Device::orderBy('id', 'desc')->first();
            return redirect('devices/' . $getDevice->id . '/edit')->with('user', Session::get('sUser'));
        }
        return $this->showDevicesList();
    }

    public function editDevice($deviceId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $editDevice = Device::find($deviceId);
            if (isset($editDevice))
                return view('devices.screen11-add-device')->with('user', Session::get('sUser'))
                    ->with('editDevice', $editDevice);
        }
        return $this->showDevicesList();
    }

    public function updateDevice(Request $request, $deviceId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $data = $request->all();
            $device = Device::find($deviceId);
            if (isset($device)) {
                $device->category = $data['deviceCategory'];
                $device->name = $data['deviceName'];
                $device->price = $data['devicePrice'];
                $device->description = $data['deviceDescription'];
                $device->status = $data['deviceStatus'];

                switch ($device->category) {
                    case 1:
                        $code = 'MH';
                        $code .= sprintf('%04d', $this->getQuantity($device->category));
                        break;
                    case 2:
                        $code = 'CH';
                        $code .= sprintf('%04d', $this->getQuantity($device->category));
                        break;
                    case 3:
                        $code = 'BP';
                        $code .= sprintf('%04d', $this->getQuantity($device->category));
                        break;
                    case 4:
                        $code = 'C';
                        $code .= sprintf('%04d', $this->getQuantity($device->category));
                        break;
                    case 5:
                        $code = 'DT';
                        $code .= sprintf('%04d', $this->getQuantity($device->category));
                        break;
                    case 6:
                        $code = 'LT';
                        $code .= sprintf('%04d', $this->getQuantity($device->category));
                        break;
                    case 7:
                        $code = 'G';
                        $code .= sprintf('%04d', $this->getQuantity($device->category));
                        break;
                    case 8:
                        $code = 'B';
                        $code .= sprintf('%04d', $this->getQuantity($device->category));
                        break;
                    case 9:
                        $code = 'OC';
                        $code .= sprintf('%04d', $this->getQuantity($device->category));
                        break;
                    default:
                        break;
                }
                $device->code = $code;
                echo '<pre>';
                echo print_r($device);
                echo '</pre>';
                $device->save();
                Session::put('message', 'Cập nhật thông tin thành công!');

                $getDevice = Device::orderBy('id', 'desc')->first();
                return redirect('devices/' . $getDevice->id . '/edit')->with('user', Session::get('sUser'));
            }
            Session::put('message', 'Cập nhật thông tin không thành công!');
        }
        return $this->showDevicesList();
    }

    public function deleteDevice($deviceId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $deleteDevice = Device::find($deviceId);
            if (isset($deleteDevice)) {
                $res = Device::destroy($deviceId);
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
            $allDevices = Device::all();
            return redirect('/devices/lists')->with('user', Session::get('sUser'))->with('allDevices', $allDevices);
        }
        return redirect('me')->with('user', Session::get('sUser'));
    }

    public function showDevicesListUsers()
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $allDevicesOfUsers = DB::table('device_users')
                ->join('devices', 'devices.id', '=', 'device_users.device_id')
                ->join('users', 'users.id', '=', 'device_users.user_id')
                ->select('device_users.*', 'users.first_name', 'users.last_name', 'devices.category', 'devices.code', 'devices.name')
                ->get();
            return view('devices.screen12-devices-of-users')->with('allDevicesOfUsers', $allDevicesOfUsers)
                ->with('user', Session::get('sUser'));
        }
        return redirect('me')->with('user', Session::get('sUser'));
    }

    // Popup screen 10
    public function assignToUser(Request $request)
    {
        $data = $request->all();
        echo '<pre>';
        echo print_r($data);
        echo '</pre>';
        return redirect('me')->with('user', Session::get('sUser'));
    }

    public function showHistory(Request $request, $deviceUserId)
    {
        $deviceUser = DeviceUser::find($deviceUserId);
        return response()->json($deviceUser);
    }

}
