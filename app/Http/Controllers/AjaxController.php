<?php

namespace App\Http\Controllers;


use App\Models\TPlayer;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function showRole(){
        $tplayer = new TPlayer();
        $char = $tplayer->showRole(Auth::guard('client')->user()->username);
        return $char;
    }
}
