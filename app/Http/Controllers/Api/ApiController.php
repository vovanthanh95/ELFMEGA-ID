<?php

namespace App\Http\Controllers\Api;

use App\Classes\GetInfo;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public $getinfo;
    public function __construct()
    {
        $this->getinfo = new GetInfo();
    }
    public function register(Request $request)
    {
        $rule = [
            'username' => 'required|regex:/^[A-Za-z0-9_]{6,32}$/i',
            'password' => 'required|min:8',
        ];
        $message = [
            'username.required' => 'Vui lòng điền tên đăng nhập',
            'username.regex' => 'Tên đăng nhập phải là các kí tự A-Z, a-z, 0-9 và dấu gạch dưới, có độ dài từ 6 đến 32 kí tự',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải từ 8 kí tự trở lên',
        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->first(),
                "code" => 0,
                "status" => 401,
            ], 401);
        }
        if (isset($request->username) && isset($request->password)) {
            $username = $request->username;
            $password = $request->password;
            $account = new Account();
            $info = $account->apiRegister($username, $password);
            if (empty($info)) {
                return response()->json([
                    "name" => "OK!",
                    "message" => "Đăng ký thành công",
                    "code" => 1,
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
                    "code" => 0,
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

        $rule = [
            'username' => 'required|regex:/^[A-Za-z0-9_]{6,32}$/i',
            'password' => 'required|min:8',
        ];
        $message = [
            'username.required' => 'Vui lòng điền tên đăng nhập',
            'username.regex' => 'Tên đăng nhập phải là các kí tự A-Z, a-z, 0-9 và dấu gạch dưới, có độ dài từ 6 đến 32 kí tự',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải từ 8 kí tự trở lên',
        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->first(),
                "code" => 0,
                "status" => 401,
            ], 401);
        }
        if (isset($request->username) && isset($request->password)) {
            $username = $request->username;
            $password = $request->password;
            $account = new Account();
            $info = $account->apiLogin($username, $password);
            if (empty($info)) {
                return response()->json([
                    "name" => "OK!",
                    "message" => "Đăng nhập thành công",
                    "code" => 1,
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
                    "code" => 0,
                    "status" => 401,
                ], 401);
            }
        } else {
            return response()->json([
                "message" => "Thông tin đăng nhập không hợp lệ",
                "code" => 0,
                "status" => 401,
            ], 401);
        }
    }

    public function forgotPass(Request $request)
    {
        $rule = [
            'username' => 'required|regex:/^[A-Za-z0-9_]{6,32}$/i',
            'email' => 'required|email',
        ];
        $message = [
            'username.required' => 'Vui lòng điền tên đăng nhập',
            'username.regex' => 'Tên đăng nhập phải là các kí tự A-Z, a-z, 0-9 và dấu gạch dưới, có độ dài từ 6 đến 32 kí tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->first(),
                "code" => 0,
                "status" => 401,
            ], 401);
        }
        $user = new Account();
        $info = $user->forgotPass($request->username, $request->email, $this->getinfo->getIP());
        if ($info['type'] == 'error') {
            return response()->json([
                "message" => $info['msg'],
                "code" => 0,
                "status" => 401,
            ], 401);
        }
        return response()->json([
            "name" => "OK!",
            "message" => "Vui lòng kiểm tra mật khẩu mới trong email",
            "code" => 1,
            "status" => 200,
            "data" => [
                "user_id" => Auth::guard('client')->user()->username,
                "access_token" => Auth::guard('client')->user()->access_token,
                "refresh_token" => Auth::guard('client')->user()->refresh_token,
                "expires" => 3600
            ]
        ], 200);
    }
}
