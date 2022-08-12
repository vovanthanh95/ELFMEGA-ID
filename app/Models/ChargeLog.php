<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeLog extends Model
{
    use HasFactory;
    protected $table = "charge_log";
    public $timestamps = false;

    public function addChargeLog($username, $serverid, $money, $transcode, $roleid, $status, $productid)
    {

        try {
            $data = new ChargeLog();
            $data->username = $username;
            $data->time = date("Y-m-d H:i:s");
            $data->serverid = $serverid;
            $data->money = $money;
            $data->transcode = $transcode;
            $data->productid = $productid;
            $data->uid = $roleid;
            $data->status = $status;
            $data->save();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function checkPay($username,$serverid, $money, $transcode, $roleid, $productid){
        $data = ChargeLog::where('username',$username)
        ->where('serverid', $serverid)
        ->where('money', $money)
        ->where('transcode', $transcode)
        ->where('productid', $productid)
        ->where('uid', $roleid)
        ->first();
        if($data != null){
            $data->status = 1;
            $data->save();
            return true;
        }
        return false;
    }
}
