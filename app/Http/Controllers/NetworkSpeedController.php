<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\SpeedTest;


class NetworkSpeedController extends Controller
{ 
    public function index()
    {
        return view('speed');
    }

    public function store(Request $request)
    {
        // Terima data kecepatan unduh dari sisi klien
        $downloadSpeed = $request->input('download_speed');

        // Simpan kecepatan unduh ke database
        SpeedTest::create([
            'download_speed' => $downloadSpeed,
        ]);

        // Tampilkan hasil kecepatan unduh
        return response()->json(['download_speed' => $downloadSpeed]);
    }
    
}
