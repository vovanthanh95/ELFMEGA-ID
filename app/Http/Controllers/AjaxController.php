<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;
use App\Models\TPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function showRole()
    {
        $tplayer = new TPlayer();
        $char = $tplayer->showRole(Auth::guard('client')->user()->username);
        return $char;
    }

    public function ajaxHistory()
    {
        $history = new HistoryLog();
        //dd($history->getHistoryLog(Auth::guard('client')->user()->username));
        return response()->json($history->getHistoryLog(Auth::guard('client')->user()->username));
        //return response()->json(request()->page);
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
