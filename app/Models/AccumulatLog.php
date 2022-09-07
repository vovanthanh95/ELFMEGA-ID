<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AccumulatLog extends Model
{
    use HasFactory;
    protected $table = "accumulat_log";
    public $timestamps = false;

    public function checkGiftCode($idaccumulat)
    {
        try {
            $adminpanel = AdminPanel::where('type', 'mocnap')->first();
            $data = AccumulatLog::where('username', Auth::guard('client')->user()->username)
                ->where('idaccumulat', $idaccumulat)
                ->where('time', '>=', $adminpanel->time_start)
                ->where('time', '<=', $adminpanel->time_end)
                ->first();

            if ($data != null) {
                return $data->giftcode;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function addAccumulatLog($giftcode, $idaccumulat, $curaccumulat)
    {
        try {
            $data = new AccumulatLog();
            $data->username = Auth::guard('client')->user()->username;
            $data->time = date("Y-m-d H:i:s");
            $data->giftcode = $giftcode;
            $data->idaccumulat = $idaccumulat;
            $data->curaccumulat = $curaccumulat;
            $data->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
