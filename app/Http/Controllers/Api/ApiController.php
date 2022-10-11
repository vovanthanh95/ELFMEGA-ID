<?php

namespace App\Http\Controllers\Api;

use App\Classes\GetInfo;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location;

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
            'username.required' => trans('message.alertusernotfree'),
            'username.regex' => trans('message.alertusernameregex'),
            'password.required' => trans('message.alertpassnotfree'),
            'password.min' => trans('message.alertpassregex'),
        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->first(),
                "code" => 0,
                "name"=> "",
                "status" => 400,
            ], 400);
        }
        if (isset($request->username) && isset($request->password) && isset($request->platform)) {
            $username = $request->username;
            $password = $request->password;
            $platform = $request->platform;
            $ip = $request->ip();
            $countryname = "";
            $countrycode = "";
            try {
                $locate = Location::get($ip);
                if ($locate != false) {
                    $countryname = $locate->countryName;
                    $countrycode = $locate->countryCode;
                }
            } catch (\Throwable $th) {
                //throw $th;
            }

            $account = new Account();
            $info = $account->apiRegister($username, $password, $platform, $ip, $countryname, $countrycode);
            if (empty($info)) {
                return response()->json([
                    "name" => "OK!",
                    "message" => trans('message.alertregistersuccess'),
                    "code" => 1,
                    "status" => 200,
                    "data" => [
                        "user_id" => Auth::guard('client')->user()->username,
                        "access_token" => Auth::guard('client')->user()->access_token,
                        "refresh_token" => Auth::guard('client')->user()->refresh_token,
                        "expires" => strtotime(Auth::guard('client')->user()->expires),
                    ]
                ], 200);
            } else {
                return response()->json([
                    "message" => $info['msg'],
                    "code" => 0,
                    "name"=> "",
                    "status" => 400,
                ], 400);
            }
        } else {
            return response()->json([
                "message" => trans('message.alertregisterinfonottrue'),
                "code" => 0,
                "name"=> "",
                "status" => 400,
            ], 400);
        }
    }

    public function login(Request $request)
    {

        $rule = [
            'username' => 'required|regex:/^[A-Za-z0-9_]{6,32}$/i',
            'password' => 'required|min:8',
        ];
        $message = [
            'username.required' => trans('message.alertusernotfree'),
            'username.regex' => trans('message.alertusernameregex'),
            'password.required' => trans('message.alertpassnotfree'),
            'password.min' => trans('message.alertpassregex'),
        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->first(),
                "code" => 0,
                "name"=> "",
                "status" => 400,
            ], 400);
        }
        if (isset($request->username) && isset($request->password) && isset($request->platform)) {
            $username = $request->username;
            $password = $request->password;
            $platform = $request->platform;
            $account = new Account();
            $info = $account->apiLogin($username, $password, $platform);
            if (empty($info)) {
                return response()->json([
                    "name" => "OK!",
                    "message" => trans('message.alertloginsuccess'),
                    "code" => 1,
                    "status" => 200,
                    "data" => [
                        "user_id" => Auth::guard('client')->user()->username,
                        "access_token" => Auth::guard('client')->user()->access_token,
                        "refresh_token" => Auth::guard('client')->user()->refresh_token,
                        "expires" => strtotime(Auth::guard('client')->user()->expires),
                    ]
                ], 200);
            } else {
                return response()->json([
                    "message" => $info['msg'],
                    "code" => 0,
                    "name"=> "",
                    "status" => 400,
                ], 400);
            }
        } else {
            return response()->json([
                "message" => trans('message.alertlogininfonottrue'),
                "code" => 0,
                "name"=> "",
                "status" => 400,
            ], 400);
        }
    }

    public function forgotPass(Request $request)
    {
        $rule = [
            'username' => 'required|regex:/^[A-Za-z0-9_]{6,32}$/i',
            'email' => 'required|email',
        ];
        $message = [
            'username.required' => trans('message.alertusernotfree'),
            'username.regex' => trans('message.alertusernameregex'),
            'email.required' => trans('message.alertemailnotfree'),
            'email.email' => trans('message.alertemailnottrue'),
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
            "message" => trans('message.alertcheckpassinemail'),
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
