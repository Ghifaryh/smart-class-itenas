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
        $akun = VerifAkun::where('kode_dosen', '=', $kode )->first();
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
            VerifAkun::where('kode_dosen', $kode)->update(['id_status' => 7]);
            Alert::success('Success','Akun Terverifikasi');
            return redirect('/verifakun');
        } else {
            VerifAkun::where('kode_dosen', $kode)->update(['id_status' => 7]);
            Alert::success('Success','Akun Terverifikasi');
            return redirect('/verifakun');
        }
    }

    public function cancel($kode)
    {
        User::where('kode_dosen', '=', $kode )->delete();
        VerifAkun::where('kode_dosen', $kode)->update(['id_status' => 8]);
        Alert::success('Success','Akun Ditolak');
        return redirect('/verifakun');   
    }

    public function destroy($kode)
    {
        VerifAkun::where('kode_dosen', '=', $kode )->delete();
        User::where('kode_dosen', '=', $kode )->delete();

        Alert::success('Success','Akun berhasil dihapus');

        return redirect('/verifakun');
    }

    
}
