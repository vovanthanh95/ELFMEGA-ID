<?php

namespace App\Http\Controllers;

use App\Classes\GetInfo;

class TopUpController extends Controller
{
    public $getinfo;
    public function __construct(){
        $this->getinfo = new GetInfo();
    }
    public function topUp()
    {
        return view('clients.topUp')->with($this->getinfo->getDataUser());
    }

    public function topUpVn()
    {
        return view('clients.topUpVn')->with($this->getinfo->getDataUser());
    }

    public function topUpMoMo()
    {
        return view('clients.topUpMoMo')->with($this->getinfo->getDataUser());
    }
}
