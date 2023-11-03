<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('Page.Dashboard.dashboard');
    }
    public function testpage()
    {
        return view('Page.Test.show');
    }
}

