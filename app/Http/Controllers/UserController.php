<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('pendataan.pengguna', compact('user'));
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
        $data['password'] = Hash::make($request->password);
        User::create($data);
        Activity::create([
            'nama' => 'Data Pengguna dibuat',
            'deskripsi' => 'Data Pengguna berhasil dibuat' ,
            'user_id' => Auth::user()->id,
            'waktu' => Carbon::now(),
        ]);
        return redirect('user')->with('success', 'Berhasil Menambahkan Data Pengguna');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'role' => $request->role,
        ]);

        Activity::create([
            'nama' => 'Role Data Pengguna diubah',
            'deskripsi' => 'Role Data Pengguna ' . $user->name . ' berhasil diganti ke ' . $request->role ,
            'user_id' => Auth::user()->id,
            'waktu' => Carbon::now(),
        ]);
        // Dialihkan ke halaman Pengguna
        return redirect('user')->with('success', 'Berhasil Ubah Role Pengguna');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        Activity::create([
            'nama' => 'Data Pengguna dihapus',
            'deskripsi' => 'Data Pengguna berhasil dihapus' ,
            'user_id' => Auth::user()->id,
            'waktu' => Carbon::now(),
        ]);
        return redirect('user')->with('success', 'Berhasil Hapus Data Pengguna');
    }
}
