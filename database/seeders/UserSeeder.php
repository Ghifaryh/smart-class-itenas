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
            'name' => 'Ghifary',
            'email' => 'mhghifaryy@gmail.com',
            'level' => 'admin',
            'kode_dosen' => '1111',
            'password' => Hash::make('1111'),
        ]);
    }
}
