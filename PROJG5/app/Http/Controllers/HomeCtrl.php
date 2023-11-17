<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeCtrl extends Controller
{
    public function home()
    {
        return view('home');
    }
}
