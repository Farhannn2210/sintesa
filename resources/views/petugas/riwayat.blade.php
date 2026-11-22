<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTESA - Riwayat Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f1f5f9; }
        ::-webkit-scrollbar { width: 0px; }
    </style>
</head>
<body class="antialiased flex justify-center min-h-screen">

    @php
        // 1. Tangkap request filter dari URL
        $statusFilter = request('status', 'semua');
        $waktuFilter = request('waktu', 'semua');

        // 2. Siapkan pondasi query ke database
        $query = \App\Models\Pengecekan::with('aset')->orderBy('created_at', 'desc');

        // 3. Logika Filter Status
        if ($statusFilter == 'normal') {
            $query->where('status', 'normal');
        } elseif ($statusFilter == 'warning') {
            $query->where('status', 'rusak ringan');
        } elseif ($statusFilter == 'rusak') {
            $query->where('status', 'rusak berat');
        }

        // 4. Logika Filter Waktu
        if ($waktuFilter == 'hari_ini') {
            $query->whereDate('created_at', \Carbon\Carbon::today());
        } elseif ($waktuFilter == 'minggu_ini') {
            $query->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()]);
        } elseif ($waktuFilter == 'bulan_ini') {
            $query->whereMonth('created_at', \Carbon\Carbon::now()->month)
                  ->whereYear('created_at', \Carbon\Carbon::now()->year);
        }

        // 5. Eksekusi pencarian data
        $riwayatSemua = $query->get();
    @endphp

    <div class="w-full max-w-md bg-[#F8FAFC] min-h-screen relative overflow-x-hidden pb-28 shadow-2xl">
        
        <!-- HEADER -->
        <div class="bg-[#005891] rounded-b-[40px] px-6 pt-10 pb-20 relative z-0">
            <div class="flex justify-between items-center mb-6 text-white">
                <a href="/beranda" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center active:scale-95 transition-transform">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h1 class="text-xs font-extrabold tracking-widest uppercase">SINTESA</h1>
                <!-- Tombol Filter Lanjutan (Menjalankan fungsi openFilter) -->
                <button onclick="openFilter()" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center active:scale-95 transition-transform cursor-pointer relative">
                    <i class="fa-solid fa-sliders"></i>
                    <!-- Titik oranye penanda jika filter waktu aktif -->
                    @if($waktuFilter != 'semua')
                        <span class="w-2.5 h-2.5 bg-[#F28F20] rounded-full absolute top-0 right-0 border-2 border-[#005891]"></span>
                    @endif
                </button>
            </div>
            
            <div class="text-center mb-6">
                <h2 class="text-2xl font-extrabold text-white mb-1">Riwayat Pengecekan</h2>
                <p class="text-[11px] text-blue-100">Semua aktivitas pengecekan aset Anda</p>
            </div>

            <!-- TABS FILTER DINAMIS (Mempertahankan parameter waktu) -->
            <div class="flex justify-between gap-2">
                <a href="?status=semua&waktu={{ $waktuFilter }}" class="flex-1 text-center py-2 rounded-full text-[11px] transition-all {{ $statusFilter == 'semua' ? 'bg-white text-[#005891] font-extrabold shadow-md' : 'border border-white/40 text-white font-semibold hover:bg-white/10' }}">
                    Semua
                </a>
                <a href="?status=normal&waktu={{ $waktuFilter }}" class="flex-1 text-center py-2 rounded-full text-[11px] transition-all {{ $statusFilter == 'normal' ? 'bg-white text-[#005891] font-extrabold shadow-md' : 'border border-white/40 text-white font-semibold hover:bg-white/10' }}">
                    Normal
                </a>
                <a href="?status=warning&waktu={{ $waktuFilter }}" class="flex-1 text-center py-2 rounded-full text-[11px] transition-all {{ $statusFilter == 'warning' ? 'bg-white text-[#005891] font-extrabold shadow-md' : 'border border-white/40 text-white font-semibold hover:bg-white/10' }}">
                    Warning
                </a>
                <a href="?status=rusak&waktu={{ $waktuFilter }}" class="flex-1 text-center py-2 rounded-full text-[11px] transition-all {{ $statusFilter == 'rusak' ? 'bg-white text-[#005891] font-extrabold shadow-md' : 'border border-white/40 text-white font-semibold hover:bg-white/10' }}">
                    Rusak
                </a>
            </div>
        </div>

        <!-- LIST RIWAYAT KESELURUHAN -->
        <div class="px-6 -mt-10 relative z-10 space-y-3 mb-6">
            @forelse($riwayatSemua as $riwayat)
                <div class="bg-white p-4 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.03)] border border-slate-100 flex items-center gap-3.5 hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] transition-all">
                    
                    @if(strtolower($riwayat->status) == 'normal')
                        <div class="bg-emerald-50 w-12 h-12 rounded-2xl flex items-center justify-center text-emerald-500 shrink-0">
                            <i class="fa-solid fa-server text-xl"></i>
                        </div>
                    @elseif(strtolower($riwayat->status) == 'rusak ringan')
                        <div class="bg-orange-50 w-12 h-12 rounded-2xl flex items-center justify-center text-[#F28F20] shrink-0">
                            <i class="fa-solid fa-car-battery text-xl"></i>
                        </div>
                    @else
                        <div class="bg-red-50 w-12 h-12 rounded-2xl flex items-center justify-center text-red-500 shrink-0">
                            <i class="fa-solid fa-plug-circle-xmark text-xl"></i>
                        </div>
                    @endif
                    
                    <div class="flex-1 min-w-0">
                        <h4 class="text-[13px] font-extrabold text-slate-800 truncate mb-0.5">{{ $riwayat->aset->nama_perangkat ?? 'Aset Dihapus' }}</h4>
                        <p class="text-[10px] text-slate-400 font-semibold truncate">ID: {{ $riwayat->aset->kode_aset ?? '-' }}</p>
                    </div>
                    
                    <div class="text-right shrink-0 flex flex-col items-end gap-1.5">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[9px] font-extrabold uppercase
                            {{ strtolower($riwayat->status) == 'normal' ? 'bg-emerald-50 text-emerald-600' : (strtolower($riwayat->status) == 'rusak ringan' ? 'bg-orange-50 text-[#e07d17]' : 'bg-red-50 text-red-600') }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ strtolower($riwayat->status) == 'normal' ? 'bg-emerald-500' : (strtolower($riwayat->status) == 'rusak ringan' ? 'bg-[#F28F20]' : 'bg-red-500') }}"></span>
                            {{ $riwayat->status }}
                        </span>
                        <div class="flex flex-col items-end">
                            <span class="text-[10px] font-bold text-slate-500">{{ $riwayat->created_at->format('H:i') }}</span>
                            <span class="text-[8px] font-semibold text-slate-400">{{ $riwayat->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl p-8 border border-slate-100 text-center shadow-sm mt-10">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                        <i class="fa-solid fa-filter-circle-xmark text-2xl"></i>
                    </div>
                    <h4 class="text-sm font-extrabold text-slate-700 mb-1">Tidak Ada Data</h4>
                    <p class="text-[11px] text-slate-500 font-medium">Belum ada riwayat pengecekan untuk kombinasi filter ini.</p>
                </div>
            @endforelse

            @if($riwayatSemua->count() > 0)
                <p class="text-center text-[10px] font-bold text-slate-400 pt-4 pb-2">Semua riwayat telah ditampilkan</p>
            @endif
        </div>

        <!-- SMART BOTTOM NAVIGATION MENU -->
        <div class="fixed bottom-0 w-full max-w-md bg-white border-t border-slate-100 flex justify-around py-3 pb-6 rounded-t-3xl shadow-[0_-10px_40px_rgba(0,0,0,0.04)] z-40">
            <a href="/beranda" class="flex flex-col items-center gap-1.5 text-slate-300 hover:text-slate-500 transition-colors">
                <i class="fa-solid fa-house text-[20px]"></i>
                <span class="text-[9px] font-bold">Home</span>
            </a>
            <a href="/riwayat" class="flex flex-col items-center gap-1.5 text-[#005891] transition-colors">
                <i class="fa-solid fa-clock-rotate-left text-[20px]"></i>
                <span class="text-[9px] font-extrabold">Riwayat</span>
            </a>
            <a href="/notifikasi" class="flex flex-col items-center gap-1.5 text-slate-300 hover:text-slate-500 transition-colors relative">
                <i class="fa-solid fa-bell text-[20px]"></i>
                <span class="w-2.5 h-2.5 bg-orange-500 rounded-full absolute top-0 right-1 border-2 border-white"></span>
                <span class="text-[9px] font-bold">Notifikasi</span>
            </a>
            <a href="/profil" class="flex flex-col items-center gap-1.5 text-slate-300 hover:text-slate-500 transition-colors">
                <i class="fa-solid fa-user text-[20px]"></i>
                <span class="text-[9px] font-bold">Profil</span>
            </a>
        </div>
        
    </div>

    <!-- MODAL FILTER LANJUTAN (Bottom Sheet) -->
    <div id="filterModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[100] hidden items-end justify-center transition-opacity opacity-0">
        <!-- Area kosong untuk klik close -->
        <div class="absolute inset-0" onclick="closeFilter()"></div>
        
        <!-- Konten Modal -->
        <div id="filterContent" class="bg-white w-full max-w-md rounded-t-[30px] p-6 pb-10 transform translate-y-full transition-transform duration-300 relative z-10 shadow-[0_-15px_40px_rgba(0,0,0,0.1)]">
            <div class="w-12 h-1.5 bg-slate-200 rounded-full mx-auto mb-6"></div>
            
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-[15px] font-extrabold text-slate-800">Filter Lanjutan</h3>
                <button onclick="closeFilter()" class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center text-slate-500 active:scale-95">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="" method="GET">
                <!-- Mempertahankan filter status yang sedang aktif -->
                <input type="hidden" name="status" value="{{ $statusFilter }}">

                <div class="mb-8">
                    <label class="text-[11px] font-extrabold text-slate-500 mb-3 block uppercase tracking-wider">Berdasarkan Waktu</label>
                    <div class="grid grid-cols-2 gap-3">
                        
                        <label class="cursor-pointer">
                            <input type="radio" name="waktu" value="semua" class="peer hidden" {{ $waktuFilter == 'semua' ? 'checked' : '' }}>
                            <div class="text-center py-2.5 rounded-xl text-[11px] font-bold border-2 border-slate-100 text-slate-500 peer-checked:bg-blue-50 peer-checked:text-[#005891] peer-checked:border-[#005891] active:scale-95 transition-all">
                                <i class="fa-regular fa-calendar mr-1"></i> Semua Waktu
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="waktu" value="hari_ini" class="peer hidden" {{ $waktuFilter == 'hari_ini' ? 'checked' : '' }}>
                            <div class="text-center py-2.5 rounded-xl text-[11px] font-bold border-2 border-slate-100 text-slate-500 peer-checked:bg-blue-50 peer-checked:text-[#005891] peer-checked:border-[#005891] active:scale-95 transition-all">
                                <i class="fa-solid fa-calendar-day mr-1"></i> Hari Ini
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="waktu" value="minggu_ini" class="peer hidden" {{ $waktuFilter == 'minggu_ini' ? 'checked' : '' }}>
                            <div class="text-center py-2.5 rounded-xl text-[11px] font-bold border-2 border-slate-100 text-slate-500 peer-checked:bg-blue-50 peer-checked:text-[#005891] peer-checked:border-[#005891] active:scale-95 transition-all">
                                <i class="fa-solid fa-calendar-week mr-1"></i> Minggu Ini
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="waktu" value="bulan_ini" class="peer hidden" {{ $waktuFilter == 'bulan_ini' ? 'checked' : '' }}>
                            <div class="text-center py-2.5 rounded-xl text-[11px] font-bold border-2 border-slate-100 text-slate-500 peer-checked:bg-blue-50 peer-checked:text-[#005891] peer-checked:border-[#005891] active:scale-95 transition-all">
                                <i class="fa-regular fa-calendar-days mr-1"></i> Bulan Ini
                            </div>
                        </label>

                    </div>
                </div>

                <button type="submit" class="w-full bg-[#F28F20] text-white font-extrabold py-3.5 rounded-2xl shadow-[0_8px_20px_rgba(242,143,32,0.3)] active:scale-95 transition-transform flex items-center justify-center gap-2">
                    Terapkan Filter <i class="fa-solid fa-check"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Script untuk membuka/menutup modal -->
    <script>
        function openFilter() {
            const modal = document.getElementById('filterModal');
            const content = document.getElementById('filterContent');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Sedikit delay agar animasi transisi terlihat halus
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('translate-y-full');
            }, 10);
        }

        function closeFilter() {
            const modal = document.getElementById('filterModal');
            const content = document.getElementById('filterContent');
            
            modal.classList.add('opacity-0');
            content.classList.add('translate-y-full');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300); // Menunggu durasi animasi selesai
        }
    </script>
</body>
</html>