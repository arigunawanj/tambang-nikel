<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Activity;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Exports\KendaraanExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kendaraan = Kendaraan::all();
        return view('pendataan.kendaraan', compact('kendaraan'));
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
        $validator = Validator::make($request->all(), [
            'nama_kendaraan' => 'required',
            'jenis' => 'required',
            'konsumsi_bbm' => 'required',
            'jadwal' => 'required',
            'asal' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('kendaraan')->with('error', 'Gagal Tambah Kendaraan');
        } else {
            Kendaraan::create($request->all());
            Activity::create([
                'nama' => 'Data Kendaraan dibuat',
                'deskripsi' => 'Data Kendaraan '. $request->nama_kendaraan . ' berhasil dibuat' ,
                'user_id' => Auth::user()->id,
                'waktu' => Carbon::now(),
            ]);
            return redirect('kendaraan')->with('success', 'Berhasil Tambah Kendaraan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function show(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $validator = Validator::make($request->all(), [
            'nama_kendaraan' => 'required',
            'jenis' => 'required',
            'konsumsi_bbm' => 'required',
            'jadwal' => 'required',
            'asal' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('kendaraan')->with('error', 'Gagal Ubah Kendaraan');
        } else {
            $kendaraan->update($request->all());
            Activity::create([
                'nama' => 'Data Kendaraan diubah',
                'deskripsi' => 'Data Kendaraan dengan ID ' . $kendaraan->id . ' berhasil diubah' ,
                'user_id' => Auth::user()->id,
                'waktu' => Carbon::now(),
            ]);
            return redirect('kendaraan')->with('success', 'Berhasil Ubah Kendaraan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();
        Activity::create([
            'nama' => 'Data Kendaraan dihapus',
            'deskripsi' => 'Data Kendaraan berhasil dihapus' ,
            'user_id' => Auth::user()->id,
            'waktu' => Carbon::now(),
        ]);
        return redirect('kendaraan')->with('success', 'Berhasil Hapus Data Kendaraan');
    }

    public function kendaraanExport() 
    {
        return Excel::download(new KendaraanExport, 'KendaraanExport.xlsx');
    }
}
