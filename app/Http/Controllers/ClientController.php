<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke($url = "home", $url2 = '')
    {
        $url = $url . '/' . $url2;
        return view('client', ['url' => $url]);
    }
}
