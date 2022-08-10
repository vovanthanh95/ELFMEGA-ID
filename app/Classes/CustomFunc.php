<?php
namespace App\Classes;
use App\Models\Account;
use App\Models\MoneyLog;

class CustomFunc
{

    public function getPackageMoney($subject_id)
    {
        $money_to_pack_id2 = [
            1     => '100000',
            2     => '200000',
            3    => '5000000',
            4    => '2000000',
            5     => '1000000',
            6     => '500000',
            7     => '200000',
            8    => '100000',
            9     => '50000',
            10     => '20000',
            11     => '10000',
            102     => '10000',
            103     => '20000',
            104     => '30000',
            105     => '40000',
            106     => '50000',
            107     => '100000',
            108     => '150000',
            109     => '200000',
            110     => '250000',
            111     => '300000',
            112     => '500000',
            113     => '1000000',
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
        $isOkey = false;
        if ($money <= 0) {
            $isOkey = false;
        } else {
            $info = $account->getUserByUserName($username);
            if($info != false){
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
