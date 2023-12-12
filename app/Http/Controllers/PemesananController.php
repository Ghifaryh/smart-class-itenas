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
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePemesananRequest;
use App\Http\Requests\UpdatePemesananRequest;
use Illuminate\Validation\ValidationException;
use phpDocumentor\Reflection\PseudoTypes\False_;

class PemesananController extends Controller
{
    public function daftar(Request $request)
    {
        // return ([$request->file('fileRPS')->store('File-RPS'),$request->file('fileSertif')->store('File-Sertif')]);

        $validatedData = $request->validate([
            'tanggal_pinjam' => ['required', 'after_or_equal:' . Carbon::now()->format('d-m-Y')],
            'jam_masuk' => ['required'],
            'jam_keluar' => ['required', 'after:jam_masuk'],
            'id_ruangan' => ['required'],
            'prodi' => ['required'],
            'matakuliah' => ['required'],
            'dosen_matkul' => ['required'],
            'fileRPS' => ['required', 'file', 'max:5120', 'mimes:pdf'],
            'fileSertif' => ['required', 'file', 'max:5120', 'mimes:pdf'],
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

        return redirect('scr/dashboard');
    }

    public function ajaxRequestPost(Request $request)
    {
        // dd($request);

        $validator = Validator::make($request->all(), [
            'tanggal_pinjam' => ['required', 'after_or_equal:' . Carbon::now()->format('d-m-Y')],
            'jam_masuk' => ['required'],
            'jam_keluar' => ['required', 'after:jam_masuk'],
            'id_ruangan' => ['required'],
            'prodi' => ['required'],
            'matakuliah' => ['required'],
            'dosen_matkul' => ['required'],
            'fileRPS' => ['required', 'file', 'max:5120', 'mimes:pdf'],
            'fileSertif' => ['required', 'file', 'max:5120', 'mimes:pdf'],
            'kelas' => ['required'],
            'id_pemesan' => ['required'],
            'id_status' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->toArray()]);
        } else {
            $validatedData = $validator->validate();

            if ($request->file('fileRPS')) {
                $file_dokumen = $request->file('fileRPS');
                $file_dokumen_name = $file_dokumen->getClientOriginalName();
                $file_dokumen_name = preg_replace('!\s+!', ' ', $file_dokumen_name);
                $file_dokumen_name = str_replace(' ', '_', $file_dokumen_name);
                $file_dokumen_name = str_replace('%', '', $file_dokumen_name);
                $file_dokumen->move(public_path('storage/File-RPS'), $file_dokumen_name);
                $validatedData['fileRPS'] = "File-RPS/" . $file_dokumen_name;
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
                $validatedData['fileSertif'] = "File-Sertif/" . $file_dokumen_sertifname;
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

    public function hariIndo($hariInggris)
    {
        switch ($hariInggris) {
            case 'Sunday':
                return 'Minggu';
            case 'Monday':
                return 'Senin';
            case 'Tuesday':
                return 'Selasa';
            case 'Wednesday':
                return 'Rabu';
            case 'Thursday':
                return 'Kamis';
            case 'Friday':
                return 'Jumat';
            case 'Saturday':
                return 'Sabtu';
            default:
                return 'hari tidak valid';
        }
    }

    public function bulanIndo($bulanInggris)
    {
        switch ($bulanInggris) {
            case 'Jan':
                return 'Januari';
            case 'Feb':
                return 'Februari';
            case 'Mar':
                return 'Maret';
            case 'Apr':
                return 'April';
            case 'May':
                return 'Mei';
            case 'Jun':
                return 'Juni';
            case 'Jul':
                return 'Juli';
            case 'Aug':
                return 'Agustus';
            case 'Sep':
                return 'September';
            case 'Oct':
                return 'Oktober';
            case 'Nov':
                return 'November';
            case 'Dec':
                return 'Desember';
            default:
                return 'bulan tidak valid';
        }
    }

    public function adminList(Request $request)
    {
        if ($request->ajax()) {
            $pesanan = Pemesanan::all();
            return DataTables::of($pesanan)
                ->addIndexColumn()
                ->editColumn('waktu_pakai', function ($row) {
                    $waktupakai = $this->hariIndo(date('l', strtotime($row->tanggal_pinjam))) . ', ' . date('d', strtotime($row->tanggal_pinjam)) . ' ' . $this->bulanIndo(date('M', strtotime($row->tanggal_pinjam))) . '<br>' . '(' . date('H:i', strtotime($row->jam_masuk)) . '-' . date('H:i', strtotime($row->jam_keluar)) . ')';
                    return $waktupakai;
                })
                ->editColumn('prodi', function ($row) {
                    return $row->Prodi->nama;
                })
                ->editColumn('status', function ($row) {
                    if ($row->Status->keterangan == "Menunggu Konfirmasi") {
                        return '<font class="fw-bold text-warning" style="">' . $row->Status->keterangan . '</font>';
                    } else if ($row->Status->keterangan == "Diterima") {
                        return '<font class="fw-bold text-success" style="">' . $row->Status->keterangan . '</font>';
                    } else if ($row->Status->keterangan == "Dijadwalkan") {
                        return '<font class="fw-bold text-primary" style="">' . $row->Status->keterangan . '</font>';
                    } else {
                        return '<font class="fw-bold text-danger" style="">' . $row->Status->keterangan . '</font>' . '<br>' . '<button data-name="' . $row->pesan . '" class="badge border-0 btnInfo ingfo text-danger"><i class="fa-solid fa-circle-info"></i></button>';
                    }
                })
                ->editColumn('pemesan', function ($row) {
                    return $row->User->name;
                })
                ->editColumn('fileRPS', function ($row) {
                    $edit_url = asset('storage/' . $row->fileRPS);
                    $action_btn = '
                <form action="' . $edit_url . '">
                <button class="badge bg-primary border-0 btnDownload" type="submit" ><i class="fa-solid fa-cloud-arrow-down"></i></button>
                </form>';
                    return $action_btn;
                })
                ->editColumn('fileSertif', function ($row) {
                    $edit_url = asset('storage/' . $row->fileSertif);
                    $action_btn = '
                <form action="' . $edit_url . '">
                <button class="badge bg-primary border-0 btnDownload" type="submit" ><i class="fa-solid fa-cloud-arrow-down"></i></button>
                </form>';
                    return $action_btn;
                })
                ->editColumn('waktu_pesan', function ($row) {
                    return date('d/m/Y', strtotime($row->updated_at)) . '<br>' . date('H : i : s', strtotime($row->updated_at));
                })
                ->editColumn('action', function ($row) {
                    $btnTerimaAdmin = '
                    <button
                        data-id="' . $row->id . '" data-name="' . $row->matakuliah . '"
                        class="badge bg-success border-0 terima_admin">Terima
                    </button>';
                    $btnPrintAdmin = '
                    <button
                        data-id="' . $row->id . '" data-name="' . $row->matakuliah . '"
                        class="badge bg-primary border-0 print_bukti">Cetak
                    </button>';
                    $btnBatalAdmin = '
                    <button
                        data-id="' . $row->id . '" data-name="' . $row->matakuliah . '"
                        class="badge bg-danger border-0 batal_admin">Batal
                    </button>';
                    $btnBatalHapusAdmin = '
                    <button
                        data-id="' . $row->id . '" data-name="' . $row->matakuliah . '"
                        class="badge bg-danger border-0 batalhapus_admin">Batal
                    </button>';
                    $btnHapusAdmin = '
                    <button
                        data-id="' . $row->id . '" data-name="' . $row->matakuliah . '"
                        class="badge bg-danger border-0 hapus_admin">Hapus
                    </button>';
                    if ($row->Status->keterangan == 'Dihapus' or $row->Status->keterangan == 'Dibatalkan (Dihapus)') {
                        return $btnBatalHapusAdmin . $btnHapusAdmin;
                    } elseif ($row->Status->keterangan == 'Diterima') {
                        return $btnTerimaAdmin . $btnPrintAdmin . $btnBatalAdmin . $btnHapusAdmin;
                    } else {
                        return $btnTerimaAdmin . $btnBatalAdmin . $btnHapusAdmin;
                    }
                })
                ->rawColumns(['waktu_pakai', 'waktu_pesan', 'action', 'fileRPS', 'fileSertif', 'status', 'prodi'])
                ->make(true);
        }
    }

    public function dosenList(Request $request)
    {
        if ($request->ajax()) {
            $pesanan = Pemesanan::where('id_pemesan', auth()->user()->id)->whereNot('id_status', 4)->whereNot('id_status', 5)->get();
            return DataTables::of($pesanan)
                ->addIndexColumn()
                ->editColumn('waktu_pakai', function ($row) {
                    $waktupakai = $this->hariIndo(date('l', strtotime($row->tanggal_pinjam))) . ', ' . date('d', strtotime($row->tanggal_pinjam)) . ' ' . $this->bulanIndo(date('M', strtotime($row->tanggal_pinjam))) . '<br>' . '(' . date('H:i', strtotime($row->jam_masuk)) . '-' . date('H:i', strtotime($row->jam_keluar)) . ')';
                    return $waktupakai;
                })
                ->editColumn('prodi', function ($row) {
                    return $row->Prodi->nama;
                })
                ->editColumn('status', function ($row) {
                    if ($row->Status->keterangan == "Menunggu Konfirmasi") {
                        return '<font class="fw-bold text-warning" style="">' . $row->Status->keterangan . '</font>';
                    } elseif ($row->Status->keterangan == "Diterima") {
                        return '<font class="fw-bold text-success" style="">' . $row->Status->keterangan . '</font>';
                    } elseif ($row->Status->keterangan == "Dijadwalkan") {
                        return '<font class="fw-bold text-primary" style="">' . $row->Status->keterangan . '</font>';
                    } else {
                        return '<font class="fw-bold text-danger" style="">' . $row->Status->keterangan . '</font>' . '<br>' . '<button data-name="' . $row->pesan . '" class="badge border-0 btnInfo ingfo text-danger"><i class="fa-solid fa-circle-info"></i></button>';
                    }
                })
                ->editColumn('pemesan', function ($row) {
                    return $row->User->name;
                })
                ->editColumn('fileRPS', function ($row) {
                    $edit_url = asset('storage/' . $row->fileRPS);
                    $action_btn = '
                <form action="' . $edit_url . '">
                <button class="badge bg-primary border-0 btnDownload" type="submit" ><i class="fa-solid fa-cloud-arrow-down"></i></button>
                </form>';
                    return $action_btn;
                })
                ->editColumn('fileSertif', function ($row) {
                    $edit_url = asset('storage/' . $row->fileSertif);
                    $action_btn = '
                <form action="' . $edit_url . '">
                <button class="badge bg-primary border-0 btnDownload" type="submit" ><i class="fa-solid fa-cloud-arrow-down"></i></button>
                </form>';
                    return $action_btn;
                })
                ->addColumn('action', function ($row) {
                    // $edit_url = route('admin.kecamatan.edit', $row->id);
                    $btnHapusDosen = '
                    <button
                        data-id="' . $row->id . '" data-name="' . $row->matakuliah . '"
                        class="badge bg-danger border-0 hapus_dosen">Hapus
                    </button>';
                    $btnPrintDosen = '
                    <button
                        data-id="' . $row->id . '" data-name="' . $row->matakuliah . '"
                        class="badge bg-primary border-0 print_bukti">Cetak
                    </button>';
                    if ($row->Status->keterangan == 'Diterima') {
                        return $btnPrintDosen . $btnHapusDosen;
                    } else {
                        return $btnHapusDosen;
                    }
                })
                ->rawColumns(['waktu_pakai', 'action', 'fileRPS', 'fileSertif', 'status', 'prodi'])
                ->make(true);
        }
    }

    public function hapusKet($id)
    {
        Pemesanan::where('id', $id)->update(['id_status' => 4]);

        return response()->json(['status' => TRUE]);
    }

    public function bukti($id)
    {
        return view('bukti', [
            'title' => 'Print Bukti',
            'buktis' => Pemesanan::find($id),
        ]);
    }

    public function destroy($id)
    {
        $check = Pemesanan::find($id);
        $fileRPScount = Pemesanan::where("fileRPS", "=", $check->fileRPS)->count();
        $fileSertifcount = Pemesanan::where("fileSertif", "=", $check->fileSertif)->count();

        if ($fileRPScount == 1) {
            if ($check->fileRPS !== null) {
                Storage::delete($check->fileRPS);
            }
        }
        if ($fileSertifcount == 1) {
            if ($check->fileSertif !== null) {
                Storage::delete($check->fileSertif);
            }
        }
        Pemesanan::destroy($id);

        // return redirect('/dashboard')->with('Pemesanan Sukses', 'Data pemesanan berhasil dihapus');
        return response()->json(['status' => TRUE]);
    }

    public function accept($id)
    {
        $pesanan = Pemesanan::find($id);
        $check = Jadwal::where('id_pemesanan', '=', $id)->first();

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
            // return redirect('/dashboard')->with('Pemesanan Sukses', 'Jadwal diterima');
            return response()->json(['status' => TRUE]);
        } else {
            Pemesanan::where('id', $id)->update(['id_status' => 2]);
            return response()->json(['status' => TRUE]);
        }
    }

    public function cancel($id, $pesan)
    {
        Jadwal::where('id_pemesanan', '=', $id)->delete();
        Pemesanan::where('id', $id)->update(['id_status' => 3, 'pesan' => $pesan]);
        // return redirect('/dashboard')->with('Pemesanan Sukses', 'Jadwal dibatalkan');
        return response()->json(['status' => TRUE]);
    }

    public function cancelhapus($id, $pesan)
    {
        Jadwal::where('id_pemesanan', '=', $id)->delete();
        Pemesanan::where('id', $id)->update(['id_status' => 5, 'pesan' => $pesan]);
        return response()->json(['status' => TRUE]);
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
