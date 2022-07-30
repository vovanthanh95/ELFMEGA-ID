<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        if (isset($request->username) && isset($request->password)) {
            $username = $request->username;
            $password = $request->password;
            $account = new Account();
            $info = $account->apiRegister($username, $password);
            if (empty($info)) {
                return response()->json([
                    "name" => "OK!",
                    "message" => "Đăng ký thành công",
                    "code" => 0,
                    "status" => 200,
                    "data" => [
                        "user_id" => Auth::guard('client')->user()->username,
                        "access_token" => Auth::guard('client')->user()->access_token,
                        "refresh_token" => Auth::guard('client')->user()->refresh_token,
                        "expires" => 3600
                    ]
                ], 200);
            } else {
                return response()->json([
                    "message" => $info['msg'],
                    "code" => 1,
                    "status" => 401,
                ], 401);
            }
        } else {
            return response()->json([
                "message" => "Thông tin đăng ký không hợp lệ",
                "code" => 0,
                "status" => 401,
            ], 401);
        }
    }

    public function login(Request $request)
    {

        if (isset($request->username) && isset($request->password)) {
            $username = $request->username;
            $password = $request->password;
            $account = new Account();
            $info = $account->apiLogin($username, $password);
            if (empty($info)) {
                return response()->json([
                    "name" => "OK!",
                    "message" => "Đăng nhập thành công",
                    "code" => 0,
                    "status" => 200,
                    "data" => [
                        "user_id" => Auth::guard('client')->user()->username,
                        "access_token" => Auth::guard('client')->user()->access_token,
                        "refresh_token" => Auth::guard('client')->user()->refresh_token,
                        "expires" => 3600
                    ]
                ], 200);
            } else {
                return response()->json([
                    "message" => $info['msg'],
                    "code" => 1,
                    "status" => 401,
                ], 401);
            }
        } else {
            return response()->json([
                "message" => "Thông tin đăng nhập không hợp lệ",
                "code" => 1,
                "status" => 401,
            ], 401);
        }
    }
}
