<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Resources\UserCollection;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\DocBlock\Tags\See;
use Str;
use Session;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
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

    public function showProfile()
    {
        $this->authLogin();
        $user = Session::get('sUser');
        Session::put('sUser', $user);
        return view('users.screen02-profile')->with('user', $user);
    }

    public function updateProfile(Request $request, $userId)
    {
        $this->authLogin();
        $user = UserModel::find($userId);
        $data = $request->all();

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->gender = $data['gender'];

        $date = strtotime($data['datepicker']);
        $user->birthday = date('Y/m/d', $date);
        $user->address = $data['address'];

        $avatar = $request->file('avatar');
        if ($avatar) {
            $avatarName = $avatar->getClientOriginalName();
            $avatar->move('public/frontend/images/avatars', $avatarName);
            $data['avatar'] = $avatarName;
            $user->avatar = $data['avatar'];
        }

        $user->save();
        Session::put('sUser', $user);
        Session::put('message', 'Cập nhật thông tin thành công!');

        return redirect('me')->with('user', $user);
    }

    public function changePassword()
    {
        $this->authLogin();
        $user = Session::get('sUser');
        Session::put('sUser', $user);
        return view('users.screen03-my-pass')->with('user', $user);
    }

    public function updatePassword(Request $request, $userId)
    {
        $this->authLogin();
        $user = UserModel::find($userId);
        if (isset($user)) {
            if (isset($user->password)) {
                if ($user->password == md5($request->password)) {
                    $user->password = md5($request->new_password);
                    $user->save();
                    Session::put('message', 'Cập nhật mật khẩu thành công!');
                    Session::put('sUser', $user);
                    return redirect('me/password')->with('user', $user);
                }
            }
        }
        Session::put('message', 'Cập nhật mật khẩu không thành công!');
        return redirect('me/password')->with('user', Session::get('sUser'));
    }

    public function showUserList()
    {
        $this->authLogin();
        $user = Session::get('sUser');
        if ($this->isAdmin()) {
            $allUser = UserModel::all();
            return view('users.screen04-users')->with('user', $user)->with('allUser', $allUser);
        }
        return redirect('me')->with('user', Session::get('sUser'));
    }

    public function editUser($userId)
    {
        $this->authLogin();
        $user = Session::get('sUser');
        Session::put('sUser', $user);
        if ($this->isAdmin()) {
            $editUser = UserModel::find($userId);
            return view('users.screen05-add-edit-user')->with('editUser', $editUser)->with('user', $user);
        }
        return redirect('me')->with('user', Session::get('sUser'));
    }

    public function updateUser(Request $request, $userId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $user = UserModel::find($userId);
            $data = $request->all();

            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->gender = $data['gender'];

            $date = strtotime($data['datepicker']);
            $user->birthday = date('Y/m/d', $date);
            $user->address = $data['address'];

            $avatar = $request->file('avatar');
            if ($avatar) {
                $avatarName = $avatar->getClientOriginalName();
                $avatar->move('public/frontend/images/avatars', $avatarName);
                $data['avatar'] = $avatarName;
                $user->avatar = $data['avatar'];
            }

            $user->save();
            Session::put('sUser', $user);
            Session::put('message', 'Cập nhật thông tin thành công!');

            return redirect('users/' . $userId .'/edit')->with('user', $user);
        }
        return redirect('me')->with('user', Session::get('sUser'));
    }

    public function deleteUser($userId)
    {
        $this->authLogin();
        $user = Session::get('sUser');
        Session::put('sUser', $user);
        if ($this->isAdmin()) {
            $deleteUser = UserModel::find($userId);
            if (isset($deleteUser)) {
                $res = UserModel::destroy($userId);
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
            $allUser = UserModel::all();
            return view('users.screen04-users')->with('user', $user)->with('allUser', $allUser);
        }
        return redirect('me')->with('user', Session::get('sUser'));
    }

    public function addUser()
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $user = Session::get('sUser');
            Session::put('sUser', $user);
            return view('users.screen05-add-edit-user')->with('user', $user);
        }
        return redirect('me')->with('user', Session::get('sUser'));
    }

    public function saveUser(Request $request)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $data = $request->all();
            $date = strtotime($data['datepicker']);
            $password = Str::random(8) . 'A1';

            $user = new UserModel;
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->password = md5($password);
            $user->gender = $data['gender'];
            $user->birthday = date('Y/m/d', $date);
            $user->address = $data['address'];
            $user->avatar = '';

            $avatar = $request->file('avatar');
            if ($avatar) {
                $avatarName = $avatar->getClientOriginalName();
                $avatar->move('public/frontend/images/avatars', $avatarName);
                $data['avatar'] = $avatarName;
                $user['avatar'] = $data['avatar'];
            }

            $dataMail = [
                'last_name' => $user['last_name'],
                'password' => $password,
                'enter' => "\n"
            ];

            Mail::send('mail-content', $dataMail, function($message) use ($user)
            {
                $message->from('vinh.mt176912@gmail.com', 'Admin');
                $message->to($user['email'], 'User');
                $message->subject('Thư gửi mật khẩu trang quản lý thiết bị');
            });

            $user->save();
