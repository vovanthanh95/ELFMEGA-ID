<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\isEmpty;

class TPlayer extends Model
{
    use HasFactory;
    protected $table = "t_player";
    public $timestamps = false;
    protected $primaryKey = 'playerId';
    protected $connection = 'mysql2';
    protected $fillable = [
        'playerId',
        'accountUid',
        'createServer',
        'createServer',
        'level',
        'name',
        'isForbid',
        'currentServer',
    ];

    public function showRole($username = 'toaigvm')
    {
        $data = TPlayer::select('playerId', 'accountId', 'name')
            ->join('t_account', 't_player.accountUid', '=', 't_account.uid')
            ->where('accountId', '=', $username)
            ->get();
            if ($data != null) {
                return $data->toArray();
            }
            return 0;
    }

    public function loadRole($username = 'toaigvm', $rid = '542776504867')
    {
        $data = TPlayer::select('playerId', 't_player.currentServer', 'accountId', 'name')
            ->join('t_account', 't_player.accountUid', '=', 't_account.uid')
            ->where('accountId', '=', $username)
            ->where('playerId', '=', $rid)
            ->first();
        if ($data != null) {
            return $data->toArray();
        }
        return 0;
    }
}
