<?php

namespace App\Http\Controllers;

use App\Classes\GetInfo;
use App\Models\Account;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->usr;
        $password = $request->pwd;
        $account = new Account();
        $return = [];
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            $return['code'] = 1;
            $return['usr'] = "";
        } else if (strlen($username) < 6 || strlen($username) > 16) {
            $return['code'] = 1;
            $return['usr'] = "";
        } else {
            $info = $account->login($username, $password);
            if ($info != null) {
                if ($info["msg"] != 'Tài khoản bị khóa') {
                    $return['code'] = "1";
                    $return['usr'] = "";
                } else {
                    $return['code'] = "2";
                    $return['usr'] = "";
                }
            } else {
                $return['code'] = "0";
                $return['usr'] = $username;
            }
        }
        return json_encode($return);
    }

    public function register(Request $request)
    {
        $username = $request->usr;
        $password = $request->pwd;
        $account = new Account();
        $getinfo = new GetInfo();
        $return = [];
        if (!isset($username) || empty($username)) {
            $return['code'] = 1;
            $return['msg'] = "Vui lòng nhập tài khoản";
        } else if (!isset($password) || empty($password)) {
            $return['code'] = 1;
            $return['msg'] = "Vui lòng nhập mật khẩu";
        } else if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            $return['code'] = 1;
            $return['msg'] = "Tên người dùng phải là a-z hoặc 0-9 ký tự";
        } else if (strlen($username) < 6 || strlen($username) > 16) {
            $return['code'] = 1;
            $return['msg'] = "Tài khoản bắt buộc từ 6-16 ký tự";
        } else {
            $info = $account->createAccountApp($username, $password, $getinfo->getIP());
            $return['code'] = $info['code'];
            $return['msg'] =  $info['msg'];
        }
        return json_encode($return);
    }
}
