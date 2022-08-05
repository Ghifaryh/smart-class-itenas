<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\User;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        $jadwals = Jadwal::all();
        return view('ujicoba.dashboard', [
            'title' => 'Dashboard',
            "ruangan" => Ruangan::all(),
            "jadwals" => Jadwal::all()
        ]);
    }

    public function daftar(Request $request)
    {
        $validatedData = $request->validate([
            'id_gedung' => ['required'],
            'id_dosen' => ['required'],
            'jadwal_masuk' => ['required'],
            'jadwal_keluar' => ['required'],
            'jurusan' => ['required'],
            'matakuliah' => ['required'],
            'id_status' => ['required']
        ]);

        // dd($request);
        Jadwal::create($validatedData);

        return redirect('/dashboard')->with('success', 'Data pemesanan berhasil diinput!');
    }

    
}