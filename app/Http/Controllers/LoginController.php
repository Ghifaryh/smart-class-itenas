<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
        $credentials = $request->validate([
            'kode_dosen' => ['required'],
            'password' => ['required'],
        ]);

        if(Auth::attemptWhen($credentials)){
            $request->session()->regenerate();
            Alert::success('Login Berhasil','Selamat datang');
            return redirect()->intended('/dashboard');
            // if(Auth::user()->level == "dosen"){
            //     $request->session()->regenerate();
            //     return redirect()->intended('/dashboard');
            // }else{
            //     $request->session()->regenerate();
            //     return redirect()->intended('/dashboard');

            // }
        }

        Alert::error('Login Gagal','Pastikan kode dosen dan password sudah benar!');
        return back();

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
