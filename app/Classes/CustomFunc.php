<?php
namespace App\Classes;
use App\Models\Account;
use App\Models\MoneyLog;

class CustomFunc
{

    public function getPackageMoney($subject_id)
    {
        $money_to_pack_id2 = [
            12     => '50000',
            13     => '150000',
            15     => '10000',
            16     => '20000',
            17     => '50000',
            18     => '100000',
            19     => '200000',
            20     => '500000',
            21     => '1000000',
            22     => '2000000',
            23     => '5000000',
            33     => '50000',
            34     => '100000',
            101     => '200000',
            // 30     => '50000',
            // 31     => '30000',
            // 32     => '20000',
            // 33     => '10000',
            // 34     => '100000',
            // 35     => '300000',
            // 100     => '100000',
            // 101     => '300000',
        ];
        $subject_id = (int)$subject_id; //强制转成int
        return !in_array($subject_id, array_keys($money_to_pack_id2)) ? 0 : $money_to_pack_id2[$subject_id];
    }

    public function addMoney($username, $type, $money)
    {
        $account = new Account();
        $moneylog = new MoneyLog();
        $info = $account->getUserByUserName($username);
        $moneyold = $info['money'];
        $moneynew = $info['money'] + $money;
        $result = $moneylog->addMoneyLog($username, $type, $moneyold, $moneynew);
        $isOkey = false;
        $result = $account->setMoneySumMoney($username, $money);
        if ($result) {
            $isOkey = true;
        }
        return $isOkey;
    }

    public function removeMoney($username, $type, $money)
    {
        $account = new Account();
        $moneylog = new MoneyLog();
        if ($money <= 0) {
            $isOkey = false;
        } else {
            $info = $account->getUserByUserName($username);
            if ($info['money'] >= $money) {
                $moneyold = $info['money'];
                $moneynew = $info['money'] - $money;
                $moneylog->addMoneyLog($username, $type, $moneyold, $moneynew);
                $isOkey = false;
                $result = $account->setCoin($username, $money);
                if ($result) {
                    $isOkey = true;
                }
            } else {
                $isOkey = false;
            }
        }
        return $isOkey;
    }

    public function addRecharge($productid, $uid, $sid)
    {
        $url = "http://127.0.0.1:5$sid/hgame/background_api";
        $data = array(
            "action" => 'gvmrecharge',
            "playerid" => $uid,
            "productid" => intval($productid),
            "gvmkey" => "vemA6CTMWQKitr3JKbt9HZ1uh5sHKJRD"
        );

        $data_string = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            print_r(curl_error($ch));
        }
        curl_close($ch);

        return $result['code'];
    }
}
