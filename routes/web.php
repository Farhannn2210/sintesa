<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\PengecekanController;
use App\Http\Controllers\DenahController;
use App\Http\Controllers\AuthController;
use App\Models\Pengecekan;
use App\Models\Aset;
use Illuminate\Http\Request;
use App\Http\Middleware\CegahKembali;
use Carbon\Carbon;

// ==========================================
// 1. RUTE PUBLIK (BEBAS AKSES TANPA LOGIN)
// ==========================================

Route::get('/', function () {
    return redirect('/login');
});

// Halaman Form Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Proses Login (Tombol Masuk Ditekan)
Route::post('/login', [AuthController::class, 'authenticate']);


// ==========================================
// 2. GEMBOK UTAMA: WAJIB LOGIN & ANTI-KEMBALI (MIDDLEWARE)
// ==========================================
Route::middleware(['auth', CegahKembali::class])->group(function () {

    // Proses Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ------------------------------------------
    // RUTE ADMIN
    // ------------------------------------------
    
    // Dashboard Utama Admin
    Route::get('/admin/dashboard', function () {
        $total = Aset::count();
        $normal = Aset::where('kondisi', 'normal')->count();
        $rusak_ringan = Aset::where('kondisi', 'rusak ringan')->count();
        $rusak_berat = Aset::where('kondisi', 'rusak berat')->count();
        $persen_normal = $total > 0 ? round(($normal / $total) * 100, 1) : 0;

        // Perhitungan Intensitas Pengecekan Mingguan (Zona Waktu WITA / Asia/Makassar)
        $nowWita = Carbon::now('Asia/Makassar');
        $todayIndex = $nowWita->dayOfWeekIso - 1; // 0 = Sen, 6 = Min

        $startThisWeek = $nowWita->copy()->startOfWeek(Carbon::MONDAY);
        $endThisWeek   = $nowWita->copy()->endOfWeek(Carbon::SUNDAY);
        $startLastWeek = $startThisWeek->copy()->subWeek();
        $endLastWeek   = $endThisWeek->copy()->subWeek();

        $chartMingguIni  = [0, 0, 0, 0, 0, 0, 0];
        $chartMingguLalu = [0, 0, 0, 0, 0, 0, 0];

        $riwayatDuaMinggu = Pengecekan::where('created_at', '>=', $startLastWeek->copy()->subDay())->get();

        foreach ($riwayatDuaMinggu as $cek) {
            $waktuRaw = $cek->tanggal_cek
                ? Carbon::parse($cek->tanggal_cek, config('app.timezone'))
                : $cek->created_at;

            if (!$waktuRaw) {
                continue;
            }

            $waktuWita = $waktuRaw->copy()->timezone('Asia/Makassar');
            $dayIdx = $waktuWita->dayOfWeekIso - 1;

            if ($waktuWita->between($startThisWeek, $endThisWeek)) {
                $chartMingguIni[$dayIdx]++;
            } elseif ($waktuWita->between($startLastWeek, $endLastWeek)) {
                $chartMingguLalu[$dayIdx]++;
            }
        }

        $totalMingguIni  = array_sum($chartMingguIni);
        $totalMingguLalu = array_sum($chartMingguLalu);

        // Aktivitas terbaru lengkap dengan data aset & ruangan
        $aktivitasTerbaru = Pengecekan::with('aset.ruangan')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'total',
            'normal',
            'rusak_ringan',
            'rusak_berat',
            'persen_normal',
            'chartMingguIni',
            'chartMingguLalu',
            'totalMingguIni',
            'totalMingguLalu',
            'todayIndex',
            'aktivitasTerbaru'
        ));
    })->name('admin.dashboard');

    // Rute Denah Ruangan Admin
    Route::get('/admin/denah', [DenahController::class, 'index'])->name('admin.denah');
    
    // Rute Riwayat & Laporan Admin
    Route::get('/admin/riwayat', [PengecekanController::class, 'index'])->name('admin.riwayat');

    Route::get('/admin/riwayat/export', [\App\Http\Controllers\PengecekanController::class, 'exportExcel'])->name('riwayat.export');
    
    // Rute Standar CRUD Aset (Tabel Master Aset Admin)
    Route::resource('aset', AsetController::class);

    // --- MANAJEMEN PROFIL ADMIN ---
    
    // Rute Profil Khusus Admin (Dinamis Real-time)
    Route::get('/admin/profil', function () {
        $aktivitasHariIni = \App\Models\Pengecekan::with('aset')
                            ->whereDate('created_at', \Carbon\Carbon::today())
                            ->orderBy('created_at', 'desc')
                            ->take(4)
                            ->get();

        return view('admin.profil', compact('aktivitasHariIni'));
    })->name('admin.profil');

    // Halaman dan Proses Edit Profil Admin
    Route::get('/admin/profil/edit', function () {
        return view('admin.profil_edit');
    });

    Route::post('/admin/profil/edit', function (\Illuminate\Http\Request $request) {
        $user = auth()->user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profil'), $filename);
            $user->foto = $filename; 
        }
        $user->save();
        
        return redirect('/admin/profil')->with('success', 'Profil admin berhasil diperbarui!');
    });

    // Halaman dan Proses Edit Password Admin
    Route::get('/admin/profil/password', function () {
        return view('admin.profil_password');
    });

    Route::post('/admin/profil/password', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        
        $user = auth()->user();
        
        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini yang Anda masukkan salah.']);
        }
        
        $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        $user->save();
        
        return redirect('/admin/profil')->with('success', 'Password admin berhasil diperbarui!');
    });


    // ------------------------------------------
    // RUTE PETUGAS & MOBILE UI
    // ------------------------------------------
    Route::get('/beranda', function () {
        return view('petugas.dashboard');
    });

    Route::get('/petugas/dashboard', function () {
        return view('petugas.dashboard'); 
    });

    Route::get('/petugas', function () {
        return redirect('/beranda');
    });

    Route::get('/riwayat', function () {
        return view('petugas.riwayat');
    });

    Route::get('/notifikasi', function () {
        return view('petugas.notifikasi');
    });

    Route::get('/profil', function () {
        return view('petugas.profil');
    });

    Route::get('/profil/edit', function () {
        return view('petugas.profil_edit');
    });

    Route::post('/profil/edit', function (\Illuminate\Http\Request $request) {
        $user = auth()->user();
        $user->name = $request->input('name');
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profil'), $filename);
            $user->foto = $filename; 
        }
        
        $user->save();

        return redirect('/profil')->with('success', 'Profil berhasil diperbarui!');
    });

    Route::get('/profil/panduan', function () {
        return view('petugas.profil_panduan');
    });

    Route::get('/profil/password', function () {
        return view('petugas.profil_password');
    });

    Route::post('/profil/password', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.'
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini yang Anda masukkan salah.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/profil')->with('success', 'Password berhasil diperbarui!');
    });

    // ------------------------------------------
    // RUTE SCANNER & FORM PENGECEKAN
    // ------------------------------------------
    Route::get('/scan', function () {
        return view('petugas.scan.index'); 
    })->name('scan.index');

    Route::get('/aset/check/{kode_qr}', [AsetController::class, 'check'])->name('aset.check');

    Route::post('/scan/simpan/{id}', [AsetController::class, 'updateKondisi'])->name('aset.updateKondisi');

    Route::post('/simpan-pengecekan', [PengecekanController::class, 'store'])->name('pengecekan.store');

    Route::match(['get', 'post'], '/tes-form-scan', function () {
        return view('petugas.scan.check'); 
    });

});