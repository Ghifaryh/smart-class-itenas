<?php

namespace App\Models;

use App\Models\User;
use App\Models\Prodi;
use App\Models\Status;
use App\Models\Ruangan;
use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_dosen');
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi', 'kode');
    }
}
