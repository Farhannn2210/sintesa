<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Ruangan;
use App\Models\Pengecekan; 
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        // 1. Mulai query panggil data aset beserta ruangannya
        $query = Aset::with('ruangan')->latest();

        // 2. Fungsi Search (Cari berdasarkan Nama, NUP, Kode QR, atau Nama Pengguna)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_perangkat', 'like', "%{$search}%")
                    ->orWhere('nup', 'like', "%{$search}%")
                    ->orWhere('kode_qr', 'like', "%{$search}%")
                    ->orWhere('nama_pengguna', 'like', "%{$search}%");
            });
        }

        // 3. Fungsi Filter Kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // 4. Eksekusi query
        $asets = $query->get();
        
        // UPDATE: Arahkan ke folder admin/aset
        return view('admin.aset.index', compact('asets'));
    }

    public function create()
    {
        $ruangans = Ruangan::all();
        
        // UPDATE: Arahkan ke folder admin/aset
        return view('admin.aset.create', compact('ruangans'));
    }

    public function store(Request $request)
    {
        // Validasi form dasar
        $request->validate([
            'nama_perangkat' => 'required',
            'kategori' => 'required',
            'ruangan_id' => 'required',
        ]);

        // Generate kode QR otomatis berdasarkan kategori & angka acak
        $kode_qr = 'SINTESA-' . strtoupper($request->kategori) . '-' . rand(1000, 9999);

        // Simpan data ke database
        Aset::create([
            'kode_qr' => $kode_qr,
            'nup' => $request->nup,
            'nama_perangkat' => $request->nama_perangkat,
            'kategori' => $request->kategori,
            'ruangan_id' => $request->ruangan_id,
            'nama_pengguna' => $request->nama_pengguna,
            'spesifikasi' => $request->spesifikasi,
        ]);

        return redirect()->route('aset.index')->with('success', 'Aset berhasil ditambahkan!');
    }

    // --- FUNGSI BARU UNTUK FITUR SCAN & PENGECEKAN --- //

    public function check($kode_qr)
    {
        // Mencari aset berdasarkan kode QR hasil scan
        $aset = Aset::with('ruangan')->where('kode_qr', $kode_qr)->first();
        
        if (!$aset) {
            return redirect()->route('scan.index')->with('error', 'Aset tidak ditemukan!');
        }

        $kategori = strtolower($aset->kategori);

        if ($kategori == 'ups') {
            // UPDATE: Arahkan ke folder petugas (karena file check_ups ditarik ke sana)
            return view('petugas.check_ups', compact('aset'));
            
        } elseif ($kategori == 'pc' || $kategori == 'monitor' || $kategori == 'laptop') {
            // UPDATE: Arahkan ke folder petugas
            return view('petugas.check_pc', compact('aset'));
            
        } else {
            // UPDATE: Arahkan ke folder petugas
            return view('petugas.check', compact('aset'));
        }
    }

    public function updateKondisi(Request $request, $id)
    {
        $aset = Aset::findOrFail($id);
        
        // 1. Rekam data sebagai Riwayat Pengecekan Baru beserta nama pengguna saat itu
        Pengecekan::create([
            'aset_id' => $aset->id,
            'user_id' => auth()->id() ?? null,
            'nama_pengguna' => $aset->nama_pengguna,
            'tanggal_cek' => now(),
            'status' => $request->kondisi, 
            'beban' => $request->load_capacity, 
            'suhu' => $request->suhu,
            'tegangan' => $request->tegangan,
            'battery_health' => $request->battery_health,
            'catatan' => $request->catatan
        ]);

        // 2. Update status terkini di master Aset (agar gampang dilihat di dashboard Admin)
        $aset->update([
            'kondisi' => $request->kondisi, 
            'catatan' => $request->catatan
        ]);

        return redirect('/scan')->with('success', 'Hasil pengecekan ' . $aset->nama_perangkat . ' berhasil disimpan!');
    }

    public function edit($id)
    {
        $aset = Aset::findOrFail($id);
        $ruangans = Ruangan::all();
        
        return view('admin.aset.edit', compact('aset', 'ruangans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_perangkat' => 'required',
            'kategori' => 'required',
            'ruangan_id' => 'required',
        ]);

        $aset = Aset::findOrFail($id);
        
        $aset->update([
            'nup' => $request->nup,
            'nama_perangkat' => $request->nama_perangkat,
            'kategori' => $request->kategori,
            'ruangan_id' => $request->ruangan_id,
            'nama_pengguna' => $request->nama_pengguna,
            'spesifikasi' => $request->spesifikasi,
        ]);

        return redirect()->route('aset.index')->with('success', 'Data aset berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $aset = Aset::findOrFail($id);
        $aset->delete();
        
        return redirect()->route('aset.index')->with('success', 'Data aset berhasil dihapus permanen!');
    }
}