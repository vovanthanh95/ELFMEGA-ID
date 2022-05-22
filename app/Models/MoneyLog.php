<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyLog extends Model
{
    use HasFactory;
    protected $table = "money_log";
    public $timestamps = false;

    protected $fillable = [
        'username',
        'type',
        'money_old',
        'money_new',
        'time',
    ];

    public function addMoneyLog($username, $type, $money_old, $money_new)
    {
        $data = new MoneyLog();
        $data->username = $username;
        $data->type = $type;
        $data->money_old = $money_old;
        $data->money_new = $money_new;
        $data->time = date("Y-m-d H:i:s");
        $data->save();
    }
}
