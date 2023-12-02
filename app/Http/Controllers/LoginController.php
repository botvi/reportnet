<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert; // Import the SweetAlert facade

class Logincontroller extends Controller
{
    public function halamanlogin()
    {
        $user = Auth::user();
        return view('login.loginaplikasi', ['user' => $user]);
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            $role = Auth::user()->role;

            if ($role == 'instansi') {
                return redirect('/');
            } elseif ($role == 'teknisi' || $role == 'admin') {
                return redirect('/home');
            }
        }

        // Display SweetAlert on login failure
        Alert::error('Login Failed', 'Invalid username or password');

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
