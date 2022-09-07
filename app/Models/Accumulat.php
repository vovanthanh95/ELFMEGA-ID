<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accumulat extends Model
{
    use HasFactory;
    protected $table = "accumulat";
    public $timestamps = false;
    
    public function getAccumulat()
    {
        try {
            $data = Accumulat::get()->toArray();
            return $data;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function getMoneyAccumulat($id){
        try {
            $data = Accumulat::where('id',$id)->first();
            if($data != null){
                return $data->money;
            }
            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
