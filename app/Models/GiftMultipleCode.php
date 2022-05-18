<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftMultipleCode extends Model
{
    use HasFactory;
    protected $table = "gift_multiple_code";
    public $timestamps = false;
    protected $fillable = [
        'status', 'username', 'rid', 'serverid', 'time'
    ];

    public function checkLogMutiCodeRid($giftcode = 'LOANTINS3', $rid = '0', $username = 'davidchonb')
    {
        $data = GiftMultipleCode::select('code')
            ->where('giftcode', '=', $giftcode)
            ->where('status', '=', 1)
            ->where('username', '=', $username)
            ->limit(1)->get()->toArray();
        if (!empty($data)) {
            return 1;
        }
        return 0;
    }

    public function checkIsMutiCode($giftcode = 'LOANTINS3', $code = '12KYWITZT')
    {
        $data = GiftMultipleCode::select('code')
            ->where('giftcode', '=', $giftcode)
            ->where('status', '=', 0)
            ->where('code', '=', $code)
            ->limit(1)->get()->toArray();
        if (!empty($data)) {
            return 1;
        }
        return 0;
    }

    public function checkMutiGiftCode($code = '1389YY7GWS')
    {
        $data = GiftMultipleCode::select('code', 'giftcode', 'status')
            ->where('code', '=', $code)
            ->where('status', '=', 0)
            ->limit(1)->get()->toArray();
        if (!empty($data)) {
            return $data[0];
        }
        return 0;
    }

    public function addLogMutiGift($code, $giftcode, $rid, $username, $serverid, $ismuti)
    {
        global $conn_web;
        $time = date("Y-m-d H:i:s");
        $sql = "UPDATE gift_multiple_code SET status = '1', username = '$username', rid = '$rid', serverid = '$serverid', time = '$time'  WHERE code = '$code'";
        $giftmultiplecode = GiftMultipleCode::where('code', '=', $code)->first();
        $giftmultiplecode->status = 1;
        $giftmultiplecode->username = $username;
        $giftmultiplecode->rid = $rid;
        $giftmultiplecode->serverid = $serverid;
        $giftmultiplecode->time = date("Y-m-d H:i:s");
        $giftmultiplecode->save();

        if ($giftmultiplecode->save()) {
            return 1;
        } else {
            return 0;
        }
    }
}
