<?php

namespace App\Http\Controllers;

use App\Classes\GetInfo;
use App\Models\Account;
use Illuminate\Http\Request;

class ClientChangeController extends Controller
{
    public $getinfo;
    public function __construct()
    {
        $this->getinfo = new GetInfo();
    }

    public function forgotPass()
    {
        return view('clients.forgotpass2');
    }

    public function postForgotPass(Request $request)
    {
        $rule = [
            'username' => 'required',
            'email' => 'required|email',
            'captcha' => 'required|captcha',
        ];
        $message = [
            'username.required' => 'Tên đăng nhập không được trống',
            'email.required' => 'Email không được trống',
            'email.email' => 'Email không đúng',
            'captcha.required' => 'Captcha không được trống',
            'captcha.captcha' => 'Captcha chưa đúng',
        ];
        $request->validate($rule, $message);
        $user = new Account();
        $info = $user->forgotPass($request->username, $request->email, $this->getinfo->getIP());
        if ($info['type'] == 'error') {
            return redirect()->back()->with($info);
        }
        return redirect()->route('login')->with($info);
    }

    public function changePass()
    {

        return view('clients.changepass2')->with($this->getinfo->getDataUser());
    }

    public function postChangePass(Request $request)
    {
        $rule = [
            'currentpassword' => 'required',
            'newpassword' => 'required|different:currentpassword',
            'confirmpassword' => 'required|same:newpassword',
        ];
        $message = [
            'currentpassword.required' => 'Mật khẩu không được trống',
            'newpassword.required' => 'Mật khẩu không được trống',
            'newpassword.different' => 'Không được trùng mật khẩu củ',
            'confirmpassword.required' => 'Vui lòng xác nhận mật khẩu',
            'confirmpassword.same' => 'Mật khẩu xác nhận không khớp',
        ];
        $request->validate($rule, $message);
        $user = new Account();
        $info = $user->changePassWord($request->currentpassword, $request->newpassword, $this->getinfo->getIP());
        return redirect()->route('change-pass')->with($info);
    }

    public function changeEmail()
    {
        return view('clients.changeemail2')->with($this->getinfo->getDataUser());
    }

    public function postChangeEmail(Request $request)
    {
        $rule = [
            'currentphone' => 'required|digits_between:10,11|numeric',
            'currentemail' => 'required|email',
            'newemail' => 'required|email|unique:Account,email',
        ];
        $message = [
            'currentphone.required' => 'Số điện thoại không được trống',
            'currentphone.digits_between' => 'Số điện thoại không hợp lệ',
            'currentphone.numeric' => 'Số điện thoại không hợp lệ',
            'currentemail.required' => 'Email không được trống',
            'currentemail.email' => 'Email không đúng định dạng',
            'newemail.required' => 'Email không được trống',
            'newemail.email' => 'Email không đúng định dạng',
            'newemail.unique' => 'Email đã tồn tại',

        ];
        $request->validate($rule, $message);
        $user = new Account();
        $info = $user->changeEmail($request->currentemail, $request->currentphone, $request->newemail, $this->getinfo->getIP());
        return redirect()->route('change-email')->with($info);
    }

    public function changePhone()
    {
        return view('clients.changephone2')->with($this->getinfo->getDataUser());
    }

    public function postChangePhone(Request $request)
    {
        $rule = [
            'currentemail' => 'required|email',
            'currentphone' => 'required|digits_between:10,11|numeric',
            'newphone' => 'required|digits_between:10,11|unique:Account,phone|numeric',
        ];
        $message = [
            'currentemail.required' => 'Email không được trống',
            'currentemail.email' => 'Email không đúng định dạng',
            'currentphone.required' => 'Số điện thoại không được trống',
            'currentphone.digits_between' => 'Số điện thoại không hợp lệ',
            'currentphone.numeric' => 'Số điện thoại không hợp lệ',
            'newphone.required' => 'Số điện thoại không được trống',
            'newphone.unique' => 'Số điện thoại đã được sử dụng',
            'newphone.numeric' => 'Số điện thoại không hợp lệ',

        ];
        $request->validate($rule, $message);
        $user = new Account();
        $info = $user->changePhone($request->currentemail, $request->currentphone, $request->newphone, $this->getinfo->getIP());
        return redirect()->route('change-phone')->with($info);
    }

    public function updateAccount(){
        return view('clients.updateaccount')->with($this->getinfo->getDataUser());
    }
}
