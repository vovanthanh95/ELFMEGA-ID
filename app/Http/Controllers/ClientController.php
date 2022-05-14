<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    public function index()
    {
        return view('clients.account')->with($this->getDataUser());
    }

    public function login()
    {
        return view('clients.login');
    }

    public function postLogin(Request $request)
    {
        $account = new Account();
        if ($request->serverid < 0 || !is_numeric($request->serverid)) {
            return redirect()->route('login')->with(['msg'=>'Chưa chọn server','type'=>'error']);
        }
        $info = $account->login($request->username, $request->password);
        if ($info != null) {
            return redirect()->route('login')->with($info);
        }
        if (Auth::guard('client')->check()) {
            $zonename = config('custom.zonelist')[$request->serverid];
            session()->put('serverid', $zonename);
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
        return view('clients.register');
    }

    public function postRegister(Request $request)
    {
        $rule = [
            'username' => 'required|max:16|min:6|unique:Account,username',
            'password' => 'required',
            'email' => 'required|email|unique:Account,email',
            'phone' => 'required|digits_between:10,11|unique:Account,phone',
            'captcha' => 'required|captcha',
        ];
        $message = [
            'username.required' => 'Vui lòng nhập tên đăng nhập',
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
            'captcha.required' => 'Captcha không được trống',
            'captcha.captcha' => 'Captcha không đúng',

        ];
        $request->validate($rule, $message);
        $account = new Account();
        $account->createAccount($request->username, $request->password, $request->email, $request->password, $this->getIP());

        return redirect()->route('login')->with('msg', 'Đăng kí thành công');
    }

    public function forgotPass()
    {
        return view('clients.forgotPass');
    }

    public function changePass()
    {

        return view('clients.changePass')->with($this->getDataUser());
    }

    public function postChangePass(Request $request)
    {
        $user = new Account();
        $info = $user->changePassWord($request->currentpassword, $request->newpassword);
        return redirect()->route('change-pass')->with($info);
    }

    public function changeEmail()
    {
        return view('clients.changeEmail')->with($this->getDataUser());
    }

    public function postChangeEmail(Request $request)
    {
        $user = new Account();
        $info = $user->changeEmail($request->currentemail, $request->currentphone, $request->newemail);
        return redirect()->route('change-email')->with($info);
    }

    public function changePhone()
    {
        return view('clients.changePhone')->with($this->getDataUser());
    }

    public function postChangePhone(Request $request)
    {
        $user = new Account();
        $info = $user->changePhone($request->currentemail, $request->currentphone, $request->newphone);
        return redirect()->route('change-phone')->with($info);
    }

    public function topUp()
    {
        return view('clients.topUp')->with($this->getDataUser());
    }

    public function topUpVn()
    {
        return view('clients.topUpVn')->with($this->getDataUser());
    }

    public function topUpMoMo()
    {
        return view('clients.topUpMoMo')->with($this->getDataUser());
    }

    public function giftCode()
    {
        return view('clients.giftCode')->with($this->getDataUser());
    }

    public function history()
    {
        return view('clients.history')->with($this->getDataUser());
    }

    public function getDataUser()
    {
        $user = Auth::guard('client')->user();
        $data['username'] = $user->username;
        $data['money'] = number_format($user->money);
        $data['createtime'] = $user->createtime;
        $data['phone'] = preg_replace("/^.+(?=(.{3}$))/", "********", $user->phone);
        $data['email'] = preg_replace("/^.+(?=(.{2}@.+$))/", "********", $user->email);
        $data['createip'] = $user->createid;
        return $data;
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    //--------------------------------------------------------------------------------------------------------//

    public function getIP()
    {
        if (!empty($_SERVER["HTTP_CLIENT_IP"]))
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        else if (!empty($_SERVER["REMOTE_ADDR"]))
            $ip = $_SERVER["REMOTE_ADDR"];
        else
            $ip = "Không tồn tại !";
        return $ip;
    }
}
