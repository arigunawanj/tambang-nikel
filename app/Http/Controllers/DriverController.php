<?php

namespace App\Http\Controllers;

use App\Exports\DriverExport;
use App\Models\Driver;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driver = Driver::all();
        return view('pendataan.driver', compact('driver'));
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
            'nama_driver' => 'required',
            'alamat_driver' => 'required',
            'telepon_driver' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('driver')->with('error', 'Gagal Tambah Driver');
        } else {
            Driver::create($request->all());
            return redirect('driver')->with('success', 'Berhasil Tambah Driver');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        $validator = Validator::make($request->all(), [
            'nama_driver' => 'required',
            'alamat_driver' => 'required',
            'telepon_driver' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('driver')->with('error', 'Gagal Ubah Data Driver');
        } else {
            $driver->update($request->all());
            return redirect('driver')->with('success', 'Berhasil Ubah Data Driver');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect('driver')->with('success', 'Berhasil Hapus Data Driver');
    }

    public function driverExport() 
    {
        return Excel::download(new DriverExport, 'DriverExport.xlsx');
    }
}
