<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\UserController;
use App\Models\Riwayat;
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

// Akses Tamu jika belum Login
Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login1');
    });
});
// Akses Semua yang membutuhkan Login
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('sewa', SewaController::class);
    Route::resource('riwayat', RiwayatController::class);
    
});

// Akses Manajer dan Boss
Route::middleware(['Manajer', 'Boss'])->group(function () {
    Route::get('acc1/{sewa}', [SewaController::class, 'acc_1']);
    Route::get('acc2/{sewa}', [SewaController::class, 'acc_2']);
});


// Akses Admin dan Control
Route::middleware(['Admin', 'Control'])->group(function () {
    Route::resource('driver', DriverController::class);
    Route::resource('kendaraan', KendaraanController::class);
    Route::get('sewakan/{riwayat}', [RiwayatController::class, 'sewakan']);
        // Print
        Route::get('driverexport', [DriverController::class, 'driverExport']);
        Route::get('kendaraanexport', [KendaraanController::class, 'kendaraanExport']);
});

// Akses Role Control
Route::middleware(['Control'])->group(function () {
    Route::resource('user', UserController::class);
});

Auth::routes();

