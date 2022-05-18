<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCode extends Model
{
    use HasFactory;
    protected $table = "gift_code";
    public $timestamps = false;

    public function checkGiftCode($giftcode){
        $data = GiftCode::select('giftcode', 'start', 'end', 'serverid', 'title', 'content', 'listgoods', 'ismuti')
        ->where('giftcode','=',$giftcode)
        ->limit(1)
        ->get()->toArray();
        if (!empty($data)) {
            return $data[0];
        }
        return 0;
    }
}