//            UserModel::saved($user);
            Session::put('message', 'Cập nhật thông tin thành công!');

            $getUser = UserModel::orderBy('id', 'desc')->first();
            return redirect('users/' . $getUser->id .'/edit')->with('user', Session::get('sUser'));
        }

        Session::put('message', 'Cập nhật thông tin không thành công!');
        return redirect('/me')->with('user', Session::get('sUser'));

    }

    public function changeUserPassword($userId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $editUser = UserModel::find($userId);
            $user = Session::get('sUser');
            Session::put('sUser', $user);
            if (isset($editUser)) {
                return view('users.screen07-change-pass')->with('user', $user)->with('editUser', $editUser);
            } else return redirect('me')->with('user', Session::get('sUser'));
        }
        return redirect('me')->with('user', Session::get('sUser'));
    }

    public function updateUserPassword(Request $request, $userId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $user = UserModel::find($userId);
            if (isset($user)) {
                $user->password = md5($request->new_password);
                $user->save();
                Session::put('message', 'Cập nhật mật khẩu thành công!');
                return redirect('users/' . $user->id . '/password')->with('user', Session::get('sUser'));
            }
            Session::put('message', 'Cập nhật mật khẩu không thành công!');
            return redirect('users/' . $user->id . '/password')->with('user', Session::get('sUser'));
        }
        return redirect('me')->with('user', Session::get('sUser'));
    }

    public function changeUserRole($userId)
    {
        $this->authLogin();
        if ($this->isAdmin()) {
            $editUser = UserModel::find($userId);
            $user = Session::get('sUser');
            Session::put('sUser', $user);
            if (isset($editUser)) {
                return view('users.screen08-change-role')->with('user', $user)->with('editUser', $editUser);
            } else return redirect('me')->with('user', Session::get('sUser'));
        }
        return redirect('me')->with('user', Session::get('sUser'));
    }

    public function updateUserRole(Request $request, $userId)
    {
        $this->authLogin();
        if($this->isAdmin()) {
            $user = UserModel::find($userId);
            if (isset($user)) {
                $user->role = $request->role;
                $user->save();
                Session::put('message', 'Cập nhật role thành công!');
                return redirect('users/' . $user->id . '/role')->with('user', Session::get('sUser'));
            }
            Session::put('message', 'Cập nhật role không thành công!');
            return redirect('users/' . $user->id . '/role')->with('user', Session::get('sUser'));
        }
        return redirect('me')->with('user', Session::get('sUser'));
    }



//    protected $userRepository;
//
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct(UserRepository $userRepository)
//    {
//        $this->userRepository = $userRepository;
//    }
//
//    public function index()
//    {
//        $users = $this->userRepository->getAll();
//        $users = new UserCollection($users);
//        return view('users.index', compact('users'));
//    }

}
