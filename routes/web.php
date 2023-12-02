<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    InstansiController,
    WebsiteController,
    MapController,
    TeknisiController,
    PengaduanController,
    LoginController,
    PengaduanAdminController,
    TelegramController,

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
// routes/web.php
Route::get('/', [WebsiteController::class, "index"]);

Route::get('/login', [LoginController::class, 'halamanlogin'])->name('login');
Route::get('/login/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});


Route::group([
    'middleware' =>  ["auth"],
    'prefix' => "instansi"
], function ($router) {
Route::get('/', [InstansiController::class, 'show'])->name('instansi.index');
Route::get('/form', [InstansiController::class, 'form'])->name('instansi.form');
Route::post('/store', [InstansiController::class, 'store'])->name('instansi.store');
Route::get('/destroy/{id}', [InstansiController::class, 'destroy']);
Route::get('/{id}/edit', [InstansiController::class, 'edit'])->name('instansi.edit');
Route::put('/{id}', [InstansiController::class, 'update'])->name('instansi.update');
});


Route::group([
    'middleware' =>  ["auth"],
    'prefix' => "teknisi"
], function ($router) {
Route::get('/', [TeknisiController::class, 'show'])->name('teknisi.index');
Route::get('/form', [TeknisiController::class, 'form'])->name('teknisi.form');
Route::post('/store', [TeknisiController::class, 'store'])->name('teknisi.store');
Route::get('/destroy/{id}', [TeknisiController::class, 'destroy']);
Route::get('/{id}/edit', [TeknisiController::class, 'edit'])->name('teknisi.edit');
Route::put('/{id}', [TeknisiController::class, 'update'])->name('teknisi.update');
});


Route::group([
    'middleware' => ["auth"],
    'prefix' => "maps"
], function ($router) {
    Route::get('/', [MapController::class, 'index']);
});


Route::group([
    'middleware' => ["web"],
    'prefix' => "pengaduan"
], function ($router) {
Route::get('/', [PengaduanController::class, 'createForm'])->name('pengaduan.form');
Route::post('/store', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/edit/{id}', [PengaduanController::class, 'editDeskripsi'])->name('pengaduan.edit');
Route::put('/update/{id}', [PengaduanController::class, 'updateDeskripsi'])->name('pengaduan.update');
});


Route::group([
    'middleware' => ["web"],
    'prefix' => "konfirmasi-pengaduan"
], function ($router) {
Route::get('/', [PengaduanAdminController::class, 'show'])->name('pengaduan_admin.index');
Route::get('/{id}/edit', [PengaduanAdminController::class, 'edit'])->name('pengaduan_admin.edit');
Route::put('/{id}', [PengaduanAdminController::class, 'update'])->name('pengaduan_admin.update');
});


Route::group([
    'middleware' =>  ["auth"],
    'prefix' => "api"
], function ($router) {
Route::get('/', [TelegramController::class, 'show'])->name('telegram.index');
Route::get('/form', [TelegramController::class, 'form'])->name('telegram.form');
Route::post('/store', [TelegramController::class, 'store'])->name('telegram.store');
Route::get('/destroy/{id}', [TelegramController::class, 'destroy']);
Route::get('/{id}/edit', [TelegramController::class, 'edit'])->name('telegram.edit');
Route::put('/{id}', [TelegramController::class, 'update'])->name('telegram.update');
});