<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NetworkSpeedController extends Controller
{
    public function index()
    {
        return view('speed');
    }

    public function measureSpeed(Request $request)
    {
        $ipToTest = $request->input('ip');

        // Ganti perintah ping dengan opsi yang sesuai dengan lingkungan Anda
        exec("ping $ipToTest -n 4", $output, $status);

        return response()->json([
            'ip' => $ipToTest,
            'status' => $status,
            'output' => $output,
        ]);
    }
}