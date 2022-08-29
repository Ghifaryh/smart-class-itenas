<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Jam;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Jadwal;
use App\Models\Ruangan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {   
        $datenow = Carbon::now()->format('Y-m-d');
        // $date = Carbon::now()->format('Y-m-d');
        
        // if (auth()->user()->level == 'dosen') {
        //     $pesanan = Pemesanan::where('id_pemesan', auth()->user()->id)->whereNot('id_status', 4)->whereNot('id_status', 5)->get();
        // } else {
        //     $pesanan = Pemesanan::all();
        // }

        // ->where('jadwal_masuk', date())->
        
        return view('dashboard', [
            'title' => 'Dashboard',
            'ruangan' => Ruangan::all(),
            'jam' => Jam::all(),
            // 'pesanans' => $pesanan,
            // 'jadwals' => Jadwal::all(),
            'prodis' => Prodi::all(),

        ]);
    }

    public function getMatkul($semester, $prodi)
    {
        // $semester = $this->request->getvar('semester');
        // $prodi = $this->request->getvar('prodi');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api-sikad.itenas.ac.id/public/4p151k4dn0w/mahasiswa/matakuliah-by-prodi?APIKEY=284a13407bb5660a4b725312af37b814186056c2&semester={$semester}&jurusan={$prodi}");
        // curl_setopt($curl, CURLOPT_URL, "https://api-sikad.itenas.ac.id/public/4p151k4dn0w/mahasiswa/matakuliah-by-prodi?APIKEY=284a13407bb5660a4b725312af37b814186056c2&semester=20221&jurusan=15");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        $output = json_decode($output, true);

        isset($output["data"]);
        
        $output = isset($output["data"]) ? ($output["data"]) : null;

        // error_log($output);
        echo json_encode($output);
    
    }

    public function getDosenMatkul($semester, $prodi, $kode_matkul, $kelas)
    {
        // $semester = $this->request->getvar('semester');
        // $prodi = $this->request->getvar('prodi');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api-sikad.itenas.ac.id/public/4p151k4dn0w/mahasiswa/matakuliah-by-prodi?APIKEY=284a13407bb5660a4b725312af37b814186056c2&semester={$semester}&jurusan={$prodi}");
        // curl_setopt($curl, CURLOPT_URL, "https://api-sikad.itenas.ac.id/public/4p151k4dn0w/mahasiswa/matakuliah-by-prodi?APIKEY=284a13407bb5660a4b725312af37b814186056c2&semester=20221&jurusan=15");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        $output = json_decode($output, true);

        isset($output["data"]);
        
        $output = isset($output["data"]) ? ($output["data"]) : null;
        
        foreach ($output as $key => $value) {
            if (($value['Disp_Kode'] == $kode_matkul) && ($value['Disp_Kelas'] == $kelas) && ($value['Disp_Semester'] == $semester)) {
                //if magicRankis not 8, ignore and move on to the next entry
                $data = array("data1"=>$value['Disp_NamaDosen'], "data2"=>$value['Disp_Kelas']);
            }
            continue;
            //magicRank is 8, do something
            }

        // error_log($output);
        echo json_encode($data);
    
    }

    
}