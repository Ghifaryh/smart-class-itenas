<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Dummy Admin',
            'email' => 'gip81rib82@gmail.com',
            'level' => 'admin',
            'kode_dosen' => 'asawawu',
            'password' => Hash::make('911'),
        ]);

        User::create([
            'name' => 'SCR Admin',
            'email' => 'scr.itenas.ac.id',
            'level' => 'admin',
            'kode_dosen' => 'SCRAdmin22',
            'password' => Hash::make('22itenasscr'),
        ]);

        User::create([
            'name' => 'Dummy Dosen',
            'email' => 'aribocid1@gmail.com',
            'level' => 'dosen',
            'kode_dosen' => 'katakanarib',
            'password' => Hash::make('jokowi'),
        ]);
    }
}
