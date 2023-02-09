<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Riwayat;
use App\Models\Activity;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riwayat = Riwayat::all();
        return view('sewa.riwayat', compact('riwayat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function show(Riwayat $riwayat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function edit(Riwayat $riwayat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Riwayat $riwayat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Riwayat $riwayat)
    {
        $riwayat->delete();
        Activity::create([
            'nama' => 'Riwayat berhasil dihapus',
            'deskripsi' => 'Riwayat berhasil dihapus',
            'user_id' => Auth::user()->id,
            'waktu' => Carbon::now(),
        ]);
        return redirect('riwayat')->with('success', 'Berhasil Hapus Riwayat Peminjaman');
    }

    public function sewakan(Riwayat $riwayat)
    {
        // Mencari ID kendaraan dengan tabel riwayat kendaraan ID
        $kendaraan = Kendaraan::findOrFail($riwayat->kendaraan_id);

        // Jika status dalam riwayat bernilai 0 (Disewakan)
        if($riwayat->status == 0) {

            // Riwayat akan mengupdate menjadi 1 (Selesai Disewakan)
            $riwayat->update([
                'status' => 1,
            ]);

            // Status dalam tabel kendaraan akan dikembalikan menjadi 0 (Tersedia)
            $kendaraan->update([
                'status' => 0,
            ]);

            // Log Aktivitas akan membentuk data 
            Activity::create([
                'nama' => 'Riwayat Pemakaian selesai',
                'deskripsi' => 'Riwayat Pemakaian Kendaraan telah selesai' ,
                'user_id' => Auth::user()->id,
                'waktu' => Carbon::now(),
            ]);

            // Selain itu
        } else {
            // Status dalam riwayat akan diupdate kembali menjadi 0
            $riwayat->update([
                'status' => 0,
            ]);
        }

        // Redirect ke halaman riwayat dengan membawa sesi success
        return redirect('riwayat')->with('success', 'Pemakaian telah selesai');
    }
}
