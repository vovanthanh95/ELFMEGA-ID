<?php

namespace App\Http\Controllers;

use App\Models\OnlineLog;
use Illuminate\Http\Request;

class CheckOnlineController extends Controller
{
    public function index(Request $request)
    {
        $checkonline = new OnlineLog();
        if (isset($request->num) && isset($request->svr)) {
            $checkonline->setOnline($request->num, $request->svr);
        }
;    }
}
