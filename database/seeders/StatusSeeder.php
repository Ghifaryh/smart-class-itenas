<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'keterangan' => 'Menunggu Konfirmasi',
        ]);

        Status::create([
            'keterangan' => 'Diterima',
        ]);

        Status::create([
            'keterangan' => 'Dibatalkan',
        ]);

        Status::create([
            'keterangan' => 'Dihapus',
        ]);

        Status::create([
            'keterangan' => 'Dibatalkan (Dihapus)',
        ]);

        Status::create([
            'keterangan' => 'Menunggu Verifikasi',
        ]);

        Status::create([
            'keterangan' => 'Terverifikasi',
        ]);

        Status::create([
            'keterangan' => 'Ditolak',
        ]);
    }
}
