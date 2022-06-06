<?php

namespace App\Models;

use App\Http\Controllers\GiftCodeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftLog extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = "gift_log";
    public $timestamps = false;

    public function checkLogCodeRid($giftcode, $rid, $username)
    {
        $data = GiftLog::select('id')
            ->where('giftcode', '=', $giftcode)
            ->where('username', '=', $username)
            ->where('rid', '=', $rid)
            ->limit(1)->get()->toArray();
        if (!empty($data)) {
            return 1;
        }
        return 0;
    }

    public function checkLogCodeRidAll($giftcode, $rid, $username, $serverid)
    {
        $data = GiftLog::select('id')
            ->where('giftcode', '=', $giftcode)
            ->where('username', '=', $username)
            ->where('serverid', '=', $serverid)
            ->limit(1)->get()->toArray();
        if (!empty($data)) {
            return 1;
        }
        return 0;
    }

    public function addLogGift($code, $giftcode, $rid, $username, $serverid, $ismuti)
    {
        $log = new GiftLog();
        $log->rid = $rid;
        $log->giftcode = $giftcode;
        $log->time = date("Y-m-d H:i:s");
        $log->serverid = $serverid;
        $log->username = $username;
        $log->status = 1;
        $log->code = $code;
        if ($ismuti == 1) {
            $giftmultiplecode = new GiftMultipleCode();
            $giftmultiplecode->addLogMutiGift($code, $giftcode, $rid, $username, $serverid, $ismuti);
        }
        if ($log->save()) {
            return 1;
        } else {
            return 0;
        }
    }
}
