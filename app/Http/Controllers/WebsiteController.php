<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('website.index');
    }
    public function pengaduan()
    {
        return view('website.pengaduan');
    }
    public function tentang()
    {
        return view('website.tentang');
    }
}
