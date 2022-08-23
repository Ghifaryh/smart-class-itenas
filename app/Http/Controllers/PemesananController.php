<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use App\Models\Prodi;
use App\Models\Jadwal;
use App\Models\Ruangan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StorePemesananRequest;
use App\Http\Requests\UpdatePemesananRequest;
use Illuminate\Validation\ValidationException;

class PemesananController extends Controller
{
    public function daftar(Request $request)
    {
        // return ([$request->file('fileRPS')->store('File-RPS'),$request->file('fileSertif')->store('File-Sertif')]);

        $validatedData = $request->validate([
            'tanggal_pinjam' => ['required','after_or_equal:' . Carbon::now()->format('d-m-Y')],
            'jam_masuk' => ['required'],
            'jam_keluar' => ['required','after:jam_masuk'],
            'id_ruangan' => ['required'],
            'prodi' => ['required'],
            'matakuliah' => ['required'],
            'dosen_matkul' => ['required'],
            'fileRPS' => ['required','file','max:5120','mimes:pdf'],
            'fileSertif' => ['required','file','max:5120','mimes:pdf'],
            'kelas' => ['required'],
            'id_pemesan' => ['required'],
            'id_status' => ['required']
        ]);
        
        if ($request->file('fileRPS')) {
            $validatedData['fileRPS'] = $request->file('fileRPS')->store('File-RPS');
        };
        
        if ($request->file('fileSertif')) {
            $validatedData['fileSertif'] = $request->file('fileSertif')->store('File-Sertif');
        };
        
        // ddd($request);
        Pemesanan::create($validatedData);
        
        return redirect('/dashboard')->with('success', 'Data pemesanan berhasil diinput!');
    }

    public function ajaxRequestPost(Request $request)
    {
        // dd($request);

        $validatedData = $request->validate([
            'tanggal_pinjam' => ['required','after_or_equal:' . Carbon::now()->format('d-m-Y')],
            'jam_masuk' => ['required'],
            'jam_keluar' => ['required','after:jam_masuk'],
            'id_ruangan' => ['required'],
            'prodi' => ['required'],
            'matakuliah' => ['required'],
            'dosen_matkul' => ['required'],
            'fileRPS' => ['required','file','max:5120','mimes:pdf'],
            'fileSertif' => ['required','file','max:5120','mimes:pdf'],
            'kelas' => ['required'],
            'id_pemesan' => ['required'],
            'id_status' => ['required']
        ]);

        if ($request->file('fileRPS')) {
            $validatedData['fileRPS'] = $request->file('fileRPS')->store('File-RPS');
        };
        
        if ($request->file('fileSertif')) {
            $validatedData['fileSertif'] = $request->file('fileSertif')->store('File-Sertif');
        };
        
        Pemesanan::create($validatedData);
        return response()->json(
            [
                'success' => true,
            ]
        );
    }

    public function hapusKet($id)
    {
        Pemesanan::where('id', $id)->update(['id_status' => 4]);

        Alert::success('Success','Data pemesanan berhasil dihapus');

        return redirect('/dashboard');
    }

    public function destroy($id,$filerps,$filesertif)
    {
        Pemesanan::destroy($id);
        Jadwal::where('id_pemesanan', $id)->delete();
        Storage::delete($filerps);
        Storage::delete($filesertif);

        Alert::success('Success','Data pemesanan berhasil dihapus');

        return redirect('/dashboard');
    }

    public function accept($id)
    {
        $pesanan = Pemesanan::find($id);
        $check = Jadwal::where('id_pemesanan', '=', $id )->first();

        // $checked = $check->id_pemesanan;

        $data = [
            'id_pemesanan' => $pesanan->id,
            'id_ruangan' => $pesanan->id_ruangan,
            'id_pemesan' => $pesanan->id_pemesan,
            'tanggal_pinjam' => $pesanan->tanggal_pinjam,
            'jam_masuk' => $pesanan->jam_masuk,
            'jam_keluar' => $pesanan->jam_keluar,
            'prodi' => $pesanan->prodi,
            'matakuliah' => $pesanan->matakuliah,
            'kelas' => $pesanan->kelas,
            'dosen_matkul' => $pesanan->dosen_matkul,
            'id_status' => 2

        ];

        if ($check === null) {
            Jadwal::create($data);
            Pemesanan::where('id', $id)->update(['id_status' => 2]);
            Alert::success('Success','Jadwal diterima');
            return redirect('/dashboard');
        } else {
            Pemesanan::where('id', $id)->update(['id_status' => 2]);
            Alert::success('Success','Jadwal diterima');
            return redirect('/dashboard');
        }
    }

    public function cancel($id)
    {
        Jadwal::where('id_pemesanan', '=', $id)->delete();
        Pemesanan::where('id', $id)->update(['id_status' => 3]);
        Alert::success('Success','Jadwal dibatalkan');
        return redirect('/dashboard');   
    }

    public function cancelhapus($id)
    {
        Jadwal::where('id_pemesanan', '=', $id)->delete();
        Pemesanan::where('id', $id)->update(['id_status' => 5]);
        Alert::success('Success','Jadwal dibatalkan karena dihapus');
        return redirect('/dashboard');   
    }

    // public function edit($id)
    // {

    //     $pesananedt = Pemesanan::findorfail($id);
    //     if (auth()->user()->level == 'dosen') {
    //         $pesanan = Pemesanan::where('id_pemesan', auth()->user()->id)->whereNot('id_status', 4)->whereNot('id_status', 5)->get();
    //     } else {
    //         $pesanan = Pemesanan::all();
    //     }
        
    //     return view('dashboard', [
    //         'title' => 'Dashboard',
    //         'param' => 'edit',
    //         'pesananedt' => $pesananedt,
    //         'ruangan' => Ruangan::all(),
    //         'jam' => Jam::all(),
    //         'pesanans' => $pesanan,
    //         'jadwals' => Jadwal::all(),
    //         'prodis' => Prodi::all(),
    //     ]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $pesanan = Pemesanan::findorfail($id);

    //     $this->validate($request, [
    //         'tanggal_pinjam' => ['required','after_or_equal:' . Carbon::now()->format('d-m-Y')],
    //         'jam_masuk' => ['required'],
    //         'jam_keluar' => ['required','after:jam_masuk'],
    //         'id_ruangan' => ['required'],
    //         'prodi' => ['required'],
    //         'matakuliah' => ['required'],
    //         'dosen_matkul' => ['required'],
    //         'kelas' => ['required'],
    //         'id_pemesan' => ['required'],
    //         'id_status' => ['required']
    //     ]);

    //     $pesanan->update($request->all());
        
    //     return redirect('/dashboard')->with('success', 'Data pemesanan ruangan berhasil diupdate!');
    // }
}
