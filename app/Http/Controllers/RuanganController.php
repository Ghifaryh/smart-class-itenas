<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreRuanganRequest;
use App\Http\Requests\UpdateRuanganRequest;

class RuanganController extends Controller
{
    public function index()
    {
        return view('truangan', [
            'title' => 'Tambah Ruangan',
            'param' => 'add',
            'ruangan' => Ruangan::all(),
        ]);
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
        $validatedData = $request->validate([
            'nama' => ['required'],
            'fasilitas' => ['required'],
        ]);
        
        // dd($request);
        Ruangan::create($validatedData);
        return response()->json(
            [
                'success' => true,
            ]
        );
    }
    
    public function edit($id)
    {
        $ruangan = Ruangan::findorfail($id);
        
        return view('truangan', [
            'title' => 'Tambah Ruangan',
            'param' => 'edit',
            'ruanganedt' => $ruangan,
            'ruangan' => Ruangan::all(),
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::findorfail($id);

        $this->validate($request, [
            'nama' => ['required'],
            'fasilitas' => ['required'],
        ]);

        $ruangan->update([
            'nama' => $request->nama,
            'fasilitas' => $request->fasilitas,
        ]);
        Alert::success('Success','Data ruangan berhasil diupdate');
        return redirect('/truangan');
    }

    public function destroy($id)
    {
        Ruangan::destroy($id);
        Alert::success('Success','Data ruangan berhasil dihapus');
        return redirect('/truangan');
    }
}
