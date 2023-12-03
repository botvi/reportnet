<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Instansi;



class UserController extends Controller
{

    public function showUpdateForm()
    {
        $user = Auth::user()->load('instansi');
        return view('website.profil', compact('user'));
    }

    public function updateAccount(Request $request)
    {
        $request->validate([
            'username' => 'unique:users,username,' . auth()->id(),
            'new_password' => 'nullable|min:8',
        ]);
    
        $user = auth()->user();
    
        // Validasi Password Lama
        if (!Hash::check($request->current_password, $user->password)) {
            Alert::error('Error', 'Password lama tidak sesuai.');
            return redirect()->back();
        }
    
        // Update Username jika berubah
        if ($request->username !== $user->username) {
            $user->username = $request->username;
            $user->save();
        }
    
        // Update Password jika diisi
        if ($request->filled('new_password')) {
            $user->password = bcrypt($request->new_password);
            $user->save();
        }
    
        Alert::success('Success', 'Perubahan berhasil disimpan.');
        return redirect()->back();
    }
    
}
