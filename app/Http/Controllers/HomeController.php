<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\Jadwal;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $datenext = Carbon::now()->addWeek()->format('Y-m-d');
        $date = Carbon::now()->format('Y-m-d');
        // dd($date);

        // $ruangan1 = Jadwal::where('id_ruangan', '=', 1)->where('jadwal_masuk', '>=', $date)->whereNot('id_status', 4)->get();
        // isset($output);
        // $ruangan1 = isset($output) ? ($output) : 0;
        
        return view('home', [
            "title" => "Home",
            "jdwlrgn1" => Jadwal::where('id_ruangan', '=', 1)->where('tanggal_pinjam', '>=', $date)->where('tanggal_pinjam', '<=', $datenext)->get(),
            "jdwlrgn2" => Jadwal::where('id_ruangan', '=', 2)->where('tanggal_pinjam', '>=', $date)->where('tanggal_pinjam', '<=', $datenext)->get(),
            "jdwlrgn3" => Jadwal::where('id_ruangan', '=', 3)->where('tanggal_pinjam', '>=', $date)->where('tanggal_pinjam', '<=', $datenext)->get(),
            "jdwlrgn4" => Jadwal::where('id_ruangan', '=', 4)->where('tanggal_pinjam', '>=', $date)->where('tanggal_pinjam', '<=', $datenext)->get(),
            "jdwlrgn5" => Jadwal::where('id_ruangan', '=', 5)->where('tanggal_pinjam', '>=', $date)->where('tanggal_pinjam', '<=', $datenext)->get(),
            "jdwlrgn6" => Jadwal::where('id_ruangan', '=', 6)->where('tanggal_pinjam', '>=', $date)->where('tanggal_pinjam', '<=', $datenext)->get(),
            "ruangan" => Ruangan::count(),
        ]);
    }
}
