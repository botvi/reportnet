<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Teknisi;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class TeknisiController extends Controller
{
    public function show()
    {
        $teknisis = Teknisi::all();
        return view('Page.Teknisi.show', compact('teknisis'));
    }

    public function form()
    {
        $teknisis = Teknisi::all();
        return view('Page.Teknisi.form', compact('teknisis'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_teknisi' => 'required|string',
                'alamat' => 'required|string',
                'telepon' => 'required|string',
                'username' => 'required|string|unique:users',
                'password' => 'required|string|min:8',
            ]);
    
            if ($validator->fails()) {
                Alert::error('Validation Error', 'Mohon periksa kembali inputan Anda');
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'name' => $request->get('nama_teknisi'),
                    'username' => $request->get('username'),
                    'password' => bcrypt($request->get('password')),
                    'role' => 'teknisi',
                ]);
    
                // Associate Teknisi with User
                $teknisi = new Teknisi([
                    'nama_teknisi' => $request->get('nama_teknisi'),
                    'alamat' => $request->get('alamat'),
                    'telepon' => $request->get('telepon'),
                ]);
                $teknisi->user()->associate($user);
                $teknisi->save();
            });
    
            Alert::success('Success', 'Data teknisi berhasil ditambahkan.');
            return redirect()->route('teknisi.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    

    public function edit($id)
    {
        $teknisi = Teknisi::findOrFail($id);
        return view('Page.Teknisi.edit', compact('teknisi'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_teknisi' => 'required|string',
                'alamat' => 'required|string',
                'telepon' => 'required|string',
            ]);

            if ($validator->fails()) {
                Alert::error('Validation Error', 'Mohon periksa kembali inputan Anda');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::transaction(function () use ($request, $id) {
                $teknisi = Teknisi::findOrFail($id);

                $teknisi->update([
                    'nama_teknisi' => $request->get('nama_teknisi'),
                    'alamat' => $request->get('alamat'),
                    'telepon' => $request->get('telepon'),
                ]);

                if ($request->filled('password')) {
                    if ($teknisi->user) {
                        $teknisi->user->update([
                            'password' => bcrypt($request->get('password')),
                        ]);
                    }
                }

                if ($teknisi->wasChanged('nama_teknisi') && $teknisi->user) {
                    $teknisi->user->update([
                        'name' => $request->get('nama_teknisi'),
                    ]);
                }
            });

            Alert::success('Success', 'Data teknisi berhasil diperbarui.');
            return redirect()->route('teknisi.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            // Use a transaction to ensure data consistency
            DB::beginTransaction();
    
            // Find the Teknisi by ID
            $teknisi = Teknisi::findOrFail($id);
    
            if (!$teknisi) {
                // Handle case where Teknisi is not found
                Alert::error('Error', 'Data teknisi tidak ditemukan.');
                return redirect()->back();
            }
    
            // Retrieve the associated user and delete it
            $user = $teknisi->user;
            $teknisi->delete();
    
            if ($user) {
                $user->delete();
            }
    
            // Commit the transaction
            DB::commit();
    
            Alert::success('Success', 'Data berhasil dihapus');
            return redirect()->back();
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
    
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    
    
}
