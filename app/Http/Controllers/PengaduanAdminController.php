<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


class PengaduanAdminController extends Controller
{
    public function show()
    {
        $pengaduan = Pengaduan::with('user.instansi_pengaduan')
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('Page.Pengaduan.Show', compact('pengaduan'));
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('Page.Pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'solusi' => 'required|string',
                'status' => 'required|string',
            ]);

            if ($validator->fails()) {
                Alert::error('Validation Error', 'Mohon periksa kembali inputan Anda');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::transaction(function () use ($request, $id) {
                $pengaduan = Pengaduan::findOrFail($id);

                $pengaduan->update([
                    'solusi' => $request->get('solusi'),
                    'status' => $request->get('status'),
                ]);
            });

            Alert::success('Success', 'Pengaduan berhasil diperbarui.');
            return redirect()->route('pengaduan_admin.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
