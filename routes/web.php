<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\UserController;
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
    return view('auth.login1');
});

Route::resource('driver', DriverController::class);
Route::resource('kendaraan', KendaraanController::class);
Route::resource('user', UserController::class);
Route::resource('riwayat', RiwayatController::class);
Route::resource('sewa', SewaController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
