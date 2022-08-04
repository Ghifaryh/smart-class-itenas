<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('ujicoba.dashboard', [
            'title' => 'Dashboard',
            "ruangan" => Ruangan::all()
        ]);
    }

    // public function status()
    // {
    //     return view('ujicoba.statuspesan', [
    //         'title' => 'Status Pemesanan'
    //     ]);
    // }
}