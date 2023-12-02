<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Instansi;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class InstansiController extends Controller
{
    public function show()
    {
        $instansis = Instansi::all();
        return view('Page.Instansi.show', compact('instansis'));
    }

    public function form()
    {
        $instansis = Instansi::all();
        return view('Page.Instansi.form', compact('instansis'));
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'nama_instansi' => 'required|string',
                'admin_jaringan' => 'required|string',
                'telepon' => 'required|string',
                'ip_wan' => 'required|string',
                'latitude' => 'required|string',
                'longitude' => 'required|string',
                'username' => 'required|string|unique:users',
                'password' => 'required|string|min:8',
                'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Jika validasi gagal, kembali ke form dengan pesan error
            if ($validator->fails()) {
                Alert::error('Validation Error', 'Mohon periksa kembali inputan Anda');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Upload dan simpan file gambar
            $iconPath = $request->file('icon')->store('icons', 'public');

            // Gunakan transaksi database untuk memastikan keberhasilan penyimpanan
            DB::transaction(function () use ($request, $iconPath) {
                // Simpan data user
                $user = User::create([
                    'name' => $request->get('nama_instansi'),
                    'username' => $request->get('username'),
                    'password' => bcrypt($request->get('password')),
                    'role' => 'instansi',
                ]);

                // Simpan data instansi dengan user_id
                $instansi = Instansi::create([
                    'nama_instansi' => $request->get('nama_instansi'),
                    'admin_jaringan' => $request->get('admin_jaringan'),
                    'telepon' => $request->get('telepon'),
                    'ip_wan' => $request->get('ip_wan'),
                    'latitude' => $request->get('latitude'),
                    'longitude' => $request->get('longitude'),
                    'icon' => $iconPath,
                    'user_id' => $user->id,
                ]);

                if (!$instansi) {
                    Alert::error('Error', 'Gagal menyimpan data instansi');
                    return redirect()->back();
                }
            });

            Alert::success('Success', 'Data instansi berhasil ditambahkan.');
            return redirect()->route('instansi.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $instansi = Instansi::findOrFail($id);
        return view('Page.Instansi.edit', compact('instansi'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'nama_instansi' => 'required|string',
                'admin_jaringan' => 'required|string',
                'telepon' => 'required|string',
                'ip_wan' => 'required|string',
                'latitude' => 'required|string',
                'longitude' => 'required|string',
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            // Jika validasi gagal, kembali ke form dengan pesan error
            if ($validator->fails()) {
                Alert::error('Validation Error', 'Mohon periksa kembali inputan Anda');
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            // Gunakan transaksi database untuk memastikan keberhasilan penyimpanan
            DB::transaction(function () use ($request, $id) {
                // Temukan data instansi berdasarkan ID
                $instansi = Instansi::findOrFail($id);
    
                // Perbarui data instansi
                $instansi->update([
                    'nama_instansi' => $request->get('nama_instansi'),
                    'admin_jaringan' => $request->get('admin_jaringan'),
                    'telepon' => $request->get('telepon'),
                    'ip_wan' => $request->get('ip_wan'),
                    'latitude' => $request->get('latitude'),
                    'longitude' => $request->get('longitude'),
                ]);
    
                // Jika password diisi, perbarui password
                if ($request->filled('password')) {
                    if ($instansi->user) {
                        $instansi->user->update([
                            'password' => bcrypt($request->get('password')),
                        ]);
                    }
                }
    
                // Jika ikon diunggah, perbarui ikon
                if ($request->hasFile('icon')) {
                    $iconPath = $request->file('icon')->store('icons', 'public');
                    $instansi->update(['icon' => $iconPath]);
                }
    
                // Jika nama_instansi berubah, perbarui juga di tabel users
                if ($instansi->wasChanged('nama_instansi') && $instansi->user) {
                    $instansi->user->update([
                        'name' => $request->get('nama_instansi'),
                    ]);
                }
            });
    
            Alert::success('Success', 'Data instansi berhasil diperbarui.');
            return redirect()->route('instansi.index');
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
            $instansi = Instansi::findOrFail($id);
    
            if (!$instansi) {
                // Handle case where Teknisi is not found
                Alert::error('Error', 'Data instansi tidak ditemukan.');
                return redirect()->back();
            }
    
            // Retrieve the associated user and delete it
            $user = $instansi->user;
            $instansi->delete();
    
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