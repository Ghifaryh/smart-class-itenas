<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ruangan::create([
            'nama' => 'Ruangan 1',
            'fasilitas' => 'AC, Proyektor, kursi, meja',
        ]);

        Ruangan::create([
            'nama' => 'Ruangan 2',
            'fasilitas' => 'AC, Proyektor, kursi, meja',
        ]);

        Ruangan::create([
            'nama' => 'Ruangan 3',
            'fasilitas' => 'AC, Proyektor, kursi, meja',
        ]);

        Ruangan::create([
            'nama' => 'Ruangan 4',
            'fasilitas' => 'AC, Proyektor, kursi, meja',
        ]);

        Ruangan::create([
            'nama' => 'Ruangan 5',
            'fasilitas' => 'AC, Proyektor, kursi, meja',
        ]);

        // Ruangan::create([
        //     'nama' => 'Ruangan 6',
        //     'fasilitas' => 'AC, Proyektor, kursi, meja',
        // ]);
    }
}
