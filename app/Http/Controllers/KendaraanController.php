<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
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
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('kendaraan')->with('error', 'Gagal Tambah Kendaraan');
        } else {
            Kendaraan::create($request->all());
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
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('kendaraan')->with('error', 'Gagal Ubah Kendaraan');
        } else {
            $kendaraan->update($request->all());
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
        return redirect('kendaraan')->with('success', 'Berhasil Hapus Data Kendaraan');
    }
}
