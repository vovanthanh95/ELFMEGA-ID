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
        if($request->serverid < 0 || !is_numeric($request->serverid)){
            return redirect()->route('login')->with('msg','chưa chọn server');
        }
        $info = $account->login($request->username, $request->password);
        if($info != null){
            return redirect()->route('login')->with('msg',$info['msg']);
        }
        if(Auth::guard('client')->check()){
            $zonename = config('custom.zonelist')[$request->serverid];
            session()->put('serverid',$zonename);
            return redirect()->route('account');
        }
    }

    public function logout(){
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
            'username' => ['required','max:16','min:6'],
            'password' => ['required'],
            'email' => ['required','email'],
            'phone' => ['required'],
        ];
        $message = [
            'username.require' => ['nhập tên user vô cu'],
        ];
        $request->validate($rule, $message);
        //return redirect()->route('login');
    }

    public function forgotPass()
    {
        return view('clients.forgotPass');
    }

    public function changePass()
    {

        return view('clients.changePass')->with($this->getDataUser());
    }

    public function changeEmail()
    {
        return view('clients.changeEmail')->with($this->getDataUser());
    }

    public function changePhone()
    {
        return view('clients.changePhone')->with($this->getDataUser());
    }

    public function topUp()
    {
        return view('clients.topUp');
    }

    public function topUpVn()
    {
        return view('clients.topUpVn');
    }

    public function topUpMoMo()
    {
        return view('clients.topUpMoMo');
    }

    public function giftCode(){
        return view('clients.giftCode');
    }

    public function history()
    {
        return view('clients.history');
    }

    public function getDataUser(){
        $user = Auth::guard('client')->user();
        $data['username'] = $user->username;
        $data['money'] = $user->money;
        $data['createtime'] = $user->createtime;
        $data['phone'] = preg_replace("/^.+(?=(.{3}$))/","********",$user->phone);
        $data['email'] = preg_replace("/^.+(?=(.{2}@.+$))/","********",$user->email);
        $data['createip'] = $user->createid;
        return $data;
    }

}
