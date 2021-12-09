<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerPushTest extends Controller
{
    public function client(){
        return view("test/client");
    }

    public function server(){
        return view("test/server");
    }
}
