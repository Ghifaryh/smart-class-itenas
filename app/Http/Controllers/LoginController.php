<?php

namespace App\Http\Controllers;

use App\Models\VerifAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $check = VerifAkun::where('kode_dosen', '=', $request['kode_dosen'] )->first();
        $credentials = $request->validate([
            'kode_dosen' => ['required'],
            'password' => ['required'],
        ]);

        if(Auth::attemptWhen($credentials)){
            $request->session()->regenerate();
            if(Auth::user()->level == "dosen"){
                $request->session()->regenerate();
                return redirect()->intended('/dashboard')->with('Login Berhasil', 'Selamat Datang');
            }else{
                $request->session()->regenerate();
                return redirect()->intended('/dashboard')->with('Login Berhasil', 'Selamat Datang Admin');

            }
        }

        if ($check === null) {
            return back()->with('Login Gagal', 'Pastikan kode dosen dan password sudah benar!');
        } else {
            return back()->with('Login Warning', 'Akun dengan kode dosen '. $request['kode_dosen'] .' telah didaftarkan, mohon tunggu verifikasi admin');
        }

        // Alert::error('Login Gagal','Pastikan kode dosen dan password sudah benar!');
        // return back();

        // dd('berhasil login!');
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
