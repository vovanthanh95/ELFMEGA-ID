<?php

namespace App\Http\Controllers\Api;

use App\Classes\CustomFunc;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\ChargeLog;
use App\Models\HistoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayController extends Controller
{
    public function pay(Request $request)
    {

        if (isset($request->uid) && isset($request->username) && isset($request->serverId) && isset($request->orderId) && isset($request->amount) && isset($request->productId)) {
            $username = $request->username;
            $serverId = $request->serverId;
            $orderId = $request->orderId;
            $amount = $request->amount;
            $productId = $request->productId;
            $uid = $request->uid;
            $customfunc = new CustomFunc();
            $acc = new Account();
            $history = new HistoryLog();
            $chargelog = new ChargeLog();

            $package_money = $customfunc->getPackageMoney($productId);
            if ($amount  != $package_money) {
                exit('Parameter mismatch !');
            }

            if ($amount < 1000) {
                $str = $productId . "--" . $amount;
                Log::channel('pay')->info($str);
                exit('Parameter mismatch 2 !');
            }

            $coin = $acc->getCoin($username);
            $removemoney = $customfunc->removeMoney($username, "Mua Gói", $package_money);
            if ($removemoney) {
                $content = $productId . "|" . $username . "|" . $package_money . "|" . $uid . "|" . $serverId;
                $history->createHistory($username, "BuyProduct", $content, 1);
                $result = $customfunc->addRecharge($productId, $uid, $serverId);
                $chargelog->addChargeLog($username, $serverId, $amount, $this->GUID(), $uid, 0);
                if ($result['code'] != 0) {
                    return "ok";
                    exit();
                } else {
                    $customfunc->addMoney($username, "Mua gói thất bại", $package_money);
                    exit();
                }
                return 'ok';
            } else {
                exit('Số tiền trong tài khoản không đủ');
            }
        } else {
            exit('có lỗi xảy ra');
        }
    }

    public function GUID()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}
