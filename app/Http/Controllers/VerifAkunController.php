<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerifAkun;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreVerifAkunRequest;
use App\Http\Requests\UpdateVerifAkunRequest;

class VerifAkunController extends Controller
{
    public function index()
    {
        return view('verifakun', [
            'title' => 'Verifikasi Akun',
            'akuns' => VerifAkun::all(),
        ]);
    }

    public function verifikasi($kode)
    {
        $akun = VerifAkun::where('kode_dosen', '=', $kode )->get();
        $check = User::where('kode_dosen', '=', $kode )->first();

        // $checked = $check->id_pemesanan;

        $data = [
            'name' => $akun->name,
            'level' => $akun->level,
            'kode_dosen' => $akun->kode_dosen,
            'password' => $akun->password,
        ];

        if ($check === null) {
            User::create($data);
            VerifAkun::where('kode_dosen', $kode)->update(['id_status' => 2]);
            Alert::success('Success','Jadwal diterima');
            return redirect('/verifakun');
        } else {
            VerifAkun::where('kode_dosen', $kode)->update(['id_status' => 2]);
            Alert::success('Success','Jadwal diterima');
            return redirect('/verifakun');
        }
    }

    public function cancel($kode)
    {
        User::where('kode_dosen', '=', $kode )->delete();
        VerifAkun::where('kode_dosen', $kode)->update(['id_status' => 3]);
        Alert::success('Success','Jadwal dibatalkan');
        return redirect('/dashboard');   
    }

    public function destroy($kode)
    {
        VerifAkun::where('kode_dosen', '=', $kode )->delete();
        User::where('kode_dosen', '=', $kode )->delete();

        Alert::success('Success','Akun berhasil dihapus');

        return redirect('/verifakun');
    }

    
}
