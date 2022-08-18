<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prodi::create([
            'kode' => 11,
            'nama' => 'Teknik Elektro',
        ]);

        Prodi::create([
            'kode' => 12,
            'nama' => 'Teknik Mesin',
        ]);

        Prodi::create([
            'kode' => 13,
            'nama' => 'Teknik Industri',
        ]);

        Prodi::create([
            'kode' => 14,
            'nama' => 'Teknik Kimia',
        ]);

        Prodi::create([
            'kode' => 15,
            'nama' => 'Informatika',
        ]);

        Prodi::create([
            'kode' => 16,
            'nama' => 'Sistem Informasi',
        ]);

        Prodi::create([
            'kode' => 21,
            'nama' => 'Arsitektur',
        ]);

        Prodi::create([
            'kode' => 22,
            'nama' => 'Teknik Sipil',
        ]);

        Prodi::create([
            'kode' => 23,
            'nama' => 'Teknik Geodesi',
        ]);

        Prodi::create([
            'kode' => 24,
            'nama' => 'Perencanaan Wilayah dan Tataruang/Planologi',
        ]);

        Prodi::create([
            'kode' => 25,
            'nama' => 'Teknik Lingkungan',
        ]);

        Prodi::create([
            'kode' => 31,
            'nama' => 'Desain Interior',
        ]);

        Prodi::create([
            'kode' => 32,
            'nama' => 'Desain Produk',
        ]);

        Prodi::create([
            'kode' => 33,
            'nama' => 'Desain Komunikasi Visual',
        ]);
    }
}
