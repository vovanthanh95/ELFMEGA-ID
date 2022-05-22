<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPanel extends Model
{
    use HasFactory;
    protected $table = "admin_panel";
    public $timestamps = false;

    public function getPromotion($type) {
        $return = array();
        $transfer = 0;
        $result = AdminPanel::where('type',$type)->first();
        if ($result != null){
            $data = $result->toArray();
            $promotion = $this->loadPanel('tlnapthe', 'value');
            $now = date("Y-m-d H:i:s");
            if($now >= $data['time_start'] && $now <= $data['time_end']) {
                $transfer = $promotion + ($data['value'] * ($promotion / 100));
                // 100 + (50*(100/100))
                $return['ispromotion'] = $data['value'];
                $return['startpromotion'] = $data['time_start'];
                $return['endpromotion'] = $data['time_end'];
                $return['valuepromotion'] = $transfer;
            } else {
                $transfer = $promotion;
                $return['ispromotion'] = 0;
                $return['valuepromotion'] = $transfer;
            }
        }
        return $return;
    }

    public function loadPanel($type, $key) {
        $info = "";
        $data = AdminPanel::where('type',$type)->first();
        if ($data != null){
            $info = $data->toArray()[$key];
        }
        return $info;
    }

}
