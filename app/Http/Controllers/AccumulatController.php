<?php

namespace App\Http\Controllers;

use App\Classes\GetInfo;
use App\Models\Account;
use App\Models\Accumulat;
use App\Models\AccumulatGiftCode;
use App\Models\AccumulatLog;
use App\Models\AdminPanel;
use App\Models\HistoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccumulatController extends Controller
{
    public $getinfo;
    public function __construct()
    {
        $this->getinfo = new GetInfo();
    }
    public function index()
    {
        $accumulat = new Accumulat();
        $adminpanel = new AdminPanel();
        $time = $adminpanel->getTimeAccumulat();
        $data = [];
        $data['isaccumulat'] = $adminpanel->checkAccumulat();
        $data['time_start'] = date('H:i:s d:m:Y', strtotime($time['time_start']));
        $data['time_end'] = date('H:i:s d:m:Y', strtotime($time['time_end']));;
        $data['accumulat'] = $accumulat->getAccumulat();
        // dd($data);
        return view('clients.accumulat')->with($this->getinfo->getDataUser())->with(compact('data'));
    }

    public function getAwardByAccumulat(Request $request)
    {
        try {
            $id = $request->id;
            $award = [];
            $info = [];
            $account = new Account();
            $accumulatlog = new AccumulatLog();
            $accumulat = $account->getAccumulat(Auth::guard('client')->user()->username);
            $data = Accumulat::where('id', $id)->first();
            $giftcode = $accumulatlog->checkGiftCode($id);
            $info = [];

            $sInfo = $data->info;
            $sAwardAll = explode(";", $sInfo);
            if (count($sAwardAll) > 0) {
                foreach ($sAwardAll as $value) {
                    $temp = explode("=", $value);
                    $arrtemp = [];
                    if (count($temp) == 2) {
                        $arrtemp['name'] = $temp[0];
                        $arrtemp['num'] = $temp[1];
                        array_push($award, $arrtemp);
                    }
                }
            }
            $info['award'] = $award;
            //check xem đã nhận mốc này chưa
            if ($giftcode != false) {
                $info['msg'] = "Bạn đã nhận giftcode của mốc này rồi";
                $info['giftcode'] = $giftcode;
                $info['money'] = "";
                return json_encode($info);
            }

            if ($data->money <= $accumulat) {
                return json_encode($info);
            } else {
                $info['msg'] = "Bạn chưa đủ tích lũy để nhận mốc này";
                $info['status'] = 0;
                return json_encode($info);
            }
        } catch (\Throwable $th) {
            $info['award'] = "";
            $info['status'] = 0;
            return json_encode($info);
        }
    }

    public function getGiftCode(Request $request)
    {
        $id = $request->id;
        $accumulatlog = new AccumulatLog();
        $accumulatgiftcode = new AccumulatGiftCode();
        $historylog = new HistoryLog();
        //check bảng long xem đã nhận chưa, nếu nhận rồi thì show ra lại
        $giftcode = $accumulatlog->checkGiftCode($id);
        $info = [];
        if ($giftcode != false) {
            $info['msg'] = "Bạn đã nhận giftcode của mốc này rồi";
            $info['giftcode'] = $giftcode;
            $info['money'] = "";
            return json_encode($info);
        }
        //nếu chưa nhận thì.....check tiền có đủ ko
        $account = new Account();
        $accumulat = new Accumulat();
        $moneyacc = $account->getAccumulat(Auth::guard('client')->user()->username);

        $money = $accumulat->getMoneyAccumulat($id);

        if ($moneyacc >= $money) {
            $giftcode = $accumulatgiftcode->getGiftCode($id);
            //ghi vào log
            $accumulatlog->addAccumulatLog($giftcode, $id, $moneyacc);
            $historylog->createHistory(Auth::guard('client')->user()->username, 'Accumulat', 'ACCUMULAT|'.$giftcode.'|'.$money);
            
            $info['msg'] = "Nhận thành công";
            $info['money'] = number_format($moneyacc - $money);
            $info['giftcode'] = $giftcode;
            return json_encode($info);
        } else {
            $info['msg'] = "Bạn chưa đủ tích lũy để nhận gói này";
            $info['giftcode'] = "";
            $info['money'] = "";
            return json_encode($info);
        }
    }

    public function test()
    {
        $accumulatlog = new AccumulatLog();
        $accumulatlog->addAccumulatLog("423434423", "3", "1000");
    }
}
