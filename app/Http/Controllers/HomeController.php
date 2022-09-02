<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\Home;
use App\Models\Jadwal;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $datenext = Carbon::now()->addWeek()->format('Y-m-d');
        $date = Carbon::now()->format('Y-m-d');
        // dd($date);

        // $ruangan1 = Jadwal::where('id_ruangan', '=', 1)->where('jadwal_masuk', '>=', $date)->whereNot('id_status', 4)->get();
        // isset($output);
        // $ruangan1 = isset($output) ? ($output) : 0;
        
        return view('home', [
            "title" => "Home",
            "jdwlrgn1" => Jadwal::where('id_ruangan', '=', 1)->where('tanggal_pinjam', '>=', $date)->where('tanggal_pinjam', '<=', $datenext)->get(),
            "jdwlrgn2" => Jadwal::where('id_ruangan', '=', 2)->where('tanggal_pinjam', '>=', $date)->where('tanggal_pinjam', '<=', $datenext)->get(),
            "jdwlrgn3" => Jadwal::where('id_ruangan', '=', 3)->where('tanggal_pinjam', '>=', $date)->where('tanggal_pinjam', '<=', $datenext)->get(),
            "jdwlrgn4" => Jadwal::where('id_ruangan', '=', 4)->where('tanggal_pinjam', '>=', $date)->where('tanggal_pinjam', '<=', $datenext)->get(),
            "jdwlrgn5" => Jadwal::where('id_ruangan', '=', 5)->where('tanggal_pinjam', '>=', $date)->where('tanggal_pinjam', '<=', $datenext)->get(),
            "jdwlrgn6" => Jadwal::where('id_ruangan', '=', 6)->where('tanggal_pinjam', '>=', $date)->where('tanggal_pinjam', '<=', $datenext)->get(),
            "ruangan" => Ruangan::count(),
            "homeabout" => Home::find(1),
            "jmlImage" => Home::where('kategori', '=', 'gambar')->count(),
            "image" => Home::where('kategori', '=', 'gambar')->get(),
        ]);
    }

    public function pengaturan()
    {        
        return view('pengaturan', [
            "title" => "Pengaturan",
            "homeabout" => Home::find(1),
        ]);
    }

    public function update($id, Request $request)
    {
        $about = Home::findorfail($id);

        $validator = Validator::make($request->all(), [
            'deskripsi' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->toArray()]);
        }else{

            $about->update([
                'deskripsi' => $request->deskripsi,
            ]);

            return response()->json(
                [
                    'success' => true,
                ]
            );
        }   
    }

    public function addImage(Request $request)
    {
        // dd($request);

        $validator = Validator::make($request->all(), [
            'kategori' => ['required'],
            'image' => ['required', 'image', 'file', 'max:5120'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->toArray()]);
        } else {
            $validatedData = $validator->validate();

            if ($request->file('image')) {
                $file_dokumen = $request->file('image');
                $file_dokumen_name = $file_dokumen->getClientOriginalName();
                $file_dokumen_name = preg_replace('!\s+!', ' ', $file_dokumen_name);
                $file_dokumen_name = str_replace(' ', '_', $file_dokumen_name);
                $file_dokumen_name = str_replace('%', '', $file_dokumen_name);
                $file_dokumen->move(public_path('storage/Image'), $file_dokumen_name);
                $validatedData['image'] = $file_dokumen_name;
                // $fileNamerps = pathinfo($request->file('fileRPS')->getClientOriginalName(), PATHINFO_FILENAME) . '-' . $request->id_pemesan . '.' . $request->file('fileRPS')->getClientOriginalExtension();
                // $validatedData['fileRPS'] = $request->file('fileRPS')->storePubliclyAs('File-RPS',$fileNamerps,'public');
            };

            $validatedData['deskripsi'] = $validatedData['image'];

            Home::create($validatedData);
            return response()->json(
                [
                    'success' => true,
                ]
            );
        }
    }

    public function listGambar(Request $request)
    {
        if ($request->ajax()) {
            $image = Home::where('kategori', '=', 'gambar')->get();
            return DataTables::of($image)
                ->addIndexColumn()
                ->editColumn('shwImage', function ($row) {
                    $url= asset('storage/Image/'.$row->deskripsi);
                    return '<img src="' . $url .'" border="0" width="200" class="img-rounded" align="center" />';
                    // return `<iframe src="'storage/Image/.$row->deskripsi'" frameborder="0" height="400"></iframe>`;
                })
                ->editColumn('action', function ($row) {
                    // $edit_url = route('admin.kecamatan.edit', $row->id);
                    $btnPengaturan = '
                <button
                    data-id="' . $row->id . '" data-name="' . $row->deskripsi . '" 
                    class="badge bg-danger border-0 hapus_image">Hapus
                </button>
                ';

                    return $btnPengaturan;
                })
                ->rawColumns(['shwImage', 'action'])
                ->make(true);
        }
    }

    public function destroy($id)
    {
        $check = Home::find($id);
        $fileGambarCount = Home::where("deskripsi","=",$check->deskripsi)->count();
        
        if ($fileGambarCount == 1) {
            if ($check->deskripsi !== null) {
                Storage::delete('Image/'.$check->deskripsi);
            }
        }

        Home::destroy($id);

        // return redirect('/dashboard')->with('Pemesanan Sukses', 'Data pemesanan berhasil dihapus');
        return response()->json(['status' => TRUE]);
    }
}
