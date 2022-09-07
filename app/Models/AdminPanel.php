<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPanel extends Model
{
    use HasFactory;
    protected $table = "admin_panel";
    public $timestamps = false;

    public function getPromotion($type,$type2='tlnapthe') {
        $return = array();
        $transfer = 0;
        $result = AdminPanel::where('type',$type)->first();
        if ($result != null){
            $data = $result->toArray();
            $promotion = $this->loadPanel($type2, 'value');
            $now = date("Y-m-d H:i:s");
            if($now >= $data['time_start'] && $now <= $data['time_end']) {
                $transfer = $promotion + ($data['value'] * ($promotion / 100));
                $return['ispromotion'] = $data['value'];
                $return['startpromotion'] = $data['time_start'];
                $return['endpromotion'] = $data['time_end'];
                $return['valuepromotion'] = $transfer;
                $return['discount'] = $promotion;
            } else {
                $transfer = $promotion;
                $return['ispromotion'] = 0;
                $return['valuepromotion'] = $transfer;
                $return['discount'] = $promotion;
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

    public function checkAccumulat(){
        try {
            $now = date("Y-m-d H:i:s");
            $data = AdminPanel::where('type','mocnap')
            ->where('time_start','<', $now)
            ->where('time_end','>', $now)
            ->first();
            if($data != null){
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getTimeAccumulat(){
        return AdminPanel::where('type','mocnap')->get()->toArray()[0];
    }

}
