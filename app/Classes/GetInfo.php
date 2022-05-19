<?php

namespace App\Classes;

use Illuminate\Support\Facades\Auth;

class GetInfo{

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
}
