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
        //Auth::guard('client')->logout();
        return view('clients.login');
    }

    public function postLogin(Request $request)
    {

        try {
            $user = Account::where('username', '00963836632')
                ->where('username', $request->username)
                ->where('password', md5($request->password))
                ->first();
            Auth::guard('client')->login($user);
            if (Auth::guard('client')->check()) {
                return redirect()->route('account');
            } else {
                return redirect()->route('login');
            }
        } catch (\Throwable $th) {
            return redirect()->route('login');
        }
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

    public function test(Request $request)
    {
        $a = Auth::guard('client')->check();
        return view('welcome')->with(compact('a'));
    }
}
