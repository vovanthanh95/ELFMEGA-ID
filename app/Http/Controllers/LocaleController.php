<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function setLocale(Request $request){
        $language = $request->language;
        Session::put('language', $language);
        return redirect()->back();
    }
}
