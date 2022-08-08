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
        if (auth()->user()->level == 'dosen') {
            $jadwal = Jadwal::where('id_dosen', 'like', '%' . auth()->user()->id . '%')->get();
        } else {
            $jadwal = Jadwal::all();
        }
        
        return view('ujicoba.dashboard', [
            'title' => 'Dashboard',
            "ruangan" => Ruangan::all(),
            "jadwals" => $jadwal
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

    public function destroy($id)
    {
        Jadwal::destroy($id);

        return redirect('/dashboard')->with('success', 'Data pemesanan berhasil dihapus!');
    }

    public function accept($id)
    {
        Jadwal::where('id', $id)->update(['id_status' => 2]);

        return redirect('/dashboard')->with('success', 'Data pemesanan diterima!');
    }

    public function cancel($id)
    {
        Jadwal::where('id', $id)->update(['id_status' => 3]);

        return redirect('/dashboard')->with('failed', 'Data pemesanan dibatalkan!');
    }
}