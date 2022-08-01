<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('ujicoba.dashboard', [
            'title' => 'Dashboard'
        ]);
    }

    // public function status()
    // {
    //     return view('ujicoba.statuspesan', [
    //         'title' => 'Status Pemesanan'
    //     ]);
    // }
}