<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
// app/Http/Controllers/LokasiController.php

public function index()
{
    $lokasis = Lokasi::all();
    return view('Page.Test.show', compact('lokasis'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'icon_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'polygon_color' => 'required|regex:/#[a-fA-F0-9]{6}/', // Validasi format warna hex
    ]);

    $iconPath = $request->file('icon_path')->store('icon-map', 'public');

    Lokasi::create([
        'name' => $request->input('name'),
        'latitude' => $request->input('latitude'),
        'longitude' => $request->input('longitude'),
        'icon_path' => $iconPath,
        'polygon_color' => $request->input('polygon_color'),
    ]);

    return redirect()->route('lokasi.index')->with('success', 'Location created successfully.');
}
}
