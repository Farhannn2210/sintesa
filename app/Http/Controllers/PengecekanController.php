<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengecekan;
use App\Models\Aset;

class PengecekanController extends Controller
{
    public function dashboard()
    {
        // Mengambil data dinamis untuk halaman dashboard petugas/admin
        $totalAsetDikecek = Pengecekan::count();
        $totalLaporan = Pengecekan::where('status', '!=', 'Normal')->count();
        $riwayatTerbaru = Pengecekan::with('aset')->orderBy('created_at', 'desc')->take(5)->get();

        return view('petugas.dashboard', compact('totalAsetDikecek', 'totalLaporan', 'riwayatTerbaru'));
    }

    public function index()
    {
        // Mengambil semua data pengecekan dari yang terbaru, beserta relasi asetnya
        $riwayats = Pengecekan::with('aset')->orderBy('created_at', 'desc')->get();
        
        // DIREVISI: Sesuai posisi file riwayat.blade.php di dalam folder views/admin/
        return view('admin.riwayat', compact('riwayats'));
    }
    
    public function store(Request $request)
    {
        // 1. Cari data aset berdasarkan kode_qr yang dilempar dari form
        $aset = Aset::where('kode_qr', $request->kode_aset)->first();

        if (!$aset) {
            return redirect('/scan')->with('error', 'Aset tidak ditemukan!');
        }

        // 2. Masukkan data ke tabel pengecekans beserta nama pengguna saat pengecekan
        Pengecekan::create([
            'aset_id'        => $aset->id,
            'user_id'        => auth()->id() ?? 1, // Mengambil ID user yang sedang login, fallback ke 1 jika belum
            'nama_pengguna'  => $aset->nama_pengguna,
            'tanggal_cek'    => now(),
            'status'         => $request->kondisi,
            'beban'          => $request->load,       // Dari input Load (%)
            'suhu'           => $request->suhu,       // Dari input Suhu
            'tegangan'       => $request->output,     // Dari input Output (V)
            'battery_health' => $request->baterai,    // Dari input Baterai (%)
            'catatan'        => $request->catatan,
        ]);

        // 3. Update status kondisi terbaru di tabel asets master
        $aset->update([
            'kondisi' => $request->kondisi
        ]);

        // 4. Balik ke halaman scan dengan pesan sukses
        return redirect('/scan')->with('success', 'Hasil pengecekan berhasil disimpan!');
    }

    // --- FUNGSI EKSPOR LAPORAN EXCEL --- //
    public function exportExcel()
    {
        // Tarik semua data pengecekan dari database
        $riwayats = Pengecekan::with('aset.ruangan')->latest()->get();

        // Trik membuat Excel pakai HTML Native agar bisa berwarna tanpa Library
        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
        $html .= '<head><meta charset="utf-8"></head><body>';
        $html .= '<table border="1" style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif;">';
        
        // Judul Laporan (colspan diubah menjadi 8 mengikuti jumlah kolom)
        $html .= '<tr><th colspan="8" style="background-color: #004b7c; color: #ffffff; font-size: 16px; font-weight: bold; height: 40px; text-align: center;">LAPORAN RIWAYAT PENGECEKAN ASET TI - BPS PROV. SULTENG</th></tr>';
        
        // Header Tabel Kolom
        $html .= '<tr>';
        $html .= '<th style="background-color: #f28f20; color: #ffffff; font-weight: bold; height: 30px;">WAKTU CEK</th>';
        $html .= '<th style="background-color: #f28f20; color: #ffffff; font-weight: bold;">KODE QR / NUP</th>';
        $html .= '<th style="background-color: #f28f20; color: #ffffff; font-weight: bold;">NAMA PERANGKAT</th>';
        $html .= '<th style="background-color: #f28f20; color: #ffffff; font-weight: bold;">LOKASI RUANGAN</th>';
        $html .= '<th style="background-color: #f28f20; color: #ffffff; font-weight: bold;">PENGGUNA ASET</th>';
        $html .= '<th style="background-color: #f28f20; color: #ffffff; font-weight: bold;">STATUS</th>';
        $html .= '<th style="background-color: #f28f20; color: #ffffff; font-weight: bold;">PARAMETER (UPS)</th>';
        $html .= '<th style="background-color: #f28f20; color: #ffffff; font-weight: bold;">CATATAN</th>';
        $html .= '</tr>';

        // Looping Data ke Excel
        foreach ($riwayats as $row) {
            $parameter = "Suhu: " . ($row->suhu ?? '-') . "°C | Baterai: " . ($row->battery_health ?? '-') . "%";
            if (strtolower($row->aset->kategori ?? '') != 'ups') {
                $parameter = 'N/A';
            }
            
            // Ambil rekam jejak pengguna saat dicek, atau fallback ke pengguna aset saat ini
            $pengguna = $row->nama_pengguna ?? ($row->aset->nama_pengguna ?? 'Belum ditentukan');
            
            // Atur Warna Teks Status
            $color = '#000000';
            if (strtolower($row->status) == 'normal') $color = '#10b981'; // Hijau
            elseif (strtolower($row->status) == 'rusak ringan') $color = '#f59e0b'; // Oranye
            elseif (strtolower($row->status) == 'rusak berat') $color = '#ef4444'; // Merah

            $html .= '<tr>';
            $html .= '<td style="vertical-align: top;">' . ($row->created_at ? $row->created_at->format('d M Y, H:i') : '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . ($row->aset->kode_qr ?? '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . ($row->aset->nama_perangkat ?? '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . ($row->aset->ruangan->nama_ruangan ?? '-') . '</td>';
            $html .= '<td style="vertical-align: top; font-weight: bold;">' . htmlspecialchars($pengguna) . '</td>';
            $html .= '<td style="vertical-align: top; color: ' . $color . '; font-weight: bold;">' . ucwords($row->status) . '</td>';
            $html .= '<td style="vertical-align: top;">' . $parameter . '</td>';
            $html .= '<td style="vertical-align: top;">' . ($row->catatan ?? '-') . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table></body></html>';

        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="Laporan_Riwayat_Aset.xls"');
    }
}