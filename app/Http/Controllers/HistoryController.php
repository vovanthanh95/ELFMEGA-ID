<?php

namespace App\Http\Controllers;

use App\Classes\GetInfo;

class HistoryController extends Controller
{
    public $getinfo;
    public function __construct()
    {
        $this->getinfo = new GetInfo();
    }

    public function history()
    {
        return view('clients.history2')->with($this->getinfo->getDataUser());
    }
}
