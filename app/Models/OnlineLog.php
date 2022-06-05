<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineLog extends Model
{
    use HasFactory;
    protected $table = "online_log";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'onlinecount',
        'serverid',
        'time',
    ];

    public function setOnline($num, $svr){
        $data = new OnlineLog();
        $data->onlinecount = $num;
        $data->serverid = $svr;
        $data->time = date("Y-m-d H:i:s");
        $data->save();
    }
}
