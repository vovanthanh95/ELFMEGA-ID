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
        $data = Agency::where('type','ATM')->get()->toArray()[0];
        return $data;
    }
    public function getAgencyWallet($name){
        $data = Agency::where('name',$name)->get()->toArray()[0];
        return $data;
    }
}
