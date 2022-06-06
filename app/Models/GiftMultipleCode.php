<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftMultipleCode extends Model
{
    use HasFactory;
    protected $table = "gift_multiple_code";
    public $timestamps = false;
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'status', 'username', 'rid', 'serverid', 'time'
    ];

    public function checkLogMutiCodeRid($giftcode, $code, $rid, $username)
    {
        $data = GiftMultipleCode::select('code')
            ->where('giftcode', '=', $giftcode)
            ->where('status', '=', 1)
            ->where('rid', '=', $rid)
            ->where('username', '=', $username)
            ->limit(1)->get()->toArray();
        if (!empty($data)) {
            return 1;
        }
        return 0;
    }

    public function checkIsUsed($giftcode, $code)
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

    public function checkMutiGiftCode($code)
    {
        $data = GiftMultipleCode::select('code', 'giftcode', 'status')
            ->where('code', '=', $code)
            ->where('status', '=', 0)
            ->limit(1)->get()->toArray();
        if (!empty($data)) {
            return $data[0];
        } else {
            return 0;
        }
    }

    public function addLogMutiGift($code, $giftcode, $rid, $username, $serverid, $ismuti)
    {
        $giftmultiplecode = GiftMultipleCode::where('code', '=', $code)->first();
        $giftmultiplecode->status = 1;
        $giftmultiplecode->username = $username;
        $giftmultiplecode->rid = $rid;
        $giftmultiplecode->serverid = $serverid;
        $giftmultiplecode->time = date("Y-m-d H:i:s");
        if ($giftmultiplecode->save()) {
            return 1;
        } else {
            return 0;
        }
    }
}
