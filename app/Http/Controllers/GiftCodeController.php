<?php

namespace App\Http\Controllers;

use App\Classes\GetInfo;
use App\Classes\SendMail;
use App\Models\GiftCode;
use App\Models\GiftLog;
use App\Models\GiftMultipleCode;
use App\Models\HistoryLog;
use App\Models\TPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftCodeController extends Controller
{
    public $getinfo;
    public function __construct()
    {
        $this->getinfo = new GetInfo();
    }

    public function giftCode()
    {
        return view('clients.giftcode2')->with($this->getinfo->getDataUser());
    }

    public function postGiftCode(Request $request)
    {
        $rule = [
            'code' => 'required',
            'rid' => 'required|numeric',
            //'captcha' => 'required|captcha',
        ];
        $message = [
            'code.required' => 'Vui lòng nhập giftcode',
            'rid.numeric' => 'vui lòng chọn nhân vật',
            //'captcha.required' => 'Captcha không được trống',
            //'captcha.captcha' => 'Captcha không đúng',
        ];
        $request->validate($rule, $message);

        $tplayer = new TPlayer();
        $giftcode = new GiftCode();
        $giftmultiplecode = new GiftMultipleCode();
        $giftlog = new GiftLog();
        $historylog = new HistoryLog();
        $sendmail = new SendMail();

        $serverid    = $request->session()->get('serverid');
        $username    = Auth::guard('client')->user()->username;
        $rid = $request->rid;
        $code = $request->code;
        $loadrole    = $tplayer->loadRole($username, $rid, $serverid);


        $info = [];
        $codeRes = array();
        $checkGiftCode = $giftcode->checkGiftCode($code);
        if ($checkGiftCode != 0) {
            $codeRes = $checkGiftCode;
        }
        $checkMutiGiftCode = $giftmultiplecode->checkMutiGiftCode($code);
        //dd($checkMutiGiftCode);
        if ($checkMutiGiftCode != 0) {
            $codeRes = $giftcode->checkGiftCode($checkMutiGiftCode['giftcode']);
        }
        // dd($codeRes);
        if ($codeRes) {

            if (date("Y-m-d H:i:s") > $codeRes['start'] and date("Y-m-d H:i:s") < $codeRes['end']) {
                if ($codeRes['serverid'] > 0 && $serverid != $codeRes['serverid']) {
                    $info['type'] = 'error';
                    $info['msg'] = "Giftcode không hỗ trợ máy chủ này";
                } else {
                    $ismuti = $codeRes['ismuti'];
                    if ($ismuti == 0) {
                        $loggift = $giftlog->checkLogCodeRidAll($codeRes['giftcode'], $loadrole['playerId'], $username, $serverid);
                        if ($loggift == 1) {
                            $info['type'] = 'error';
                            $info['msg'] = __('message.giftcodehasbeenused');
                        } else {
                            $addlog = $giftlog->addLogGift($code, $codeRes['giftcode'], $rid, $username, $serverid, 0);
                            if ($addlog == 1) {
                                $return = 0;
                                //$sendmail->addSendMail($codeRes['listgoods'], $loadrole['playerId'], $loadrole['currentServer'], $codeRes['title'], $codeRes['content']);
                                if ($return == 0) {
                                    $content = $code . "|" . $rid . "|" . $serverid;
                                    $historylog->createHistory($username, "GiftCode", $content);
                                    $info['type'] = 'success';
                                    $info['msg'] = __('message.successfulreceiptpleasecheckingameletter');
                                } else {
                                    $info['type'] = 'error';
                                    $info['msg'] = "Nhận Giftcode thất bại, vui lòng liên hệ fanpage để được hỗ trợ";
                                }
                            } else {
                                $info['type'] = 'error';
                                $json['msg'] = "Nhận Giftcode thất bại";
                            }
                        }
                    } else {
                        $checkIsMutiCode = $giftmultiplecode->checkIsMutiCode($codeRes['giftcode'], $code, $username);
                        $loggift = $giftmultiplecode->checkLogMutiCodeRid($codeRes['giftcode'], $loadrole['playerId'], $username);
                        $loggift2 = $giftlog->checkLogCodeRid($codeRes['giftcode'], $loadrole['playerId'], $username);
                        if ($checkIsMutiCode == 0) {
                            $info['type'] = 'error';
                            $info['msg'] = __('message.giftcodehasexpired');
                        } else if ($loggift == 1) {
                            $info['type'] = 'error';
                            $info['msg'] = __('message.giftcodehasbeenused');
                        } else if ($loggift2 == 1) {
                            $info['type'] = 'error';
                            $info['msg'] = __('message.giftcodehasbeenused');
                        } else {
                            $addlog = $giftlog->addLogGift($code, $codeRes['giftcode'], $rid, $username, $serverid, 1);
                            if ($addlog == 1) {
                                $return = 0;
                                //$sendmail->addSendMail($codeRes['listgoods'], $loadrole['playerId'], $loadrole['currentServer'], $codeRes['title'], $codeRes['content']);
                                if ($return == 0) {
                                    $content = $code . "|" . $rid . "|" . $serverid;
                                    $historylog->createHistory($username, "GiftCode", $content);
                                    $info['type'] = 'success';
                                    $info['msg'] = __('message.successfulreceiptpleasecheckingameletter');
                                } else {
                                    $info['type'] = 'error';
                                    $info['msg'] = "Nhận Giftcode thất bại, vui lòng liên hệ fanpage để được hỗ trợ";
                                }
                            } else {
                                $info['type'] = 'error';
                                $info['msg'] = "Nhận Giftcode thất bại";
                            }
                        }
                    }
                }
            } else {
                $info['type'] = 'error';
                $info['msg'] = __('message.giftcodehasexpired');
            }
        } else {
            $info['type'] = 'error';
            $info['msg'] = __('message.thegiftcodeisincorrect');
        }
        return redirect()->route('gift-code')->with($info);
    }
}
