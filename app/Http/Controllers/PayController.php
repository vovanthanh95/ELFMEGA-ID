<?php

namespace App\Http\Controllers;

use App\Classes\CustomFunc;
use App\Models\Account;
use App\Models\HistoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayController extends Controller
{
    public function pay(Request $request)
    {
        if (isset($request->srv_id) && isset($request->role_id) && isset($request->money) && isset($request->usr) && isset($request->productId)) {
            //dd($request->srv_id, $request->role_id, $request->money, $request->usr, $request->productId);
            $srv_id        = $request->srv_id;
            $role_id    = $request->role_id;
            $money        = $request->money;
            $name        = $request->usr;
            $productId    = $request->productId;
            $customfunc = new CustomFunc();
            $acc = new Account();
            $history = new HistoryLog();

            //srv_id=symlf_1&role_id=1&money=5000&name=123123&productId=301

            $uid = $name;
            $quid = $srv_id;
            $package_money = $customfunc->getPackageMoney($productId);
            if ($money  != $package_money) {
                exit('Parameter mismatch !');
            }

            if ($money < 1000) {
                $str = $productId . "--" . $money;
                Log::channel('pay')->info($str);
                exit('Parameter mismatch 2 !');
            }

            $coin = $acc->getCoin($name);
            $removemoney = $customfunc->removeMoney($name, "Mua Gói", $package_money);
            if ($removemoney) {
                $content = $productId . "|" . $name . "|" . $package_money . "|" . $role_id . "|" . $srv_id;
                $history->createHistory($name, "BuyProduct", $content, 1);
                $result = $customfunc->addRecharge($productId, $role_id, $srv_id);
                if ($result['code'] == 0) {
                    exit();
                } else {
                    $customfunc->addMoney($name, "Mua gói thất bại", $package_money);
                    exit();
                }
            } else {
                exit('Số tiền trong tài khoản không đủ');
            }
        }else{
            exit('có lỗi xảy ra');
        }
    }
}
