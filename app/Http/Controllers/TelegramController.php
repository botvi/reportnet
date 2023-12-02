<?php

namespace App\Http\Controllers;

use App\Models\Telegram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class TelegramController extends Controller
{
    public function show()
    {
        $telegram = Telegram::all();
        return view('Page.Api.show', compact('telegram'));
    }

    public function form()
    {
        $telegram = Telegram::all();
        return view('Page.Api.form', compact('telegram'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'api_token' => 'required',
                'id_chat' => 'required',
              
            ]);
    
            if ($validator->fails()) {
                Alert::error('Validation Error', 'Mohon periksa kembali inputan Anda');
                return redirect()->back()->withErrors($validator)->withInput();
            }
    

                // Associate Teknisi with User
                $telegram = new Telegram([
                    'api_token' => $request->get('api_token'),
                    'id_chat' => $request->get('id_chat'),
                ]);
                $telegram->save();
    
            Alert::success('Success', 'Data Api berhasil ditambahkan.');
            return redirect()->route('telegram.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    

    public function edit($id)
    {
        $telegram = Telegram::findOrFail($id);
        return view('Page.Api.edit', compact('telegram'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'api_token' => 'required',
                'id_chat' => 'required',            
            ]);
    
            // Update the 'deskripsi' field
            $telegram = Telegram::find($id);
            $telegram->api_token = $request->api_token;
            $telegram->id_chat = $request->id_chat;
            $telegram->save();

            Alert::success('Success', 'Data Api berhasil diperbarui.');
            return redirect()->route('telegram.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        // Find the Telegram by ID
        $telegram = Telegram::find($id);
    
        if (!$telegram) {
            // Handle case where Telegram is not found
            return redirect()->back()->with('error', 'Data teknisi tidak ditemukan.');
        }
    
        // Delete the Telegram
        $telegram->delete();
    

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->back();    }
    
    
}
