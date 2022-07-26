<?php

namespace App\Http\Controllers;

use App\Classes\GetInfo;
use App\Models\CardLog;

class HistoryController extends Controller
{
    public $getinfo;
    public function __construct()
    {
        $this->getinfo = new GetInfo();
    }

    public function history()
    {
        $cardlog = new CardLog();
        $data = $cardlog->getAll();
        return view('clients.history')->with($this->getinfo->getDataUser())->with(compact('data'));
    }
}
