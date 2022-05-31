<?php

namespace App\Http\Controllers;

use App\Classes\GetInfo;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppClientController extends Controller
{
    public $getinfo;
    public function __construct()
    {
        $this->getinfo = new GetInfo();
    }
    public function login()
    {
        return view('appclient.login');
    }

    public function postLogin(Request $request)
    {
        $account = new Account();
        $info = $account->login($request->username, $request->password);
        $data = [];
        $user = [];
        if ($info != null) {
            return redirect()->route('app-login')->with($info);
        }
        if (Auth::guard('client')->check()) {
            $user['id'] = Auth::guard('client')->user()->username;
            $data['code'] = '200';
            $data['data'] = $user;
            $data['msg'] = 'Đăng kí thành công';
            $data['type'] = 'succes';
            $data['failed'] = 'false';
            $data['token'] = Auth::guard('client')->user()->username;
            //dd(json_encode($data));
            return json_encode($data);
        }
    }

    public function register()
    {
        return view('appclient.register');
    }

    public function postRegister(Request $request)
    {
        $rule = [
            'username' => 'required|max:16|min:6|unique:account,username|regex:/^[a-zA-Z0-9_]+$/i',
            'password' => 'required|max:32|min:6|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,32}$/i',
            'captcha' => 'required|captcha',
        ];
        $message = [
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.regex' => 'Tên đăng nhập không đúng định dạng',
            'username.min' => 'Tên đăng nhập phải lớn hơn 6 kí tự',
            'username.max' => 'Tên đăng nhập phải nhỏ hơn 16 kí tự',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'password.required' => 'Mật khẩu không được trống',
            'password.max' => 'Mật khẩu không được lớn hown32 kí tự',
            'password.min' => 'Mật khẩu không được nhỏ hơn 6 kí tự',
            'password.regex' => 'Mật khẩu phải có chứa cả chữ và số',
            'captcha.required' => 'Captcha không được trống',
            'captcha.captcha' => 'Captcha không đúng',

        ];
        $request->validate($rule, $message);
        $account = new Account();
        $data = [];
        $user = [];
        $info = $account->createAccount($request->username, $request->password, $this->getinfo->getIP());
        if($info != ""){
            $user['id'] = $request->username;
            $data['code'] = '200';
            $data['data'] = $user;
            $data['msg'] = 'Đăng kí thành công';
            $data['type'] = 'succes';
            $data['failed'] = 'false';
            $data['token'] = $request->username;
        }

        return json_encode($data);
    }
}
