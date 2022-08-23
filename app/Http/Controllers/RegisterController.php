<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerifAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

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
        $validatedData = $request->validate([
            'name' => ['required','max:255'],
            'level' => ['required'],
            'kode_dosen' => ['required'],
            'id_status' => ['required'],
            'password' => ['required'],
        ]);

        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);
        // $validatedData['level'] = $validatedData['password'].toLowerCase();

        // dd('Registrasi Berhasil!!');
        VerifAkun::create($validatedData);

        // $request->session()->flash('success', 'Registration successfull!vPlease Login');
        Alert::success('Success','Registrasi Berhasil! Tunggu akun diverifikasi oleh admin');
        return redirect('/login');
    }
}
