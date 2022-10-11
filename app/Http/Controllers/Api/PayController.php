<?php

namespace App\Http\Controllers\Api;

use App\Classes\CustomFunc;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\ChargeLog;
use App\Models\HistoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PayController extends Controller
{
    public function pay(Request $request)
    {


        $username = $request->username;
        $serverid = $request->serverid;
        $amount = $request->amount;
        $productid = $request->productid;
        $uid = $request->uid;
        $customfunc = new CustomFunc();
        $history = new HistoryLog();
        $chargelog = new ChargeLog();
        $account = new Account();

        $rule = [
            'username' => 'required|regex:/^[A-Za-z0-9_]{6,32}$/i',
            'serverid' => 'required',
            'uid' => 'required',
            'productid' => 'required',
            'amount' => 'required',
        ];
        $message = [
            'username.required' => trans('message.alertusernotfree'),
            'username.regex' => trans('message.alertusernameregex'),
            'serverid.required' => trans('message.alertserveridnotfree'),
            'uid.required' => trans('message.alertuidnotfree'),
            'productid.required' => trans('message.alertproductidnotfree'),
            'amount.required' => trans('message.alertamountnotfree'),
        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->first(),
                "code" => 0,
                "status" => 401,
            ], 401);
        }

        $package_money = $customfunc->getPackageMoney($productid);
        if ($amount  != $package_money) {
            return response()->json([
                "message" => trans('message.alertparametermismatch'),
                "code" => 0,
                "status" => 201,
            ], 201);
        }

        if ($amount < 1000) {
            $str = $productid . "--" . $amount;
            Log::channel('pay')->info($str);
            return response()->json([
                "message" => trans('message.alertparametermismatch'),
                "code" => 0,
                "status" => 201,
            ], 201);
        }
        $info = $account->getUserByUserName2($username);
        if ($info != null) {
            if ($info->money < $amount) {
                return response()->json([
                    "message" => trans('message.alertaccountnotenoughmoney'),
                    "messagecode" => '101',
                    "code" => 0,
                    "status" => 201,
                ], 201);
            }
        } else {
            return response()->json([
                "message" => trans('message.alerthaserror'),
                "code" => 0,
                "status" => 201,
            ], 201);
        }
        $guiid = $this->GUID();
        try {
            $chargelog->addChargeLog($username, $serverid, $amount, $guiid, $uid, 0, $productid);
            return response()->json([
                "message" => "ok",
                "transcode" => $guiid,
                "code" => 1,
                "status" => 200,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => trans('message.alertfailure'),
                "code" => 0,
                "status" => 201,
            ], 201);
        }
    }

    public function checkPay(Request $request)
    {
        $username = $request->username;
        $serverid = $request->serverid;
        $uid = $request->uid;
        $productid = $request->productid;
        $amount = $request->amount;
        $transcode = $request->transcode;
        $chargelog = new ChargeLog();
        $customfunc = new CustomFunc();
        $history = new HistoryLog();

        $rule = [
            'username' => 'required|regex:/^[A-Za-z0-9_]{6,32}$/i',
            'serverid' => 'required',
            'uid' => 'required',
            'productid' => 'required',
            'amount' => 'required',
            'transcode' => 'required',
        ];
        $message = [
            'username.required' => trans('message.alertusernotfree'),
            'username.regex' => trans('message.alertusernameregex'),
            'serverid.required' => trans('message.alertserveridnotfree'),
            'uid.required' => trans('message.alertuidnotfree'),
            'productid.required' => trans('message.alertproductidnotfree'),
            'amount.required' => trans('message.alertamountnotfree'),
            'transcode.required' => trans('message.alerttranscodenotfree'),
        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->first(),
                "code" => 0,
                "status" => 401,
            ], 401);
        }

        $data = $chargelog->checkPay($username, $serverid, $amount, $transcode, $uid, $productid);
        if ($data == true) {
            $package_money = $customfunc->getPackageMoney($productid);
            $removemoney = $customfunc->removeMoney($username, "Mua Gói", $package_money);
            if ($removemoney) {
                $content = $productid . "|" . $username . "|" . $package_money . "|" . $uid . "|" . $serverid;
                $history->createHistory($username, "BuyProduct", $content, 1);
                return response()->json([
                    "message" => 'ok',
                    "code" => 1,
                    "status" => 200,
                ], 200);
            } else {
                return response()->json([
                    "message" => trans('message.alertaccountnotenoughmoney'),
                    "messagecode" => '101',
                    "code" => 0,
                    "status" => 201,
                ], 201);
            }
        }
        return response()->json([
            "message" => trans('message.alertfailure'),
            "code" => 0,
            "status" => 201,
        ], 201);
    }

    public function GUID()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public function auth(Request $request)
    {
        $accountId = $request->accountId;
        $orderStatus = $request->orderStatus;
        $orderId = $request->orderId;
        $game_extra = $request->game_extra;
        $username = $request->username;
        $serverid = $request->serverid;
        $amount = $request->amount;
        $productid = $request->productid;
        $uid = $request->uid;
        $productdesc = $request->productDesc;
        $platform = $request->platform;
        $customfunc = new CustomFunc();
        $history = new HistoryLog();
        $chargelog = new ChargeLog();
        $account = new Account();

        $rule = [
            'username' => 'required|regex:/^[A-Za-z0-9_]{6,32}$/i',
            'serverid' => 'required',
            'uid' => 'required',
            'productid' => 'required',
            'amount' => 'required',
        ];
        $message = [
            'username.required' => trans('message.alertusernotfree'),
            'username.regex' => trans('message.alertusernameregex'),
            'serverid.required' => trans('message.alertserveridnotfree'),
            'uid.required' => trans('message.alertuidnotfree'),
            'productid.required' => trans('message.alertproductidnotfree'),
            'amount.required' => trans('message.alertamountnotfree'),
        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->first(),
                "status" => 500,
            ], 500);
        }

        $package_money = $customfunc->getPackageMoney($productid);
        if ($amount  != $package_money) {
            return response()->json([
                "message" => trans('message.alertparametermismatch'),
                "status" => 500,
            ], 500);
        }

        if ($amount < 1000) {
            $str = $productid . "--" . $amount;
            Log::channel('pay')->info($str);
            return response()->json([
                "message" => trans('message.alertparametermismatch'),
                "status" => 500,
            ], 500);
        }
        $info = $account->getUserByUserName2($username);
        if ($info != null) {
            if ($info->money < $amount) {
                return response()->json([
                    "code" => 201,
                ], 200);
            }
        } else {
            return response()->json([
                "message" => trans('message.alerthaserror'),
                "status" => 500,
            ], 500);
        }
        $guiid = $this->GUID();
        try {
            $chargelog->addChargeLog($username, $serverid, $amount, $guiid, $uid, 0, $productid, $platform, $productdesc);
            $data1 = Http::asForm()->post('http://gate.elfmega.com:23757/tjgame/payment', [
                'accountId' => $accountId,
                'orderStatus' => $orderStatus,
                'orderId' => $orderId,
                'amount' => $amount,
                'game_extra' => $game_extra,
                'signkey' => '$2a$12$J0uc60O/lyfdajMrMSqxgONkWpuGEL/eNiEkk6pFrWPusePYxIzqS',
            ]);
            $ret = $data1->json()['ret'];
            $data = $data1->json()['data'];
            if ($ret == '0' && $data == "Ok") {
                
                $data = $chargelog->checkPay($username, $serverid, $amount, "", $uid, $productid);
                if ($data == true) {
                    $package_money = $customfunc->getPackageMoney($productid);
                    $removemoney = $customfunc->removeMoney($username, "Mua Gói", $package_money);
                    if ($removemoney) {
                        $content = $productid . "|" . $username . "|" . $package_money . "|" . $uid . "|" . $serverid;
                        $history->createHistory($username, "BuyProduct", $content, 1);
                        return response()->json([
                            "code" => 200,
                            "status" => 200,
                        ], 200);
                    } else {
                        return response()->json([
                            "message" => trans('message.alerthaserror'),
                            "code" => 0,
                            "status" => 500,
                        ], 500);
                    }
                }
            } else {
                return response()->json([
                    "message" => trans('message.alertfailure'),
                    "code" => 0,
                    "status" => 500,
                ], 500);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "message" => trans('message.alertfailure'),
                "code" => 0,
                "status" => 500,
            ], 500);
        }
    }

    public function test(Request $request)
    {
        $accountId = $request->accountId;
        $orderStatus = $request->orderStatus;
        $orderId = $request->orderId;
        $game_extra = $request->game_extra;
        $username = $request->username;
        $serverid = $request->serverid;
        $amount = $request->amount;
        $productid = $request->productid;
        $uid = $request->uid;
        $productdesc = $request->productDesc;
        $platform = $request->platform;
        $customfunc = new CustomFunc();
        $history = new HistoryLog();
        $chargelog = new ChargeLog();
        $account = new Account();

        $rule = [
            'username' => 'required|regex:/^[A-Za-z0-9_]{6,32}$/i',
            'serverid' => 'required',
            'uid' => 'required',
            'productid' => 'required',
            'amount' => 'required',
        ];
        $message = [
            'username.required' => trans('message.alertusernotfree'),
            'username.regex' => trans('message.alertusernameregex'),
            'serverid.required' => trans('message.alertserveridnotfree'),
            'uid.required' => trans('message.alertuidnotfree'),
            'productid.required' => trans('message.alertproductidnotfree'),
            'amount.required' => trans('message.alertamountnotfree'),
        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->first(),
                "status" => 500,
            ], 500);
        }

        $package_money = $customfunc->getPackageMoney($productid);
        if ($amount  != $package_money) {
            return response()->json([
                "message" => trans('message.alertparametermismatch'),
                "status" => 500,
            ], 500);
        }

        if ($amount < 1000) {
            $str = $productid . "--" . $amount;
            Log::channel('pay')->info($str);
            return response()->json([
                "message" => trans('message.alertparametermismatch'),
                "status" => 500,
            ], 500);
        }
        $info = $account->getUserByUserName2($username);
        if ($info != null) {
            if ($info->money < $amount) {
                return response()->json([
                    "code" => 201,
                ], 200);
            }
        } else {
            return response()->json([
                "message" => trans('message.alerthaserror'),
                "status" => 500,
            ], 500);
        }
        $guiid = $this->GUID();
        try {
            $chargelog->addChargeLog($username, $serverid, $amount, $guiid, $uid, 0, $productid, $platform, $productdesc);
            $data1 = Http::asForm()->post('http://test.elfmega.com:23757/tjgame/payment', [
                'accountId' => $accountId,
                'orderStatus' => $orderStatus,
                'orderId' => $orderId,
                'amount' => $amount,
                'game_extra' => $game_extra,
                'signkey' => '$2a$12$J0uc60O/lyfdajMrMSqxgONkWpuGEL/eNiEkk6pFrWPusePYxIzqS',
            ]);
            $ret = $data1->json()['ret'];
            $data = $data1->json()['data'];
            if ($ret == '0' && $data == "Ok") {
                
                $data = $chargelog->checkPay($username, $serverid, $amount, "", $uid, $productid);
                if ($data == true) {
                    $package_money = $customfunc->getPackageMoney($productid);
                    $removemoney = $customfunc->removeMoney($username, "Mua Gói", $package_money);
                    if ($removemoney) {
                        $content = $productid . "|" . $username . "|" . $package_money . "|" . $uid . "|" . $serverid;
                        $history->createHistory($username, "BuyProduct", $content, 1);
                        return response()->json([
                            "code" => 200,
                            "status" => 200,
                        ], 200);
                    } else {
                        return response()->json([
                            "message" => trans('message.alerthaserror'),
                            "code" => 0,
                            "status" => 500,
                        ], 500);
                    }
                }
            } else {
                return response()->json([
                    "message" => trans('message.alertfailure'),
                    "code" => 0,
                    "status" => 500,
                ], 500);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "message" => trans('message.alertfailure'),
                "code" => 0,
                "status" => 500,
            ], 500);
        }
    }
}
