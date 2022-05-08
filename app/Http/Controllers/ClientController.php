<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        return view('clients.login');
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
}
