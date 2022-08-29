<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreJadwalRequest;
use App\Http\Requests\UpdateJadwalRequest;

class JadwalController extends Controller
{
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

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $jadwal = Jadwal::all();
            return DataTables::of($jadwal)
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
                ->addColumn('action', function ($row) {
                    // $edit_url = route('admin.kecamatan.edit', $row->id);
                    $id = $row->id;
                    $nama = $row->matakuliah;
                    $btn = '
                <button
                    data-id="' . $id . '" data-name="' . $nama . '"
                    class="badge bg-danger border-0 hapus_jadwal">Hapus
                </button>
                ';
                    return $btn;
                })
                ->rawColumns(['waktu_pakai', 'action', 'status', 'prodi'])
                ->make(true);
        }
    }

    public function destroy($id)
    {
        Jadwal::destroy($id);
        // return redirect('/dashboard')->with('Jadwal Sukses', 'Jadwal berhasil dihapus!');
        return response()->json(['status' => TRUE]);
    }
    
}
