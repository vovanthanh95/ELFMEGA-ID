<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeLog extends Model
{
    use HasFactory;
    protected $table = "charge_log";
    public $timestamps = false;

    public function addChargeLog($username, $serverid, $money, $transcode, $roleid, $status)
    {

        try {
            $data = new ChargeLog();
            $data->username = $username;
            $data->time = date("Y-m-d H:i:s");
            $data->serverid = $serverid;
            $data->money = $money;
            $data->transcode = $transcode;
            $data->roleid = $roleid;
            $data->status = $status;
            $data->save();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
