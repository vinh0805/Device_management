<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Redirect;
use Session;

class LoginController extends Controller
{
    public function authLogin()
    {
        if (Session::get('sUser')) {
            return redirect('me');
        } else {
            return redirect('login')->send();
        }
    }

    public function login()
    {
        return view('login');
    }

    public function loginConfirm(Request $request)
    {
//        $data = $request->all();
//        $request->email1;
//        $request->password;
        $this->authLogin();
        $user = UserModel::where('email', $request->email)->first();

        if (isset($user)) {
            if ($user->password == md5($request->password)) {
                Session::put('sUser', $user);
                return redirect('me');
            }
            else Session::put('message', 'Wrong account or password!!');
        }
        return redirect('/login');
    }

    public function logout()
    {
        $this->authLogin();
        Session::put('sUser', null);
        Session::put('message', null);
        return redirect('login');
    }

}
