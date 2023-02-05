<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Kendaraan;
use App\Models\Riwayat;
use App\Models\Sewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kendaraan = Kendaraan::all()->count();
        $driver = Driver::all()->count();
        $riwayat = Riwayat::all()->count();
        $sewa = Sewa::all()->count();
        return view('home', compact('kendaraan','driver', 'riwayat', 'sewa'));
    }

    public function chart()
    {
        $riwayat = DB::table('riwayats')
        ->orderBy('tanggal_pakai', 'ASC')
        ->get();

        return response()->json($riwayat);
    }
}
