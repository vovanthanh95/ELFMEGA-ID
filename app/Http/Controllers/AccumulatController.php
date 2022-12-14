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
            //check xem ???? nh???n m???c n??y ch??a
            if ($giftcode != false) {
                $info['msg'] = "B???n ???? nh???n giftcode c???a m???c n??y r???i";
                $info['giftcode'] = $giftcode;
                $info['money'] = "";
                return json_encode($info);
            }

            if ($data->money <= $accumulat) {
                return json_encode($info);
            } else {
                $info['msg'] = "B???n ch??a ????? t??ch l??y ????? nh???n m???c n??y";
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
        //check b???ng long xem ???? nh???n ch??a, n???u nh???n r???i th?? show ra l???i
        $giftcode = $accumulatlog->checkGiftCode($id);
        $info = [];
        if ($giftcode != false) {
            $info['msg'] = "B???n ???? nh???n giftcode c???a m???c n??y r???i";
            $info['giftcode'] = $giftcode;
            $info['money'] = "";
            return json_encode($info);
        }
        //n???u ch??a nh???n th??.....check ti???n c?? ????? ko
        $account = new Account();
        $accumulat = new Accumulat();
        $moneyacc = $account->getAccumulat(Auth::guard('client')->user()->username);

        $money = $accumulat->getMoneyAccumulat($id);

        if ($moneyacc >= $money) {
            $giftcode = $accumulatgiftcode->getGiftCode($id);
            //ghi v??o log
            $accumulatlog->addAccumulatLog($giftcode, $id, $moneyacc);
            $historylog->createHistory(Auth::guard('client')->user()->username, 'Accumulat', 'ACCUMULAT|'.$giftcode.'|'.$money);
            
            $info['msg'] = "Nh???n th??nh c??ng";
            $info['money'] = number_format($moneyacc - $money);
            $info['giftcode'] = $giftcode;
            return json_encode($info);
        } else {
            $info['msg'] = "B???n ch??a ????? t??ch l??y ????? nh???n g??i n??y";
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
