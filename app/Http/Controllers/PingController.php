<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Instansi;

class PingController extends Controller
{
    public function checkPing($ip)
    {
        try {
            $command = "ping -n 4 $ip"; // For Unix-based systems (Linux, macOS)
            // If you're using Windows, replace the command with "ping -n 4 $ip"

            $output = [];
            $returnCode = null;
            exec($command, $output, $returnCode);

            if ($returnCode === 0) {
                return response()->json(['status' => 'success', 'message' => "Ping to $ip is successful.", 'output' => $output]);
            } elseif (strpos(implode("\n", $output), 'Destination host unreachable') !== false) {
                // If 'Destination host unreachable' is found in the output, consider it as failed
                return response()->json(['status' => 'failed', 'message' => "Ping to $ip failed. Destination host unreachable.", 'output' => $output]);
            } else {
                return response()->json(['status' => 'error', 'message' => "Ping to $ip failed. Return code: $returnCode", 'output' => $output]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => "Ping to $ip failed. Error: " . $e->getMessage()]);
        }
    }
    
    
}