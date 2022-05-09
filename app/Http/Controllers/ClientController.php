<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        return view('clients.account');
    }

    public function login(){
       return view('clients.login');
    }

    public function register(){
        return view('clients.register');
    }

    public function forgotPass(){
        return view('clients.forgotPass');
    }

    public function changePass(){
        return view('clients.changePass');
    }

    public function changeEmail(){
        return view('clients.changeEmail');
    }

    public function changePhone(){
        return view('clients.changePhone');
    }

    public function topUp(){
        return view('clients.topUp');
    }

    public function topUpVn(){
        return view('clients.topUpVn');
    }

    public function topUpMoMo(){
        return view('clients.topUpMoMo');
    }
}
