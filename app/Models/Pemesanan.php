<?php

namespace App\Models;

use App\Models\Prodi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
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

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi', 'kode');
    }
}
