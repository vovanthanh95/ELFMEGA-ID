<?php

namespace App\Http\Controllers;

use App\Classes\GetInfo;
use App\Models\GiftCode;
use App\Models\GiftLog;
use App\Models\GiftMultipleCode;
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
        return view('clients.giftCode')->with($this->getinfo->getDataUser());
    }

    public function postGiftCode(Request $request)
    {
        $tplayer = new TPlayer();
        $giftcode = new GiftCode();
        $giftmultiplecode = new GiftMultipleCode();
        $giftlog = new GiftLog();

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
                            $info['msg'] = 'giftcodehasbeenused';
                        } else {
                            // $addlog = addLogGift($code, $codeRes['giftcode'], $rid, $username, $serverid, 0);
                            // if ($addlog == 1) {
                            //     $return = addSendMail($codeRes['listgoods'], $loadrole['playerId'], $loadrole['currentServer'], $codeRes['title'], $codeRes['content']);
                            //     if ($return == 0) {
                            //         $content = $code . "|" . $rid . "|" . $serverid;
                            //         addHistory($username, "GiftCode", $content);
                            //         $json['status'] = 0;
                            $info['type'] = 'error';
                            $info['msg'] = 'successfulreceiptpleasecheckingameletter';
                            //     } else {
                            //         $json['status'] = 1;
                            //         $json['msg'] = "Nhận Giftcode thất bại, vui lòng liên hệ fanpage để được hỗ trợ";
                            //     }
                            // } else {
                            //     $json['status'] = 1;
                            //     $json['msg'] = "Nhận Giftcode thất bại";
                            // }
                        }
                    } else {
                        $checkIsMutiCode = $giftmultiplecode->checkIsMutiCode($codeRes['giftcode'], $code, $username);
                        $loggift = $giftmultiplecode->checkLogMutiCodeRid($codeRes['giftcode'], $loadrole['playerId'], $username);
                        $loggift2 = $giftlog->checkLogCodeRid($codeRes['giftcode'], $loadrole['playerId'], $username);
                        if ($checkIsMutiCode == 0) {
                            $info['type'] = 'error';
                            $info['msg'] = 'giftcodehasexpired';
                        } else if ($loggift == 1) {
                            $info['type'] = 'error';
                            $info['msg'] = 'giftcodehasbeenused';
                        } else if ($loggift2 == 1) {
                            $info['type'] = 'error';
                            $info['msg'] = 'giftcodehasbeenused';
                        } else {
                            // $addlog = addLogGift($code, $codeRes['giftcode'], $rid, $username, $serverid, 1);
                            // if ($addlog == 1) {
                            //     $return = addSendMail($codeRes['listgoods'], $loadrole['playerId'], $loadrole['currentServer'], $codeRes['title'], $codeRes['content']);
                            //     if ($return == 0) {
                            //         $content = $code . "|" . $rid . "|" . $serverid;
                            //         addHistory($username, "GiftCode", $content);
                            //         $json['status'] = 0;
                            $info['type'] = 'succes';
                            $json['msg'] = 'successfulreceiptpleasecheckingameletter';
                            //     } else {
                            //         $json['status'] = 1;
                            //         $json['msg'] = "Nhận Giftcode thất bại, vui lòng liên hệ fanpage để được hỗ trợ";
                            //     }
                            // } else {
                            //     $json['status'] = 1;
                            //     $json['msg'] = "Nhận Giftcode thất bại";
                            // }
                        }
                    }
                }
            } else {
                $info['type'] = 'error';
                $info['msg'] = 'giftcodehasexpired';
            }
        } else {
            $info['type'] = 'error';
            $info['msg'] = 'thegiftcodeisincorrect';
        }
        return redirect()->route('gift-code')->with($info);
    }
}
