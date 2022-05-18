<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TAccount extends Model
{
    use HasFactory;
    protected $table = "t_account";
    public $timestamps = false;
    protected $primaryKey = 'uid';
    protected $connection = 'mysql2';
    protected $fillable = [
        'uid',
        'accountId',
        'createTime',
        'ip',
        'lastLoginTime',
        'createServer',
        'currentServer',
        'areaId',
        'channel',
        'isforbid',
    ];

}
