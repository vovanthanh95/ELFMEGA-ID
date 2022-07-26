<?php

namespace App\Http\Controllers;

use App\Classes\GetInfo;


class ClientController extends Controller
{
    public $getinfo;
    public function __construct()
    {
        $this->getinfo = new GetInfo();
    }
    public function index()
    {
        return view('clients.account')->with($this->getinfo->getDataUser());
    }
}
