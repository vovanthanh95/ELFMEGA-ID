<?php

namespace App\Http\Controllers;

use App\Classes\GetInfo;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientAuthController extends Controller
{
    public $getinfo;
    public function __construct()
    {
        $this->getinfo = new GetInfo();
    }
    public function login()
    {
        return view('clients.login2');
    }

    public function postLogin(Request $request)
    {
        $account = new Account();
        if ($request->serverid < 0 || !is_numeric($request->serverid)) {
            return redirect()->route('login')->with(['msg' => 'Chưa chọn server', 'type' => 'error']);
        }
        $info = $account->login($request->username, $request->password);
        if ($info != null) {
            return redirect()->route('login')->with($info);
        }
        if (Auth::guard('client')->check()) {
            $zonename = config('custom.zonelist')[$request->serverid];
            session()->put('servername', $zonename);
            session()->put('serverid', $request->serverid);
            return redirect()->route('account');
        }
    }

    public function logout()
    {
        Auth::guard('client')->logout();
        return redirect()->route('login');
    }

    public function register()
    {
        return view('clients.register2');
    }

    public function postRegister(Request $request)
    {
        $rule = [
            'username' => 'required|max:16|min:6|unique:account,username|regex:/^[a-zA-Z0-9_]+$/i',
            'password' => 'required|max:32|min:6|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,32}$/i',
            'email' => 'required|email|unique:account,email',
            'phone' => 'required|digits_between:10,11|unique:account,phone|numeric',
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
        $info = $account->createAccount($request->username, $request->password, $this->getinfo->getIP(), $request->email, $request->phone);

        return redirect()->route('login')->with($info);
    }
}
