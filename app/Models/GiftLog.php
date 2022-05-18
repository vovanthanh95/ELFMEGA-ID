<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftLog extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = "gift_log";
    public $timestamps = false;

    public function checkLogCodeRid($giftcode = '3QBADAO', $rid = '0', $username = 'toaigvm')
    {
        $data = GiftLog::select('id')
            ->where('giftcode', '=', $giftcode)
            ->where('username', '=', $username)
            ->limit(1)->get()->toArray();
        if (!empty($data)) {
            return 1;
        }
        return 0;
    }

    public function checkLogCodeRidAll($giftcode, $rid = "0", $username, $serverid)
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
}
