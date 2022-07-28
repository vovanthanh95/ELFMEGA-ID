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
        return view('clients.forgotpass');
    }

    public function postForgotPass(Request $request)
    {
        $rule = [
            'username' => 'required',
            'email' => 'required|email',
            'captcha' => 'required|captcha',
        ];
        $message = [
            'username.required' => trans('message.alertusernotfree'),
            'email.required' => trans('message.alertemailnotfree'),
            'email.email' => trans('message.alertemailnottrue'),
            'captcha.required' => trans('message.alertcaptchanotfree'),
            'captcha.captcha' => trans('message.alertcaptchanottrue'),
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

        return view('clients.changepass')->with($this->getinfo->getDataUser());
    }

    public function postChangePass(Request $request)
    {
        $rule = [
            'currentpassword' => 'required',
            'newpassword' => 'required|different:currentpassword',
            'confirmpassword' => 'required|same:newpassword',
        ];
        $message = [
            'currentpassword.required' => trans('message.alertpassnotfree'),
            'newpassword.required' => trans('message.alertpassnewnotfree'),
            'newpassword.different' => trans('message.alertpassnotsameold'),
            'confirmpassword.required' => trans('message.alertpleaseconfirmpass'),
            'confirmpassword.same' => trans('message.alertpassconfirmnotsame'),
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
            //'currentphone' => 'required|digits_between:10,11|numeric',
            'currentemail' => 'required|email',
            'newemail' => 'required|email|unique:account,email',
        ];
        $message = [
            //'currentphone.required' => 'Số điện thoại không được trống',
            //'currentphone.digits_between' => 'Số điện thoại không hợp lệ',
            //'currentphone.numeric' => 'Số điện thoại không hợp lệ',
            'currentemail.required' => 'Email không được trống',
            'currentemail.email' => 'Email không đúng định dạng',
            'newemail.required' => 'Email không được trống',
            'newemail.email' => 'Email không đúng định dạng',
            'newemail.unique' => 'Email đã tồn tại',

        ];
        $request->validate($rule, $message);
        $user = new Account();
        $info = $user->changeEmail($request->currentemail, $request->newemail, $this->getinfo->getIP());
        return redirect()->route('change-email')->with($info);
    }

    public function changePhone()
    {
        return view('clients.changephone')->with($this->getinfo->getDataUser());
    }

    public function postChangePhone(Request $request)
    {
        $rule = [
            //'currentemail' => 'required|email',
            'currentphone' => 'required|digits_between:10,11|numeric',
            'newphone' => 'required|digits_between:10,11|unique:account,phone|numeric',
        ];
        $message = [
            //'currentemail.required' => 'Email không được trống',
            //'currentemail.email' => 'Email không đúng định dạng',
            'currentphone.required' => 'Số điện thoại không được trống',
            'currentphone.digits_between' => 'Số điện thoại không hợp lệ',
            'currentphone.numeric' => 'Số điện thoại không hợp lệ',
            'newphone.required' => 'Số điện thoại không được trống',
            'newphone.unique' => 'Số điện thoại đã được sử dụng',
            'newphone.numeric' => 'Số điện thoại không hợp lệ',

        ];
        $request->validate($rule, $message);
        $user = new Account();
        $info = $user->changePhone($request->currentphone, $request->newphone, $this->getinfo->getIP());
        return redirect()->route('change-phone')->with($info);
    }

    public function updateAccount(){
        return view('clients.updateaccount')->with($this->getinfo->getDataUser());
    }

    public function updateEmail(){
        return view('clients.updateemail')->with($this->getinfo->getDataUser());
    }

    public function postUpdateEmail(Request $request){
        $rule = [
            'email' => 'required|email|unique:account,email',
        ];
        $message = [
            'email.required' => trans('message.alertemailnotfree'),
            'email.email' => trans('message.alertemailnottrue'),
            'email.unique' => trans('message.alertemailisexist'),
        ];
        $request->validate($rule, $message);
        $user = new Account();
        $info = $user->updateEmail($request->email, $this->getinfo->getIP());
        return redirect()->route('account')->with($info);
    }

    public function updatePhone(){
        return view('clients.updatephone')->with($this->getinfo->getDataUser());
    }
    public function postUpdatePhone(Request $request){
        $rule = [
            'phone' => 'required|digits_between:10,11|numeric|unique:account,phone',
        ];
        $message = [
            'phone.required' => trans('message.alertphonenotfree'),
            'phone.digits_between' => trans('message.alertphonenotformat'),
            'phone.numeric' => trans('message.alertphonenotformat'),
            'phone.unique' => trans('message.alertphoneisexist'),
        ];
        $request->validate($rule, $message);
        $user = new Account();
        $info = $user->updatePhone($request->phone, $this->getinfo->getIP());
        return redirect()->route('account')->with($info);
    }
}
