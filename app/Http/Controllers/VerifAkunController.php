<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerifAkun;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreVerifAkunRequest;
use App\Http\Requests\UpdateVerifAkunRequest;

class VerifAkunController extends Controller
{
    public function index()
    {
        // $password = Crypt::decryptString();
        $akun = User::whereNot('level','=','admin')->get();
        return view('verifakun', [
            'title' => 'Verifikasi Akun',
            'akuns' => VerifAkun::all(),
            'users' => $akun,
        ]);
    }

    public function verifikasi($kode)
    {
        $akun = VerifAkun::where('kode_dosen', '=', $kode )->first();
        $check = User::where('kode_dosen', '=', $kode )->first();

        // $checked = $check->id_pemesanan;

        $data = [
            'name' => $akun->name,
            'email' => $akun->email,
            'level' => $akun->level,
            'kode_dosen' => $akun->kode_dosen,
            'password' => $akun->password,
        ];

        if ($check === null) {
            User::create($data);
            VerifAkun::where('kode_dosen', $kode)->update(['id_status' => 7]);
            return redirect('/verifakun')->with('Verif', 'Akun Terverifikasi');
        } else {
            VerifAkun::where('kode_dosen', $kode)->update(['id_status' => 7]);
            return redirect('/verifakun')->with('Verif', 'Akun Terverifikasi');
        }
    }

    public function cancel($kode)
    {
        User::where('kode_dosen', '=', $kode )->delete();
        VerifAkun::where('kode_dosen', $kode)->update(['id_status' => 8]);

        return redirect('/verifakun')->with('Verif', 'Akun Ditolak');   
    }

    public function destroy($kode)
    {
        VerifAkun::where('kode_dosen', '=', $kode )->delete();
        User::where('kode_dosen', '=', $kode )->delete();

        return redirect('/verifakun')->with('Verif', 'Akun berhasil dihapus');
    }

    
}
