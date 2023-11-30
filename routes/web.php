<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    InstansiController,
    NetworkSpeedController,
    MapController,

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

Route::get('/instansi', [InstansiController::class, 'show'])->name('instansi.index');
Route::get('/instansi/form', [InstansiController::class, 'form'])->name('instansi.form');
Route::post('/instansi/store', [InstansiController::class, 'store'])->name('instansi.store');
Route::get('/instansi/destroy/{id}', [InstansiController::class, 'destroy']);
Route::get('/instansi/{id}/edit', [InstansiController::class, 'edit'])->name('instansi.edit');
Route::put('/instansi/{id}', [InstansiController::class, 'update'])->name('instansi.update');



Route::group([
    'middleware' => ["web"],
    'prefix' => "maps"
], function ($router) {
    Route::get('/', [MapController::class, 'index']);
});


Route::get('/speed', [NetworkSpeedController::class, 'index']);
Route::post('/speed-test', [NetworkSpeedController::class, 'store']);