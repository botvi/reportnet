<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Lokasi;

class HomeController extends Controller
{
    public function index()
    {


        return view('Page.Dashboard.dashboard');
    }
    // public function index()
    // {
    //     $lokasis = Lokasi::all();
    //     $speeds = $this->getNetworkSpeeds($lokasis);

    //     return view('Page.Dashboard.dashboard', compact('lokasis', 'speeds'));
    // }

    // private function getNetworkSpeeds($lokasis)
    // {
    //     $client = new Client();
    //     $speeds = [];
    
    //     foreach ($lokasis as $lokasi) {
    //         $ip = $lokasi->ip_instansi;
    
    //         if (empty($ip) || !filter_var($ip, FILTER_VALIDATE_IP)) {
    //             \Log::error("Invalid or empty IP for {$lokasi->name} (ID: {$lokasi->id}): {$ip}");
    //             $speeds[$lokasi->id] = null;
    //             continue;
    //         }
    
    //         try {
    //             $response = $client->get($ip);
    //             $download_time = $response->getBody()->getSize();
    //             $file_size = $download_time / 1024 / 1024; // in megabytes
    //             $speeds[$lokasi->id] = round($file_size, 2); // in MB
    //         } catch (\Exception $e) {
    //             $speeds[$lokasi->id] = null;
    //             \Log::error("Error fetching speed for {$lokasi->name} (ID: {$lokasi->id}): {$e->getMessage()}");
    //         }
    //     }
    
    //     return $speeds;
    // }
    
}
