<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Kendaraan;
use App\Models\Riwayat;
use App\Models\Sewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        if ($validator->fails()) {
            return redirect('sewa')->with('error', 'Gagal Tambah Sewa');
        } elseif($request->penyetuju_1 == $request->penyetuju_2) {
            return redirect('sewa')->with('error', 'Penyetuju tidak boleh sama !');
        } else {
            $data['acc_1'] = 0;
            $data['acc_2'] = 0;
            Sewa::create($data);
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
        return redirect('sewa')->with('success', 'Berhasil Hapus Data Sewa');
    }

    public function acc_1(Sewa $sewa)
    {
        if($sewa->acc_1 == 0) {
            $sewa->update([
                'acc_1' => 1,
            ]);
        } else {
            $sewa->update([
                'acc_1' => 0,
            ]);
        }
        return redirect('sewa')->with('success', 'Data Berhasil disetujui');
    }

    public function acc_2(Sewa $sewa)
    {
        $kendaraan = Kendaraan::findOrFail($sewa->kendaraan_id);
        if($sewa->acc_1 == 1){
            if($sewa->acc_2 == 0) {
                $sewa->update([
                    'acc_2' => 1,
                ]);
                Riwayat::create([
                    'tanggal_pakai' => $sewa->tanggal_sewa,
                    'kendaraan_id' => $sewa->kendaraan_id,
                    'sewa_id' => $sewa->id,
                    'status' => 0,
                ]);

                $kendaraan->update([
                    'status' => 1,
                ]);
            } else {
                $sewa->update([
                    'acc_2' => 0,
                ]);
            }
        return redirect('sewa')->with('success', 'Data berhasil disetujui');
        } else {
        return redirect('sewa')->with('error', 'Menunggu Disetujui Pihak 1');
        }
    }
}
