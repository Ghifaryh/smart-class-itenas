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
            'no_ruangan' => 1,
            'nama' => 'Ruangan 1',
            'fasilitas' => 'AC, Proyektor, kursi, meja',
        ]);

        Ruangan::create([
            'no_ruangan' => 2,
            'nama' => 'Ruangan 2',
            'fasilitas' => 'AC, Proyektor, kursi, meja',
        ]);

        Ruangan::create([
            'no_ruangan' => 3,
            'nama' => 'Ruangan 3',
            'fasilitas' => 'AC, Proyektor, kursi, meja',
        ]);

        Ruangan::create([
            'no_ruangan' => 4,
            'nama' => 'Ruangan 4',
            'fasilitas' => 'AC, Proyektor, kursi, meja',
        ]);

        Ruangan::create([
            'no_ruangan' => 5,
            'nama' => 'Ruangan 5',
            'fasilitas' => 'AC, Proyektor, kursi, meja',
        ]);

        // Ruangan::create([
        //     'nama' => 'Ruangan 6',
        //     'fasilitas' => 'AC, Proyektor, kursi, meja',
        // ]);
    }
}
