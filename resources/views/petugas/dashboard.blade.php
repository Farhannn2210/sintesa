<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTESA - Dashboard Petugas</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
        }
        ::-webkit-scrollbar { width: 0px; }
        
        @keyframes soft-pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }
        .animate-soft-pulse {
            animation: soft-pulse 2.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body class="antialiased flex justify-center min-h-screen">

    @php
        // 1. Membuat Tanggal Real-time Otomatis
        $hari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
        $bulan = ['January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret', 'April' => 'April', 'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'];
        
        $now = now();
        $tanggalRealTime = $hari[$now->format('l')] . ', ' . $now->format('d') . ' ' . $bulan[$now->format('F')] . ' ' . $now->format('Y');

        // 2. Mengambil Data Riwayat Asli HANYA untuk Hari Ini
        $riwayatHariIni = \App\Models\Pengecekan::with('aset')
            ->whereDate('created_at', \Carbon\Carbon::today())
            ->orderBy('created_at', 'desc')
            ->get();
            
        // 3. Mengambil Data User, Foto, & Membuat Inisial Dinamis
        $userDashboard = auth()->user();
        $namaDashboard = $userDashboard->name ?? 'Tim IT';
        $fotoDashboard = $userDashboard->foto ?? null; // Mengambil foto dari DB
        
        $wordsDashboard = explode(" ", $namaDashboard);
        $inisialDashboard = "";
        if (count($wordsDashboard) >= 2) {
            $inisialDashboard = strtoupper(substr($wordsDashboard[0], 0, 1) . substr($wordsDashboard[1], 0, 1));
        } else {
            $inisialDashboard = strtoupper(substr($namaDashboard, 0, 2));
        }
    @endphp

    <div class="w-full max-w-md bg-[#F8FAFC] min-h-screen relative overflow-x-hidden pb-28 shadow-2xl">
        
        <div class="bg-gradient-to-br from-[#00385d] via-[#005891] to-[#0075c2] rounded-b-[40px] px-6 pt-12 pb-20 shadow-[0_15px_40px_-15px_rgba(0,117,194,0.6)] relative z-0 overflow-hidden">
            <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full blur-2xl -mt-10 -mr-10"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-blue-400/20 rounded-full blur-xl -mb-10 -ml-10"></div>

            <div class="flex justify-between items-center mb-7 relative z-10">
                <div>
                    <p class="text-[11px] text-blue-100/80 font-semibold tracking-wider uppercase mb-1">Selamat bekerja,</p>
                    <h2 class="text-2xl font-extrabold text-white tracking-tight">{{ $namaDashboard }} 👋</h2>
                </div>
                
                <!-- Avatar Profil Dinamis (Foto atau Inisial) -->
                <a href="/profil" class="w-12 h-12 bg-gradient-to-tr from-[#F28F20] to-[#f5a74e] rounded-2xl flex items-center justify-center border border-white/20 shadow-[0_4px_15px_rgba(242,143,32,0.4)] text-white font-extrabold text-lg transform rotate-3 active:scale-95 transition-transform cursor-pointer overflow-hidden">
                    @if($fotoDashboard)
                        <img src="{{ asset('uploads/profil/' . $fotoDashboard) }}" alt="Foto" class="w-full h-full object-cover transform -rotate-3">
                    @else
                        {{ $inisialDashboard }}
                    @endif
                </a>
            </div>
            
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-4 border border-white/20 flex items-center justify-between relative z-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                <div class="flex items-center gap-3.5">
                    <div class="bg-white/20 w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-inner">
                        <i class="fa-solid fa-calendar-day text-lg"></i>
                    </div>
                    <div>
                        <p class="text-[9px] text-blue-100/90 font-extrabold uppercase tracking-[0.15em] mb-1">{{ $tanggalRealTime }}</p>
                        <p class="text-[13px] font-bold text-white">Siap cek aset hari ini?</p>
                    </div>
                </div>
                <div class="flex items-center justify-center w-6 h-6 rounded-full bg-white/10">
                    <div class="w-2.5 h-2.5 bg-emerald-400 rounded-full shadow-[0_0_12px_rgba(52,211,153,0.9)] animate-pulse"></div>
                </div>
            </div>
        </div>

        <!-- Sisa kode dashboard (Scan, Menu Bantuan, Ilustrasi, Riwayat, Menu Bawah) tetap sama persis -->
        
        <div class="px-6 -mt-14 flex justify-center relative z-20">
            <div class="relative group">
                <div class="absolute inset-0 bg-[#F28F20] rounded-full blur-xl opacity-40 group-hover:opacity-60 transition-opacity animate-soft-pulse"></div>
                <a href="{{ route('scan.index') }}" class="relative flex flex-col items-center justify-center w-[110px] h-[110px] bg-white rounded-full shadow-[0_10px_35px_-5px_rgba(242,143,32,0.3)] border-[5px] border-[#F8FAFC] transition-all duration-300 active:scale-95 group-hover:-translate-y-1">
                    <div class="text-[#F28F20] mb-1 transition-transform duration-300 group-hover:scale-110">
                        <i class="fa-solid fa-qrcode text-[38px]"></i>
                    </div>
                    <span class="text-[9px] font-extrabold text-slate-800 tracking-[0.15em] uppercase mt-1">Scan Aset</span>
                </a>
            </div>
        </div>

        <div class="px-6 mt-8">
            <div class="grid grid-cols-2 gap-4">
                <a href="/riwayat" class="bg-white p-4 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.03)] flex items-center gap-3.5 hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] active:scale-95 transition-all border border-slate-100/80">
                    <div class="bg-blue-50/80 w-11 h-11 rounded-2xl flex items-center justify-center text-blue-600">
                        <i class="fa-solid fa-clipboard-list text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-[13px] font-extrabold text-slate-800">Riwayat</h3>
                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">Semua Laporan</p>
                    </div>
                </a>
                <a href="/notifikasi" class="bg-white p-4 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.03)] flex items-center gap-3.5 hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] active:scale-95 transition-all border border-slate-100/80">
                    <div class="bg-orange-50/80 w-11 h-11 rounded-2xl flex items-center justify-center text-[#F28F20]">
                        <i class="fa-solid fa-bullhorn text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-[13px] font-extrabold text-slate-800">Lapor</h3>
                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">Ada Kendala?</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="px-6 mt-5">
            <div class="bg-gradient-to-r from-blue-50 to-white rounded-3xl p-5 shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-blue-100/50 flex items-center gap-4 relative overflow-hidden">
                <div class="absolute -right-2 -bottom-4 opacity-5">
                    <i class="fa-solid fa-mobile-screen-button text-[80px]"></i>
                </div>
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#005891] shrink-0 shadow-sm border border-blue-50 relative z-10">
                    <i class="fa-solid fa-mobile-screen-button text-xl"></i>
                </div>
                <div class="relative z-10">
                    <h3 class="text-xs font-extrabold text-slate-800 mb-1">Cara Penggunaan</h3>
                    <p class="text-[10px] text-slate-500 leading-relaxed font-medium">Tekan tombol bulat <strong class="text-[#F28F20] font-extrabold">SCAN ASET</strong>, arahkan kamera ke stiker BMN BPS.</p>
                </div>
            </div>
        </div>

        <div class="px-6 mt-8 mb-6">
            <div class="flex items-center justify-between mb-4 px-1">
                <h3 class="text-[13px] font-extrabold text-slate-800 tracking-tight">Pengecekan Hari Ini</h3>
                <span class="bg-slate-200/60 text-slate-500 text-[9px] font-extrabold px-2.5 py-1 rounded-full">{{ $riwayatHariIni->count() }} Aset</span>
            </div>
            
            <div class="space-y-3">
                @forelse($riwayatHariIni as $riwayat)
                    <div class="bg-white p-4 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 flex items-center gap-3.5 hover:shadow-[0_8px_30px_rgb(0,0,0,0.05)] transition-shadow">
                        @if(strtolower($riwayat->status) == 'normal')
                            <div class="bg-emerald-50 w-11 h-11 rounded-2xl flex items-center justify-center text-emerald-500 shrink-0">
                                <i class="fa-solid fa-check text-lg"></i>
                            </div>
                        @elseif(strtolower($riwayat->status) == 'rusak ringan')
                            <div class="bg-orange-50 w-11 h-11 rounded-2xl flex items-center justify-center text-[#F28F20] shrink-0">
                                <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                            </div>
                        @else
                            <div class="bg-red-50 w-11 h-11 rounded-2xl flex items-center justify-center text-red-500 shrink-0">
                                <i class="fa-solid fa-xmark text-lg"></i>
                            </div>
                        @endif
                        
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-extrabold text-slate-800 truncate mb-0.5">{{ $riwayat->aset->nama_perangkat ?? 'Aset Dihapus' }}</h4>
                            <div class="flex items-center gap-1.5 text-[10px] text-slate-400 font-medium">
                                <i class="fa-solid fa-location-dot text-[9px]"></i>
                                <span class="truncate">{{ $riwayat->aset->lokasi_ruangan ?? '-' }}</span>
                            </div>
                        </div>
                        
                        <div class="text-right shrink-0 flex flex-col items-end gap-1.5">
                            <span class="text-[9px] font-bold text-slate-400">{{ $riwayat->created_at->format('H:i') }}</span>
                            <span class="inline-flex px-2.5 py-1 rounded-lg text-[8px] font-extrabold uppercase tracking-wider
                                {{ strtolower($riwayat->status) == 'normal' ? 'bg-emerald-500/10 text-emerald-600' : (strtolower($riwayat->status) == 'rusak ringan' ? 'bg-[#F28F20]/10 text-[#e07d17]' : 'bg-red-500/10 text-red-600') }}">
                                {{ $riwayat->status }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="bg-white/60 rounded-3xl p-8 border-2 border-slate-200/60 border-dashed text-center">
                        <div class="w-14 h-14 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-300">
                            <i class="fa-solid fa-box-open text-xl"></i>
                        </div>
                        <h4 class="text-xs font-extrabold text-slate-700 mb-1">Belum ada aset dicek</h4>
                        <p class="text-[10px] text-slate-500 font-medium">Data pengecekan hari ini akan muncul di sini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="fixed bottom-0 w-full max-w-md bg-white border-t border-slate-100 flex justify-around py-3 pb-6 rounded-t-3xl shadow-[0_-10px_40px_rgba(0,0,0,0.04)] z-50">
            <a href="/beranda" class="flex flex-col items-center gap-1.5 {{ request()->is('beranda') || request()->is('petugas/dashboard') ? 'text-[#005891]' : 'text-slate-300 hover:text-slate-500' }} transition-colors">
                <i class="fa-solid fa-house text-[20px]"></i>
                <span class="text-[9px] {{ request()->is('beranda') || request()->is('petugas/dashboard') ? 'font-extrabold' : 'font-bold' }}">Home</span>
            </a>
            <a href="/riwayat" class="flex flex-col items-center gap-1.5 {{ request()->is('riwayat') ? 'text-[#005891]' : 'text-slate-300 hover:text-slate-500' }} transition-colors">
                <i class="fa-solid fa-clock-rotate-left text-[20px]"></i>
                <span class="text-[9px] {{ request()->is('riwayat') ? 'font-extrabold' : 'font-bold' }}">Riwayat</span>
            </a>
            <a href="/notifikasi" class="flex flex-col items-center gap-1.5 {{ request()->is('notifikasi') ? 'text-[#005891]' : 'text-slate-300 hover:text-slate-500' }} transition-colors relative">
                <i class="fa-solid fa-bell text-[20px]"></i>
                <span class="w-2.5 h-2.5 bg-orange-500 rounded-full absolute top-0 right-1 border-2 border-white"></span>
                <span class="text-[9px] {{ request()->is('notifikasi') ? 'font-extrabold' : 'font-bold' }}">Notifikasi</span>
            </a>
            <a href="/profil" class="flex flex-col items-center gap-1.5 {{ request()->is('profil') ? 'text-[#005891]' : 'text-slate-300 hover:text-slate-500' }} transition-colors">
                <i class="fa-solid fa-user text-[20px]"></i>
                <span class="text-[9px] {{ request()->is('profil') ? 'font-extrabold' : 'font-bold' }}">Profil</span>
            </a>
        </div>

    </div>
</body>
</html>