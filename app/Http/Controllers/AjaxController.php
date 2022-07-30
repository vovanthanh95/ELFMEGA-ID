<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function ajaxHistory()
    {
        $history = new HistoryLog();
        return response()->json($history->getHistoryLog(Auth::guard('client')->user()->username));
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
