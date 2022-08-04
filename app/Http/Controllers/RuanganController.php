<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Http\Requests\StoreRuanganRequest;
use App\Http\Requests\UpdateRuanganRequest;

class RuanganController extends Controller
{
    public function index()
    {
        return view('ujicoba.dashboard', [
            "ruangan" => Ruangan::all(),
        ]);


    }

}
