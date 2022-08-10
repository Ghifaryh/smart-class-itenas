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
            'keterangan' => 'Ruangan 1'
        ]);

        Ruangan::create([
            'keterangan' => 'Ruangan 2'
        ]);

        Ruangan::create([
            'keterangan' => 'Ruangan 3'
        ]);

        Ruangan::create([
            'keterangan' => 'Ruangan 4'
        ]);

        Ruangan::create([
            'keterangan' => 'Ruangan 5'
        ]);

        Ruangan::create([
            'keterangan' => 'Ruangan 6'
        ]);
    }
}
