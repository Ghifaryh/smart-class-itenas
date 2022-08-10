<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreJadwalRequest;
use App\Http\Requests\UpdateJadwalRequest;

class JadwalController extends Controller
{
    public function destroy($id)
    {
        Jadwal::destroy($id);

        return redirect('/dashboard')->with('success', 'Jadwal berhasil dihapus!');
    }
    
}
