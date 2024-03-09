<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiMikrotik;
use App\Models\Instansi;


class TrafficController extends Controller
{

    public function traffic()
    {
        
        $API = new ApiMikrotik();
        $API->debug = false;

        if ($API->connect('192.168.10.1', 'admin', '1')) {
            // Ambil data Instansi dari database
            $instansiData = Instansi::all();

            $trafficData = [];

            foreach ($instansiData as $instansi) {
                $interface = $instansi->nama_instansi;

                $traffic = $API->comm('/interface/monitor-traffic', array(
                    'interface' => $interface,
                    'once' => '',
                ));

                $rx = $traffic[0]['rx-bits-per-second'];
                $tx = $traffic[0]['tx-bits-per-second'];

                $trafficData[] = [
                    'interface' => $interface,
                    'rx' => $rx,
                    'tx' => $tx,
                    'url' => 'http://127.0.0.1:8000/' . urlencode($interface), // URL sesuai dengan nama_instansi
                ];
            }

            $API->disconnect();

            return view('traffic', ['trafficData' => $trafficData]);
        } else {
            return view('failed');
        }
    }

    
}
