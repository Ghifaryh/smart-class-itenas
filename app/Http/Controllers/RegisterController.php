<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerifAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register', [
            'title' => 'Register',

        ]);
    }

    public function store(Request $request)
    {
        $check = VerifAkun::where('kode_dosen', '=', $request['kode_dosen'] )->first();
        $validatedData = $request->validate([
            'name' => ['required','max:255'],
            'email' => ['required','email'],
            'level' => ['required'],
            'kode_dosen' => ['required'],
            'id_status' => ['required'],
            'password' => ['required'],
        ]);

        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);
        // $validatedData['level'] = $validatedData['password'].toLowerCase();

        // dd('Registrasi Berhasil!!');

        if ($check === null) {
            VerifAkun::create($validatedData);
            // Alert::success('Success','Registrasi Berhasil! Tunggu akun diverifikasi oleh admin');
            return redirect('/login')->with('Regis Sukses', 'Registrasi Berhasil! Tunggu akun diverifikasi oleh admin');
        } else {
            // Alert::warning('Peringatan','Akun dengan kode dosen '. $request['kode_dosen'] .' telah didaftarkan, mohon tunggu verifikasi admin');
            return redirect('/register')->with('Regis Peringatan', 'Akun dengan kode dosen '. $request['kode_dosen'] .' telah didaftarkan, mohon tunggu verifikasi admin');
        }
        // $request->session()->flash('success', 'Registration successfull!vPlease Login');
        // Alert::success('Success','Registrasi Berhasil! Tunggu akun diverifikasi oleh admin');
        // return redirect('/login');
    }
}
