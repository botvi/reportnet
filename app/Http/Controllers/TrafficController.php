<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiMikrotik;
use App\Models\Instansi;
use App\Models\LoginMikrotik;

class TrafficController extends Controller
{
    public function traffic()
    {
        // Retrieve Mikrotik connection details from the LoginMikrotik model
        $mikrotikLogin = LoginMikrotik::first();

        if (!$mikrotikLogin) {
            return view('failed')->with('error', 'Mikrotik login details not found.');
        }

        $API = new ApiMikrotik();
        $API->debug = false;

        if ($API->connect($mikrotikLogin->ip, $mikrotikLogin->username, $mikrotikLogin->password)) {
            // Retrieve instansi data from the database
            $instansiData = Instansi::all();

            $trafficData = [];

            foreach ($instansiData as $instansi) {
                $interface = $instansi->nama_instansi;

                $traffic = $API->comm('/interface/monitor-traffic', [
                    'interface' => $interface,
                    'once' => '',
                ]);

                $rx = $traffic[0]['rx-bits-per-second'];
                $tx = $traffic[0]['tx-bits-per-second'];

                // Determine the base URL
                $baseURL = env('APP_URL', 'http://127.0.0.1:8000');
                if (strpos($baseURL, '127.0.0.1') === false) {
                    $baseURL = 'https://mhdripaldi.pandekakode.com';
                }

                $trafficData[] = [
                    'interface' => $interface,
                    'rx' => $rx,
                    'tx' => $tx,
                    'url' => $baseURL . '/' . urlencode($interface), // URL sesuai dengan nama_instansi
                ];
            }

            $API->disconnect();

            return view('traffic', ['trafficData' => $trafficData]);
        } else {
            return view('failed');
        }
    }
}
