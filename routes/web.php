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
    LaporanController,
    UserController,
    TrafficController,
    LoginMikrotikController,

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
Route::get('/tentang', [WebsiteController::class, "tentang"]);

Route::get('/login', [LoginController::class, 'halamanlogin'])->name('login');
Route::get('/login/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('role:admin,teknisi');
});


Route::group([
    'middleware' => ["auth"],
    'prefix' => "instansi"
], function ($router) {
    Route::get('/', [InstansiController::class, 'show'])->name('instansi.index')->middleware('role:admin');
    Route::get('/form', [InstansiController::class, 'form'])->name('instansi.form')->middleware('role:admin');
    Route::post('/store', [InstansiController::class, 'store'])->name('instansi.store')->middleware('role:admin');
    Route::get('/destroy/{id}', [InstansiController::class, 'destroy'])->middleware('role:admin');
    Route::get('/{id}/edit', [InstansiController::class, 'edit'])->name('instansi.edit')->middleware('role:admin');
    Route::put('/{id}', [InstansiController::class, 'update'])->name('instansi.update')->middleware('role:admin');
});


Route::group([
    'middleware' => ["auth"],
    'prefix' => "teknisi"
], function ($router) {
    Route::get('/', [TeknisiController::class, 'show'])->name('teknisi.index')->middleware('role:admin');
    Route::get('/form', [TeknisiController::class, 'form'])->name('teknisi.form')->middleware('role:admin');
    Route::post('/store', [TeknisiController::class, 'store'])->name('teknisi.store')->middleware('role:admin');
    Route::get('/destroy/{id}', [TeknisiController::class, 'destroy'])->middleware('role:admin');
    Route::get('/{id}/edit', [TeknisiController::class, 'edit'])->name('teknisi.edit')->middleware('role:admin');
    Route::put('/{id}', [TeknisiController::class, 'update'])->name('teknisi.update')->middleware('role:admin');
});


Route::group([
    'middleware' => ["auth"],
    'prefix' => "maps"
], function ($router) {
    Route::get('/', [MapController::class, 'index'])->middleware('role:admin');
});


Route::group([
    'middleware' => ["auth"],
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
    Route::get('/', [PengaduanAdminController::class, 'show'])->name('pengaduan_admin.index')->middleware('role:admin,teknisi');
    Route::get('/{id}/edit', [PengaduanAdminController::class, 'edit'])->name('pengaduan_admin.edit')->middleware('role:admin,teknisi');
    Route::put('/{id}', [PengaduanAdminController::class, 'update'])->name('pengaduan_admin.update')->middleware('role:admin,teknisi');
});


Route::group([
    'middleware' => ["auth"],
    'prefix' => "api"
], function ($router) {
    Route::get('/', [TelegramController::class, 'show'])->name('telegram.index')->middleware('role:admin');
    Route::get('/form', [TelegramController::class, 'form'])->name('telegram.form');
    Route::post('/store', [TelegramController::class, 'store'])->name('telegram.store')->middleware('role:admin');
    Route::get('/destroy/{id}', [TelegramController::class, 'destroy']);
    Route::get('/{id}/edit', [TelegramController::class, 'edit'])->name('telegram.edit')->middleware('role:admin');
    Route::put('/{id}', [TelegramController::class, 'update'])->name('telegram.update')->middleware('role:admin');
});

Route::group([
    'middleware' => ["auth"],
    'prefix' => "mikrotik"
], function ($router) {
    Route::get('/', [LoginMikrotikController::class, 'show'])->name('mikrotik.index')->middleware('role:admin');
    Route::get('/form', [LoginMikrotikController::class, 'form'])->name('mikrotik.form');
    Route::post('/store', [LoginMikrotikController::class, 'store'])->name('mikrotik.store')->middleware('role:admin');
    Route::get('/destroy/{id}', [LoginMikrotikController::class, 'destroy']);
    Route::get('/{id}/edit', [LoginMikrotikController::class, 'edit'])->name('mikrotik.edit')->middleware('role:admin');
    Route::put('/{id}', [LoginMikrotikController::class, 'update'])->name('mikrotik.update')->middleware('role:admin');
});


Route::group([
    'middleware' => ["auth"],
    'prefix' => "laporan"
], function ($router) {
    Route::get('/', [LaporanController::class, 'laporan'])->middleware('role:admin');
});
Route::group([
    'middleware' => ["auth"],
    'prefix' => "profil"
], function ($router) {
    Route::get('/', [UserController::class, 'showUpdateForm'])->name('profil.show')->middleware('role:instansi');
    Route::post('/update', [UserController::class, 'updateAccount'])->name('update.account')->middleware('role:instansi');

});

Route::get('/traffic', [TrafficController::class, 'traffic'])->name('testmikrotik');
