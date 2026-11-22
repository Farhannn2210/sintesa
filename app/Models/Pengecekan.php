<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengecekan extends Model
{
    use HasFactory;

    // PASTIKAN BARIS INI ADA AGAR DATA BISA DISIMPAN:
    protected $fillable = [
        'aset_id', 'user_id', 'nama_pengguna', 'tanggal_cek', 'status', 
        'beban', 'suhu', 'tegangan', 'battery_health', 'catatan'
    ];

    public function aset()
    {
        return $this->belongsTo(Aset::class);
    }
}