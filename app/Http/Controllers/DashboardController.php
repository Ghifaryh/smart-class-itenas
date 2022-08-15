<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Jam;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Ruangan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->level == 'dosen') {
            $pesanan = Pemesanan::where('id_dosen', auth()->user()->id)->whereNot('id_status', 4)->whereNot('id_status', 5)->get();
        } else {
            $pesanan = Pemesanan::all();
        }

        // ->where('jadwal_masuk', date())->
        
        return view('ujicoba.dashboard', [
            'title' => 'Dashboard',
            'ruangan' => Ruangan::all(),
            'jam' => Jam::all(),
            'pesanans' => $pesanan,
            'jadwals' => Jadwal::all()
        ]);
    }

    
}