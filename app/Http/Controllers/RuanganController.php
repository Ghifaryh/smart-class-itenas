<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreRuanganRequest;
use App\Http\Requests\UpdateRuanganRequest;

class RuanganController extends Controller
{
    public function index()
    {
        return view('truangan', [
            'title' => 'Tambah Ruangan',
            'param' => 'add',
            // 'ruangan' => Ruangan::all(),
        ]);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $ruangan = Ruangan::all();
            return DataTables::of($ruangan)
                ->addIndexColumn()
                ->editColumn('action', function ($row) {
                    // $edit_url = route('admin.kecamatan.edit', $row->id);
                    $btnRuangan = '
                    <button
                        data-id="' . $row->id . '" data-name="' . $row->nama . '"
                        class="badge bg-primary border-0 edit_ruangan">Edit
                    </button>
                    <button
                        data-id="' . $row->id . '" data-name="' . $row->nama . '"
                        class="badge bg-danger border-0 hapus_ruangan">Hapus
                    </button>
                    ';

                    return $btnRuangan;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function tambah(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required'],
            'fasilitas' => ['required'],
        ]);

        // dd($request);
        Ruangan::create($validatedData);

        return redirect('/truangan')->with('success', 'Data ruangan berhasil ditambahkan!');
    }

    public function ajaxRequestRuangan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_ruangan' => ['required'],
            'nama' => ['required'],
            'fasilitas' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->toArray()]);
        }else{
            $validatedData = $validator->validate();
            
            Ruangan::create($validatedData);
            return response()->json(
                [
                    'success' => true,
                ]
            );
        }   
        // dd($request);
    }
    
    public function edit($id)
    {
        $ruangan = Ruangan::findorfail($id);
        // Alert::success('Success','Data ruangan siap untuk diedit');
        return view('truangan', [
            'title' => 'Tambah Ruangan',
            'param' => 'edit',
            'ruanganedt' => $ruangan,
            // 'ruangan' => Ruangan::all(),
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::findorfail($id);

        $validator = Validator::make($request->all(), [
            'no_ruangan' => ['required','integer'],
            'nama' => ['required'],
            'fasilitas' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->toArray()]);
        }else{

            $ruangan->update([
                'no_ruangan' => $request->no_ruangan,
                'nama' => $request->nama,
                'fasilitas' => $request->fasilitas,
            ]);

            return response()->json(
                [
                    'success' => true,
                ]
            );
        }   
    }

    public function destroy($id)
    {
        Ruangan::destroy($id);
        // Alert::success('Success','Data ruangan berhasil dihapus');
        return response()->json(['status' => TRUE]);
    }
}
