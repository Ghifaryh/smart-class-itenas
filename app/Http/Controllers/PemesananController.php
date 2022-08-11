<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use App\Http\Requests\StorePemesananRequest;
use App\Http\Requests\UpdatePemesananRequest;

class PemesananController extends Controller
{
    public function daftar(Request $request)
    {
        $validatedData = $request->validate([
            'id_ruangan' => ['required'],
            'id_dosen' => ['required'],
            'tanggal_pinjam' => ['required'],
            'jam_masuk' => ['required'],
            'jam_keluar' => ['required','after:jam_masuk'],
            'prodi' => ['required'],
            'matakuliah' => ['required'],
            'id_status' => ['required']
        ]);
        
        // dd($request);
        Pemesanan::create($validatedData);

        return redirect('/dashboard')->with('success', 'Data pemesanan berhasil diinput!');
    }

    public function hapusket($id)
    {
        Pemesanan::where('id', $id)->update(['id_status' => 4]);

        return redirect('/dashboard')->with('succes', 'Data pemesanan berhasil dihapus!');
    }

    public function destroy($id)
    {
        Pemesanan::destroy($id);

        return redirect('/dashboard')->with('success', 'Data pemesanan berhasil dihapus!');
    }

    public function accept($id)
    {
        $pesanan = Pemesanan::find($id);
        $check = Jadwal::where('id_pemesanan', '=', $id )->first();

        // $checked = $check->id_pemesanan;

        $data = [
            'id_pemesanan' => $pesanan->id,
            'id_ruangan' => $pesanan->id_ruangan,
            'id_dosen' => $pesanan->id_dosen,
            'tanggal_pinjam' => $pesanan->tanggal_pinjam,
            'jam_masuk' => $pesanan->jam_masuk,
            'jam_keluar' => $pesanan->jam_keluar,
            'prodi' => $pesanan->prodi,
            'matakuliah' => $pesanan->matakuliah,
            'id_status' => 2

        ];

        if ($check === null) {
            Jadwal::create($data);
            Pemesanan::where('id', $id)->update(['id_status' => 2]);
            return redirect('/dashboard')->with('success', 'Data pemesanan diterima!');
        } else {
            Pemesanan::where('id', $id)->update(['id_status' => 2]);
            return redirect('/dashboard')->with('success', 'Data pemesanan diterima!');
        }
    }

    public function cancel($id)
    {
        Jadwal::where('id_pemesanan', '=', $id)->delete();
        Pemesanan::where('id', $id)->update(['id_status' => 3]);
        return redirect('/dashboard')->with('success', 'Data pemesanan dibatalkan!');   
    }

    public function cancelhapus($id)
    {
        Jadwal::where('id_pemesanan', '=', $id)->delete();
        Pemesanan::where('id', $id)->update(['id_status' => 5]);
        return redirect('/dashboard')->with('success', 'Data pemesanan dibatalkan karna dihapus!');   
    }
}
