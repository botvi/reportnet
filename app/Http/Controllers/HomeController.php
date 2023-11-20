<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;


class HomeController extends Controller
{

    public function index()
    {
        $lokasis = Lokasi::all();
        return view('Page.Dashboard.dashboard', compact('lokasis'));
    }
   

   
}

