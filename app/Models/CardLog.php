<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CardLog extends Model
{
    use HasFactory;
    protected $table = "card_log";
    public $timestamps = false;

    public function checkCardLog($card_password, $card_serial)
    {
        $data = CardLog::where('seri', $card_serial)
            ->where('pin', $card_password)->first();
        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }

    public function loadCardInfo($note)
    {
        $data = [];
        $result = CardLog::select('username', 'seri', 'pin', 'note')
            ->where('note', $note)->first();
        if ($result != null) {
            $data = $result->toArray();
        }
        return $data;
    }

    public function addCardLog($username, $card_name, $card_serial, $card_password, $card_value, $note)
    {
        $data = new CardLog();
        $data->username = $username;
        $data->type = $card_name;
        $data->seri = $card_serial;
        $data->pin = $card_password;
        $data->amount = $card_value;
        $data->money = 0;
        $data->time = date("Y-m-d H:i:s");
        $data->note = $note;
        $data->save();
    }

    public function updateCardLogTopUp($status, $money, $amount, $checkagency, $note)
    {
        $data = CardLog::where('note', $note)->first();
        $data->status = $status;
        $data->money = $money;
        $data->amount = $amount;
        $data->checktime = date("Y-m-d H:i:s");
        $data->checkagency = $checkagency;
        $data->save();
    }

    public function getAll()
    {
        $data = CardLog::where('username', Auth::guard('client')->user()->username)
            ->orderby('time', 'DESC')
            ->limit(10)
            ->get();
        return $data;
    }
}
