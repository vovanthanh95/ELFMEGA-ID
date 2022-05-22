<?php

namespace App\Http\Controllers;

use App\Classes\GetInfo;
use App\Models\AdminPanel;
use App\Models\CardLog;
use App\Models\HistoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\Pay247;
use App\Models\Account;
use App\Models\MoneyLog;
use Illuminate\Support\Facades\Log;

class TopUpController extends Controller
{
    public $getinfo;
    public function __construct()
    {
        $this->getinfo = new GetInfo();
    }
    public function topUp()
    {
        $cardlog = new CardLog();
        $data = $cardlog->getAll();
        //dd($data->count());
        return view('clients.topUp')->with($this->getinfo->getDataUser())->with(compact('data'));
    }

    public function topUpVn()
    {
        $ad = new AdminPanel();
        $getpromotion     = $ad->getPromotion('tlkmnapthe');
        $valuepromotion = $getpromotion['valuepromotion'];
        return view('clients.topUpVn')->with($this->getinfo->getDataUser())->with('getpromotion',$valuepromotion);
    }

    public function postTopUpVn(Request $request)
    {
        $rule = [
            'card_provider'=>'required',
            'card_value' => 'numeric',
            'card_serial'=>'regex:/^[0-9a-zA-Z]{6,20}$/i',
            'card_password'=> 'regex:/^[0-9]{6,15}$/i',
            'captcha' => 'required|captcha',
        ];
        $message = [
            'card_provider.required' => 'Vui lòng chọn loại thẻ',
            'card_value.numeric' => 'Vui lòng chọn mệnh giá thẻ',
            'card_serial.regex' => 'Seri không hợp lệ',
            'card_password.regex' => 'Mã thẻ không hợp lệ',
            'captcha.required' => 'Captcha không được trống',
            'captcha.captcha' => 'Captcha chưa đúng',
        ];
        $request->validate($rule, $message);
        $ad = new AdminPanel();
        $cardlog = new CardLog();
        $historylog = new HistoryLog();
        $pay247 = new Pay247();
        $getpromotion     = $ad->getPromotion('tlkmnapthe');
        $valuepromotion = $getpromotion['valuepromotion'];
        $note = md5($this->getinfo->getDataUser()['username'] . time());
        $Network = "";
        $card_name = "";
        $info = [];
        switch ($request->card_provider) {
            case 11:
                $card_name = "Viettel";
                $Network = "VTT";
                break;
            case 12:
                $card_name = "Mobifone";
                $Network = "VMS";
                break;
            case 13:
                $card_name = "Vinaphone";
                $Network = "VNP";
                break;
        }

        if (!$cardlog->checkCardLog($request->card_password, $request->card_serial)) {
            $APIKey = "f88bb560-1112-477e-b99d-9f80f0007685";
            $CardSeri = $request->card_serial;
            $CardCode = $request->card_password;
            $CardValue = $request->card_value;
            $URLCallback = route('call-back-top-up');
            $TrxID = $note;
            $result = $pay247->tichHop247($APIKey, $Network, $CardCode, $CardSeri, $CardValue, $URLCallback, $TrxID);
            $obj = json_decode($result);
            if ($obj->Code == 1) {
                $money = ($request->card_value / 100) * $valuepromotion;
                $cardlog->addCardLog($this->getinfo->getDataUser()['username'], $card_name, $CardSeri, $CardCode, $CardValue, $note);
                $content = $CardSeri . "|" . $this->getinfo->getDataUser()['username'] . "|" . $CardValue . "|" . $money;
                $historylog->createHistory($this->getinfo->getDataUser()['username'], "PrepaidCard", $content, 0, $note);
                $info['type'] = 'success';
                $info['msg'] = 'Hệ thống đang xử lý thẻ của bạn trong một vài phút. Vui lòng kiểm tra trạng thái thẻ nạp!';
            } else {
                $info['type'] = 'error';
                $info['msg'] = $obj->Message;
            }
        } else {
            $info['type'] = 'error';
            $info['msg'] = 'Thẻ nạp đã tồn tại vui lòng không nạp nữa';
        }
        return redirect()->route('top-up-vn')->with($info);
    }

