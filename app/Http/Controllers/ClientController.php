<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.account');
    }

    public function login()
    {
        return view('clients.login');
    }

    public function postLogin(Request $request)
    {
        $list = ['a'=> '1', 'b'=> '2'];
        return redirect()->route('login')->with('lis',$list);
        // $account = new Account();
        // if($request->serverid < 0 || !is_numeric($request->serverid)){
        //     return redirect()->route('login')->with('msg','chưa chọn server');
        // }
        // $info = $account->login($request->username, $request->password);
        // if($info != null){
        //     return redirect()->route('login')->with('msg',$info['msg']);
        // }
        // if(Auth::guard('client')->check()){
        //     $zonename = config('custom.zonelist')[$request->serverid];
        //     return redirect()->route('account')->with(['serverid' => $zonename]);
        // }
    }

    public function logout(){
        Auth::guard('client')->logout();
        return redirect()->route('login');
    }

    public function register()
    {
        return view('clients.register');
    }

    public function forgotPass()
    {
        return view('clients.forgotPass');
    }

    public function changePass()
    {
        return view('clients.changePass');
    }

    public function changeEmail()
    {
        return view('clients.changeEmail');
    }

    public function changePhone()
    {
        return view('clients.changePhone');
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

}
