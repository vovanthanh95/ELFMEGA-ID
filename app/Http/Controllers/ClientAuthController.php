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
        return view('clients.login');
    }

    public function postLogin(Request $request)
    {
        $account = new Account();
        $info = $account->login($request->username, $request->password);
        if ($info != null) {
            return redirect()->route('login')->with($info);
        }
        if (Auth::guard('client')->check()) {
            return redirect()->route('account');
        }
    }

    public function logout()
    {
        Auth::guard('client')->logout();
        return redirect()->route('login');
    }

}
