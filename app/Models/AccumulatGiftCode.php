<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccumulatGiftCode extends Model
{
    use HasFactory;
    protected $table = "accumulat_giftcode";
    public $timestamps = false;

    public function getGiftCode($idaccumulat)
    {
        try {
            $data = AccumulatGiftCode::where('status', 0)
                ->where('idaccumulat', $idaccumulat)
                ->first();
            if ($data != null) {
                $data->status = 1;
                $data->save();
                return $data->giftcode;
            }
            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
