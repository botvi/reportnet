<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instansi;
use App\Models\ApiMikrotik;


class MapController extends Controller
{
    public function index()
    {
        // Ambil data Instansi dari database
        $instansi = Instansi::all();

        return view('Page.Maps.show', compact('instansi'));
    }

  

}