<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
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
        $validator = Validator::make($request->all(), [
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
        
        // Alert::success('Success','Data ruangan berhasil diupdate');
        return redirect('/truangan');
    }

    public function destroy($id)
    {
        Ruangan::destroy($id);
        // Alert::success('Success','Data ruangan berhasil dihapus');
        return redirect('/truangan');
    }
}
