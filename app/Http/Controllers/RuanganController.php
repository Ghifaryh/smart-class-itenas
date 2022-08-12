<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRuanganRequest;
use App\Http\Requests\UpdateRuanganRequest;

class RuanganController extends Controller
{
    public function index()
    {
        return view('ruangan', [
            'title' => 'Tambah Ruangan',
            'ruangan' => Ruangan::all(),
        ]);


    }

    public function tambah(Request $request)
    {
        $validatedData = $request->validate([
            'keterangan' => ['required'],
        ]);
        
        // dd($request);
        Ruangan::create($validatedData);

        return redirect('/ruangan')->with('success', 'Data pemesanan berhasil diinput!');
    }

}
