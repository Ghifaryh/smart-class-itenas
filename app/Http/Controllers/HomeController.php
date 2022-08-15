<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $date = new DateTime("NOW");
        $date = $date->format('d-m-Y');
        // $ruangan1 = Jadwal::where('id_ruangan', '=', 1)->where('jadwal_masuk', '>=', $date)->whereNot('id_status', 4)->get();
        // isset($output);
        // $ruangan1 = isset($output) ? ($output) : 0;
        
        return view('home', [
            "title" => "Home",
            "jdwlrgn1" => Jadwal::where('id_ruangan', '=', 1)->where('tanggal_pinjam', '>=', $date)->get(),
            "jdwlrgn2" => Jadwal::where('id_ruangan', '=', 2)->where('tanggal_pinjam', '>=', $date)->get(),
            "jdwlrgn3" => Jadwal::where('id_ruangan', '=', 3)->where('tanggal_pinjam', '>=', $date)->get(),
            "jdwlrgn4" => Jadwal::where('id_ruangan', '=', 4)->where('tanggal_pinjam', '>=', $date)->get(),
            "jdwlrgn5" => Jadwal::where('id_ruangan', '=', 5)->where('tanggal_pinjam', '>=', $date)->get(),
            "jdwlrgn6" => Jadwal::where('id_ruangan', '=', 6)->where('tanggal_pinjam', '>=', $date)->get(),
            
        ]);
    }
}
