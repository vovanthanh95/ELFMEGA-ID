<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;
    protected $table = "agency";
    public $timestamps = false;
    public function getAgencyATM(){
        $data = Agency::where('type','ATM')->first();
        if($data != null){
            return $data->toArray();
        }
        return [];
    }
    public function getAgencyWallet($name){
        $data = Agency::where('name',$name)->first();
        if($data != null){
            return $data->toArray();
        }
        return [];
    }
}