    public function callBackTopUp(Request $request)
    {
        $cardlog = new CardLog();
        $historylog = new HistoryLog();
        $moneylog = new MoneyLog();
        $adminpanel = new AdminPanel();
        $account = new Account();
        if (isset($request->Code) && isset($request->Mess) && isset($request->Reason) && isset($request->CardValue) && isset($request->TrxID)) {
            $note = $request->TrxID;
            $data = $cardlog->loadCardInfo($note);
            $seri = $data['seri'];
            $pin = $data['pin'];
            $value = $request->CardValue;
            $username = $data['username'];

            if ($request->Code == 1) {

                $code = 1;
                $getpromotion = $adminpanel->getPromotion('tlkmnapthe');
                $valuepromotion = $getpromotion['valuepromotion'];
                $money = ($value / 100) * $valuepromotion;
                $result = $account->getUserByUserName($username);
                //dd($result);
                if ($result != null) {
                    $moneyold = $result['money'];
                    $moneynew = $result['money'] + $money;
                    $cardlog->updateCardLogTopUp($code, $money, $value, 'tichhop247.com', $note);
                    $historylog->updateHistoryLogTopUp($code, $note);
                    $moneylog->addMoneyLog($username, 'PrepaidCard', $moneyold, $moneynew);
                    $account->updateMoneyTopUp($username, $moneynew);
                    $logcontent = "Xu ly thanh cong !! --> seri: $seri - pin: $pin - note: $note menh gia: $value";
                    //writeLog($logcontent,'ipnsuccess.log');
                    Log::channel('ipnsuccess')->info($logcontent);
                }
            } else if ($request->Code == 2 || $request->Code == 3) {

                $code = 3;
                $getpromotion = $adminpanel->getPromotion('tlkmnapthe');
                $valuepromotion = $getpromotion['valuepromotion'];
                $money = ($value / 100) * $valuepromotion;
                $result = $account->getUserByUserName($username);
                if ($result != null) {
                    $moneyold = $result['money'];
                    $moneynew = $result['money'] + $money;

                    $cardlog->updateCardLogTopUp($code, $money, $value, 'tichhop247.com', $note);
                    $historylog->updateHistoryLogTopUp($code, $note);
                    $moneylog->addMoneyLog($username, 'PrepaidCard', $moneyold, $moneynew);
                    $account->updateMoneyTopUp($username, $moneynew);

                    $logcontent = "Xu ly thanh cong, sai menh gia !! --> seri: $seri - pin: $pin - note: $note menh gia: $value";
                    //writeLog($logcontent,'ipnsuccess.log');
                    Log::channel('ipnsuccess')->info($logcontent);
                }
            } else if ($request->Code == 5) {

                $code = 5;
                $cardlog->updateCardLogTopUp($code, '0', '0', 'tichhop247.com', $note);
                $historylog->updateHistoryLogTopUp($code, $note);
                $logcontent = "Xu ly thanh cong, the sai !! --> seri: $seri - pin: $pin - note: $note menh gia: $value";
                // writeLog($logcontent,'ipnfailed.log');
                Log::channel('ipnfailed')->info($logcontent);

            } else {

                $code = 99;
                $cardlog->updateCardLogTopUp($code, '0', '0', 'tichhop247.com', $note);
                $historylog->updateHistoryLogTopUp($code, $note);
                $logcontent = "Xu ly khong thanh cong !! --> seri: $seri - pin: $pin - note: $note menh gia: $value";
                //writeLog($logcontent,'ipnfailed.log');
                Log::channel('ipnfailed')->info($logcontent);

            }
        } else {
            $logcontent = "Khong du tham so !! --> seri: " . $request->Code . "  pin: " . $request->Mess;
            //writeLog($logcontent,'ipnerror.log');
            Log::channel('ipnerror')->info($logcontent);
            exit();
        }
        return '123';
    }

    public function topUpMoMo()
    {
        return view('clients.topUpMoMo')->with($this->getinfo->getDataUser());
    }
}
