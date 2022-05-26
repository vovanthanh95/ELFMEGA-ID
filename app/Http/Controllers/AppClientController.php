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
        if ($info != null) {
            return redirect()->route('app-login')->with($info);
        }
        if (Auth::guard('client')->check()) {
            return Auth::guard('client')->user()->username;
        }
    }

    public function register()
    {
        return view('appclient.register');
    }

    public function postRegister(Request $request)
    {
        $rule = [
            'username' => 'required|max:16|min:6|unique:Account,username|regex:/^[a-zA-Z0-9_]+$/i',
            'password' => 'required',
            'email' => 'required|email|unique:Account,email',
            'phone' => 'required|digits_between:10,11|unique:Account,phone|numeric',
            'captcha' => 'required|captcha',
        ];
        $message = [
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.regex' => 'Tên đăng nhập không đúng định dạng',
            'username.min' => 'Tên đăng nhập phải lớn hơn 6 kí tự',
            'username.max' => 'Tên đăng nhập phải nhỏ hơn 16 kí tự',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'password.required' => 'Mật khẩu không được trống',
            'email.required' => 'Email không được trống',
            'email.email' => 'Email không đúng',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Số điện thoại không được trống',
            'phone.digits_between' => 'Số điện thoại không hợp lệ',
            'phone.unique' => 'Số điện thoại đã được sử dụng',
            'phone.numeric' => 'Số điện thoại không hợp lệ',
            'captcha.required' => 'Captcha không được trống',
            'captcha.captcha' => 'Captcha không đúng',

        ];
        $request->validate($rule, $message);
        $account = new Account();
        $info = $account->createAccount($request->username, $request->password, $request->email, $request->phone, $this->getinfo->getIP());
        dd(json_encode($info));
        return json_encode($info);
    }
}
