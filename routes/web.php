<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    LokasiController,
    NetworkSpeedController,

};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
// routes/web.php


Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi.index');
Route::post('/lokasi/store', [LokasiController::class, 'store'])->name('lokasi.store');


Route::post('/measure-speed', [NetworkSpeedController::class, 'measureSpeed']);
Route::get('/speed', [NetworkSpeedController::class, 'index'])->name('speed.index');
