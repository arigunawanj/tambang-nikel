<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sewa;
use App\Models\Driver;
use App\Models\Riwayat;
use App\Models\Activity;
use App\Models\Kendaraan;
use App\Exports\SewaExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class SewaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sewa = Sewa::all();
        $kendaraan = Kendaraan::all();
        $driver = Driver::all();
        $user = DB::table('users')->whereIn('role', ['Boss', 'Manajer'])->get();
        return view('sewa.sewa', compact('sewa', 'kendaraan', 'driver','user'));
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
        $data = $request->all();
        $validator = Validator::make($data, [
            'tanggal_sewa' => 'required',
            'kendaraan_id' => 'required',
            'driver_id' => 'required',
            'penyetuju_1' => 'required',
            'penyetuju_2' => 'required',
        ]);

        $kendaraan = Kendaraan::find($request->kendaraan_id);

        if ($validator->fails()) {
            return redirect('sewa')->with('error', 'Gagal Tambah Sewa');
        } elseif($request->penyetuju_1 == $request->penyetuju_2) {
            return redirect('sewa')->with('error', 'Penyetuju tidak boleh sama !');
        } elseif($kendaraan->status == 1) {
            return redirect('sewa')->with('error', 'Kendaraan Sudah disewakan !');
        } else {
            $data['acc_1'] = 0;
            $data['acc_2'] = 0;
            Sewa::create($data);
            Activity::create([
                'nama' => 'Sewa Kendaraan dibuat',
                'deskripsi' => 'Sewa Kendaraan dari Kendaraan ' . $request->kendaraan_id . ' berhasil dibuat',
                'user_id' => Auth::user()->id,
                'waktu' => Carbon::now(),
            ]);
            return redirect('sewa')->with('success', 'Berhasil Tambah Sewa Kendaraan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function show(Sewa $sewa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function edit(Sewa $sewa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sewa $sewa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sewa $sewa)
    {
        $sewa->delete();
        Activity::create([
            'nama' => 'Sewa Kendaraan dihapus',
            'deskripsi' => 'Sewa Kendaraan berhasil dihapus',
            'user_id' => Auth::user()->id,
            'waktu' => Carbon::now(),
        ]);
        return redirect('sewa')->with('success', 'Berhasil Hapus Data Sewa');
    }

    public function acc_1(Sewa $sewa)
    {
        // Jika ACC 1 bernilai boolean 0 (Belum Disetujui)
        if($sewa->acc_1 == 0) {
            // ACC 1 akan diupdate menjadi Disetujui
            $sewa->update([
                'acc_1' => 1,
            ]);

            // Log Aktivitas akan membentuk Data
            Activity::create([
                'nama' => 'Sewa Kendaraan disetujui',
                'deskripsi' => 'Sewa disetujui oleh ' . Auth::user()->nama,
                'user_id' => Auth::user()->id,
                'waktu' => Carbon::now(),
            ]);

            // Selain itu
        } else {
            // ACC 1 bisa diupdate kembali menjadi 0 (Belum disetujui)
            $sewa->update([
                'acc_1' => 0,
            ]);
            
        }

        // Redirect ke halaman sewa dengan membawa sesi Success
        return redirect('sewa')->with('success', 'Data Berhasil disetujui');
    }

    public function acc_2(Sewa $sewa)
    {
        // Mencari ID melalui Tabel sewa - Kendaraan ID
        $kendaraan = Kendaraan::findOrFail($sewa->kendaraan_id);

        // Jika ACC 1 bernilai boolean 1 (Disetujui)
        if($sewa->acc_1 == 1){

            // Dan jika ACC 2 bernilai boolean 0 (Belum disetujui)
            if($sewa->acc_2 == 0) {

                // Update ACC 2 menjadi disetujui
                $sewa->update([
                    'acc_2' => 1,
                ]);

                // Data riwayat akan diisi dengan data Sewa
                Riwayat::create([
                    'tanggal_pakai' => $sewa->tanggal_sewa,
                    'kendaraan_id' => $sewa->kendaraan_id,
                    'sewa_id' => $sewa->id,
                    'status' => 0,
                ]);

                // Log Aktivitas juga akan dibuat
                Activity::create([
                    'nama' => 'Sewa Kendaraan disetujui',
                    'deskripsi' => 'Sewa disetujui oleh ' . Auth::user()->nama ,
                    'user_id' => Auth::user()->id,
                    'waktu' => Carbon::now(),
                ]);

                // Status Kendaraan pada Data kendaraan juga akan Update menjadi Disewakan
                $kendaraan->update([
                    'status' => 1,
                ]);
                
                // Selain itu
            } else {
                // ACC 2 diubah lagi menjadi Belum disetujui
                $sewa->update([
                    'acc_2' => 0,
                ]);
            }
            
            // Redirect ke halaman sewa dengan membawa Sesi Success
            return redirect('sewa')->with('success', 'Data berhasil disetujui');
        
            // Jika ACC 1 bernilai boolean 0 (Belum disetujui)
        } else {
            // Redirect ke halaman sewa dengan membawa sesi error
            return redirect('sewa')->with('error', 'Menunggu Disetujui Pihak 1');
        }
    }

    public function sewaExport() 
    {
        return Excel::download(new SewaExport, 'SewaExport.xlsx');
    }
}
