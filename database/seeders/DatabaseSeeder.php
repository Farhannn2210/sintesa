<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Login Default
        User::create([
            'name' => 'Admin IPDS',
            'email' => 'admin@bps.go.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Tim IT SINTESA',
            'email' => 'petugas@bps.go.id',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
        ]);

        // 2. Data Ruangan Utama BPS Sulteng
        Ruangan::create([
            'nama_ruangan' => 'Ruang Server / IPDS',
            'lantai'       => 'Lantai 2'
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Ruangan Pengolahan',
            'lantai'       => 'Lantai 2'
        ]);
    }
}