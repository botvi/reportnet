<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Pengaduan;
use App\Models\Telegram;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;




class PengaduanController extends Controller
{
    public function createForm()
    {
        $pengaduan = Pengaduan::with('user.instansi_pengaduan')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('website.pengaduan', compact('pengaduan'));
    }



    

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'deskripsi_title' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Start a database transaction
        DB::beginTransaction();
    
        try {
            // Get the logged-in user's ID
            $user_id = Auth::id();
    
            // Handle file upload using move
            if ($request->hasFile('gambar')) {
                $imageName = time() . '.' . $request->file('gambar')->getClientOriginalExtension();
                $imagePath = $request->file('gambar')->move(public_path('gambar_aduan'), $imageName);
            } else {
                $imageName = null; // Set to null if no image is provided
            }
    
            // Create a new 'pengaduan' entry
            $pengaduan = Pengaduan::create([
                'user_id' => $user_id,
                'deskripsi_title' => $request->deskripsi_title,
                'deskripsi' => $request->deskripsi,
                'solusi' => $request->solusi,
                'gambar' => $imageName ? 'gambar_aduan/' . $imageName : null,
                'status' => 'Terkirim',
            ]);
    
            // Access the related instansi without using "with"
            $instansiNama = $pengaduan->user->instansi->nama_instansi;
    
            // Commit the transaction
            DB::commit();
    
            // Send the Telegram message
            $this->sendTelegramMessage($instansiNama, $pengaduan->deskripsi_title);
    
            return redirect()->route('pengaduan.form')->with('success', 'Pengaduan has been submitted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
    
            // Handle the error, you can log or return a response as needed
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }
    


    public function editDeskripsi($id)
    {
        // Fetch the Pengaduan by ID
        $pengaduan = Pengaduan::find($id);

        return response()->json(['deskripsi' => $pengaduan->deskripsi]);
    }

    public function updateDeskripsi(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'deskripsi' => 'required',
        ]);

        $pengaduan = Pengaduan::find($id);
        $pengaduan->deskripsi = $request->deskripsi;
        $pengaduan->save();

        return redirect('/pengaduan')->with('success', 'Deskripsi has been updated successfully.');
    }
    protected function sendTelegramMessage($namaInstansi, $deskripsiTitle)
    {
        $telegram = Telegram::first();

        if (!$telegram) {
            return redirect()->back()->with('error', 'Data Telegram tidak ditemukan.');
        }

        $botToken = $telegram->api_token;
        $chatId = $telegram->id_chat;

        $messageText = "Pengaduan baru dari <b>{$namaInstansi}</b> mengenai <b>{$deskripsiTitle}.</b>";

        $telegramApiUrl = "https://api.telegram.org/bot{$botToken}/sendMessage";

        Http::post($telegramApiUrl, [
            'chat_id' => $chatId,
            'parse_mode' => 'HTML',
            'text' => $messageText,
        ]);

        return redirect()->route('pengaduan.form')->with('success', 'Pengaduan has been submitted successfully.');
    }
}