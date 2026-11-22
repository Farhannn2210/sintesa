<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aset;

class DenahController extends Controller
{
    public function index()
    {
        // Mengambil semua aset berjenis UPS beserta 1 data pengecekan terbarunya
        $asets = Aset::with(['pengecekans' => function($query) {
            $query->latest()->limit(1);
        }])->where('kategori', 'UPS')->get();

        return view('admin.denah', compact('asets'));
    }
}