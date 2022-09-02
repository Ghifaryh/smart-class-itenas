<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Home::create([
            'kategori' => 'about',
            'deskripsi' => '<p class="text-about" style="text-align: justify">
                Smart Classroom adalah sebuah kelas yang memiliki fasilitas teknologi untuk melakukan kegiatan
                pembelajaran secara hybrid yang memiliki fasilitas seperti Iceboard, AC, Webcam dengan kualitas HD,
                Speaker, dan fasilitas Internet yang cepat.
            </p>
            <p>
                Smart Classroom memiliki 5 ruangan dengan kapasitas masing-masing 20 orang dan disetiap
                ruangannya terdapat peredam suara.
            </p>',
        ]);
    }
}
