<?php

namespace App\Http\Controllers;

use App\Models\LoginMikrotik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class LoginMikrotikController extends Controller
{
    public function show()
    {
        $mikrotik = LoginMikrotik::all();
        return view('Page.Mikrotik.show', compact('mikrotik'));
    }

    public function form()
    {
        $mikrotik = LoginMikrotik::all();
        return view('Page.Mikrotik.form', compact('mikrotik'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'ip' => 'required',
                'username' => 'required',
                'password' => 'required',
              
            ]);
    
            if ($validator->fails()) {
                Alert::error('Validation Error', 'Mohon periksa kembali inputan Anda');
                return redirect()->back()->withErrors($validator)->withInput();
            }
    

                // Associate Teknisi with User
                $mikrotik = new LoginMikrotik([
                    'ip' => $request->get('ip'),
                    'username' => $request->get('username'),
                    'password' => $request->get('password'),
                ]);
                $mikrotik->save();
    
            Alert::success('Success', 'Data Mikrotik berhasil ditambahkan.');
            return redirect()->route('mikrotik.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    

    public function edit($id)
    {
        $mikrotik = LoginMikrotik::findOrFail($id);
        return view('Page.Mikrotik.edit', compact('mikrotik'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'ip' => 'required',
                'username' => 'required',            
                'password' => 'required',            
            ]);
    
            // Update the 'deskripsi' field
            $mikrotik = LoginMikrotik::find($id);
            $mikrotik->ip = $request->ip;
            $mikrotik->username = $request->username;
            $mikrotik->password = $request->password;
            $mikrotik->save();

            Alert::success('Success', 'Data Mikrotik berhasil diperbarui.');
            return redirect()->route('mikrotik.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        // Find the Telegram by ID
        $mikrotik = LoginMikrotik::find($id);
    
        if (!$mikrotik) {
            // Handle case where Telegram is not found
            return redirect()->back()->with('error', 'Data mikrotik tidak ditemukan.');
        }
    
        // Delete the Telegram
        $mikrotik->delete();
    

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->back();    }
    
    
}
