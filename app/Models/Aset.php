<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Aset extends Model
{
    use HasFactory;

    protected $guarded = []; 

    // 1. Relasi ke tabel Ruangan (INI YANG TADI TIDAK SENGAJA TERHAPUS)
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }

    // 2. Relasi ke tabel Pengecekan (Yang baru kita tambahkan)
    public function pengecekan()
    {
        return $this->hasMany(Pengecekan::class, 'aset_id', 'id');
    }

    public function pengecekans()
    {
        // Menandakan bahwa 1 Aset bisa memiliki banyak data Pengecekan
        return $this->hasMany(Pengecekan::class, 'aset_id');
    }
}