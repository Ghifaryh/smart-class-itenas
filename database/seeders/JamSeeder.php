<?php

namespace Database\Seeders;

use App\Models\Jam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jam::create([
            'jam_pakai' => '07:00',
        ]);

        Jam::create([
            'jam_pakai' => '08:00',
        ]);

        Jam::create([
            'jam_pakai' => '09:00',
        ]);

        Jam::create([
            'jam_pakai' => '10:00',
        ]);

        Jam::create([
            'jam_pakai' => '11:00',
        ]);

        Jam::create([
            'jam_pakai' => '12:00',
        ]);

        Jam::create([
            'jam_pakai' => '13:00',
        ]);

        Jam::create([
            'jam_pakai' => '14:00',
        ]);
        
        Jam::create([
            'jam_pakai' => '15:00',
        ]);

        Jam::create([
            'jam_pakai' => '16:00',
        ]);

        Jam::create([
            'jam_pakai' => '17:00',
        ]);
    }
}
