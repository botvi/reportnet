<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LaporanController extends Controller
{
    public function laporan()
    {
        $laporan = DB::table('instansi')
        ->select('instansi.nama_instansi', 'instansi.admin_jaringan', 'instansi.telepon', 'instansi.ip_wan', 'pengaduans.deskripsi_title','pengaduans.status')
        ->join('users', 'instansi.user_id', '=', 'users.id')
        ->join('pengaduans', 'users.id', '=', 'pengaduans.user_id')
        ->where('pengaduans.status', '=', 'Selesai')
        ->get();

        return view('Page.Laporan.show', ['laporan' => $laporan]);
    }

}