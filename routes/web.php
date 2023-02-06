<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\UserController;
use App\Models\Sewa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('index');
});


// Route::get('detailsewa/{id}', function ($id) {
//     $data = Sewa::find($id);
//     return view('detailsewa/{id}',compact('data'));
// });

Route::resource('index', BerandaController::class);
Route::post('/daftar', [App\Http\Controllers\SewaController::class, 'store'])->name('daftar');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'pabrik'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('/approve/{sewa}', [App\Http\Controllers\SewaController::class, 'approve'])->name('approve');
    Route::get('/approval', function () {
        $data = Sewa::all()->where('approval2',0);
        return view('admin.approval',compact('data'));
    });

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('user', UserController::class);
    Route::get('/delus/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('delus');
    Route::resource('kategori', KategoriController::class);
    Route::get('/delkat/{kategori}', [App\Http\Controllers\KategoriController::class, 'destroy'])->name('delkat');
    Route::resource('kendaraan', KendaraanController::class);
    Route::get('/delken/{kendaraan}', [App\Http\Controllers\KendaraanController::class, 'destroy'])->name('delken');
    Route::resource('driver', DriverController::class);
    Route::get('/deldri/{driver}', [App\Http\Controllers\DriverController::class, 'destroy'])->name('deldri');
    Route::resource('sewa', SewaController::class);
    Route::get('/delse/{sewa}', [App\Http\Controllers\SewaController::class, 'destroy'])->name('delse');
    Route::get('/selesai/{sewa}', [App\Http\Controllers\SewaController::class, 'selesai'])->name('selesai');
    Route::get('/export/sewa', [App\Http\Controllers\SewaController::class, 'export'])->name('export/sewa');
});
