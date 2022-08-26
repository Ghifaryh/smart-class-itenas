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
use Illuminate\Support\Facades\Validator;
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
        
        return redirect('/dashboard');
    }

    public function ajaxRequestPost(Request $request)
    {
        // dd($request);

        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->toArray()]);
        }else{
            $validatedData = $validator->validate();
    
            if ($request->file('fileRPS')) {
                $file_dokumen = $request->file('fileRPS');
                $file_dokumen_name = $file_dokumen->getClientOriginalName();
                $file_dokumen_name = preg_replace('!\s+!', ' ', $file_dokumen_name);
                $file_dokumen_name = str_replace(' ', '_', $file_dokumen_name);
                $file_dokumen_name = str_replace('%', '', $file_dokumen_name);
                $file_dokumen->move(public_path('storage/File-RPS'), $file_dokumen_name);
                $validatedData['fileRPS'] = "File-RPS/". $file_dokumen_name; 
                // $fileNamerps = pathinfo($request->file('fileRPS')->getClientOriginalName(), PATHINFO_FILENAME) . '-' . $request->id_pemesan . '.' . $request->file('fileRPS')->getClientOriginalExtension();
                // $validatedData['fileRPS'] = $request->file('fileRPS')->storePubliclyAs('File-RPS',$fileNamerps,'public');
            };
            
            if ($request->file('fileSertif')) {
                $file_dokumen_sertif = $request->file('fileSertif');
                $file_dokumen_sertifname = $file_dokumen_sertif->getClientOriginalName();
                $file_dokumen_sertifname = preg_replace('!\s+!', ' ', $file_dokumen_sertifname);
                $file_dokumen_sertifname = str_replace(' ', '_', $file_dokumen_sertifname);
                $file_dokumen_sertifname = str_replace('%', '', $file_dokumen_sertifname);
                $file_dokumen_sertif->move(public_path('storage/File-Sertif'), $file_dokumen_sertifname);
                $validatedData['fileSertif'] = "File-Sertif/". $file_dokumen_sertifname; 
                // $fileNamesertif = pathinfo($request->file('fileSertif')->getClientOriginalName(), PATHINFO_FILENAME) . '-' . $request->id_pemesan . '.' . $request->file('fileSertif')->getClientOriginalExtension();
                // $validatedData['fileSertif'] = $request->file('fileSertif')->storePubliclyAs('File-Sertif',$fileNamesertif,'public');
            };

            
            
            Pemesanan::create($validatedData);
            return response()->json(
                [
                    'success' => true,
                ]
            );
        }

    }

    public function hapusKet($id)
    {
        Pemesanan::where('id', $id)->update(['id_status' => 4]);

        return redirect('/dashboard')->with('Pemesanan Sukses', 'Data pemesanan berhasil dihapus');
    }

    public function destroy($id)
    {
        $check = Pemesanan::find($id);
        if ($check->fileRPS !== null) {
            Storage::delete($check->fileRPS);
        }
        if ($check->fileRPS !== null) {
            Storage::delete($check->fileSertif);
        }
        Pemesanan::destroy($id);
        
        return redirect('/dashboard')->with('Pemesanan Sukses', 'Data pemesanan berhasil dihapus');
    }

    public function accept($id)
    {
        $pesanan = Pemesanan::find($id);
        $check = Jadwal::where('id_pemesanan', '=', $id )->first();

        $data = [
            'id_pemesanan' => $pesanan->id,
            'id_ruangan' => $pesanan->id_ruangan,
            'id_pemesan' => $pesanan->id_pemesan,
            'tanggal_pinjam' => $pesanan->tanggal_pinjam,
            'jam_masuk' => $pesanan->jam_masuk,
            'jam_keluar' => $pesanan->jam_keluar,
            'prodi' => $pesanan->prodi,
            'matakuliah' => $pesanan->matakuliah,
            'fileRPS' => $pesanan->fileRPS,
            'fileSertif' => $pesanan->fileSertif,
            'kelas' => $pesanan->kelas,
            'dosen_matkul' => $pesanan->dosen_matkul,
            'id_status' => 2

        ];

        if ($check === null) {
            Jadwal::create($data);
            Pemesanan::where('id', $id)->update(['id_status' => 2]);
            return redirect('/dashboard')->with('Pemesanan Sukses', 'Jadwal diterima');
        } else {
            Pemesanan::where('id', $id)->update(['id_status' => 2]);
            return redirect('/dashboard')->with('Pemesanan Sukses', 'Jadwal diterima');
        }
    }

    public function cancel($id)
    {
        Jadwal::where('id_pemesanan', '=', $id)->delete();
        Pemesanan::where('id', $id)->update(['id_status' => 3]);
        return redirect('/dashboard')->with('Pemesanan Sukses', 'Jadwal dibatalkan');   
    }

    public function cancelhapus($id)
    {
        Jadwal::where('id_pemesanan', '=', $id)->delete();
        Pemesanan::where('id', $id)->update(['id_status' => 5]);
        return redirect('/dashboard')->with('Pemesanan Sukses', 'Jadwal dibatalkan karena dihapus');
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
