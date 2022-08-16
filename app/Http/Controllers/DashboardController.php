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
            'param' => 'add',
            'ruangan' => Ruangan::all(),
            'jam' => Jam::all(),
            'pesanans' => $pesanan,
            'jadwals' => Jadwal::all()
        ]);
    }

    public function getdatamatkul($semester,$jurusan){

        $curl = curl_init();
        // curl_setopt($curl, CURLOPT_URL, "http://api.itenas.ac.id:8080/aset-by-kodegedung?APIKEY=284a13407bb5660a4b725312af37b814186056c2&kodegedung={$gedung}");
        curl_setopt($curl, CURLOPT_URL, "https://api-sikad.itenas.ac.id/public/4p151k4dn0w/mahasiswa/matakuliah-by-prodi?APIKEY=284a13407bb5660a4b725312af37b814186056c2&semester={$semester}&jurusan={$jurusan}");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        $output = json_decode($output, true);

        isset($output["data"]);
        
        $output = isset($output["data"]) ? ($output["data"]) : null;

        
        // $res = Http::get(config('app.URL_API').'aset-by-kodegedung',[
        //     'APIKEY'=>config('app.API_KEY'), 
        //     'kodegedung'=>$gedung, 
        // ]); 
        // $json=$res->json();
        

        // return view('part/astable', [
        //     "title" => "Detail Aset Gedung",
        //     "namaged"   => $nama,
        //     "noged"   => $gedung,
        //     "detailAset" => $output,
    
        // ]);
    
    }

    
}