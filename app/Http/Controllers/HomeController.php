<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Lokasi;
use App\Models\Pengaduan;

class HomeController extends Controller
{
    public function index()
    {


        $pengaduan = Pengaduan::all();

        $terkirimCount = $pengaduan->where('status', 'Terkirim')->count();
        $prosesCount = $pengaduan->where('status', 'Proses')->count();
        $selesaiCount = $pengaduan->where('status', 'Selesai')->count();
    
        return view('Page.Dashboard.dashboard', compact('terkirimCount','prosesCount','selesaiCount'));
    }

  
}
