<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreJadwalRequest;
use App\Http\Requests\UpdateJadwalRequest;

class JadwalController extends Controller
{
    public function index()
    {
        return view('ujicoba.register', [
            'title' => 'Register',

        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_gedung' => ['required'],
            'id_dosen' => ['required'],
            'jadwal_masuk' => ['required'],
            'jadwal_keluar' => ['required'],
            'jurusan' => ['required','email:dns','unique:users'],
            'matakuliah' => ['required','min:5','max:255'],
            'id_status' => ['required']
        ]);

        // dd('Registrasi Berhasil!!');
        Jadwal::create($validatedData);

        // $request->session()->flash('success', 'Registration successfull!vPlease Login');

        return redirect('/login')->with('success', 'Registration successfull! Please Login');
    }

}
