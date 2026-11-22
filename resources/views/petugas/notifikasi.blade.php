<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTESA - Notifikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        ::-webkit-scrollbar { width: 0px; }
    </style>
</head>
<body class="antialiased flex justify-center min-h-screen">

    @php
        // Mengambil data pengecekan yang bermasalah saja
        $notifikasiBermasalah = \App\Models\Pengecekan::with('aset')
            ->whereIn('status', ['rusak ringan', 'rusak berat'])
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get();
            
        $jumlahNotif = $notifikasiBermasalah->count();
    @endphp

    <div class="w-full max-w-md bg-[#F8FAFC] min-h-screen relative overflow-x-hidden pb-28 shadow-2xl">
        
        <!-- HEADER LENGKUNG (Sesuai Desain Asli) -->
        <div class="bg-[#005891] rounded-b-[40px] px-6 pt-10 pb-16 relative z-0 text-center">
            <div class="flex justify-between items-center mb-5 text-white">
                <a href="/beranda" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center active:scale-95 transition-transform">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h1 class="text-xs font-extrabold tracking-widest uppercase">NOTIFIKASI</h1>
                <div class="w-10 h-10 opacity-0"></div> <!-- Spacer -->
            </div>
            
            <div class="inline-flex items-center gap-2 bg-white/10 px-5 py-1.5 rounded-full border border-white/20 shadow-inner">
                <span class="w-2.5 h-2.5 rounded-full {{ $jumlahNotif > 0 ? 'bg-[#F28F20] animate-pulse' : 'bg-emerald-400' }}"></span>
                <span class="text-[11px] font-bold text-white">{{ $jumlahNotif }} Pesan Penting</span>
            </div>
        </div>

        <!-- DAFTAR NOTIFIKASI -->
        <div class="px-6 -mt-8 relative z-10 space-y-4 mb-6">
            @forelse($notifikasiBermasalah as $notif)
                <div class="bg-white p-5 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.03)] border {{ strtolower($notif->status) == 'rusak berat' ? 'border-red-100' : 'border-orange-100' }} flex gap-4 transition-all">
                    
                    <!-- Ikon tanpa kotak solid (Sesuai Desain) -->
                    @if(strtolower($notif->status) == 'rusak berat')
                        <div class="bg-red-50 w-12 h-12 rounded-[18px] flex items-center justify-center text-red-500 shrink-0">
                            <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                        </div>
                    @else
                        <div class="bg-[#fff4e5] w-12 h-12 rounded-[18px] flex items-center justify-center text-[#F28F20] shrink-0">
                            <i class="fa-solid fa-bell text-xl"></i>
                        </div>
                    @endif
                    
                    <div class="flex-1 min-w-0 pt-0.5">
                        <div class="flex justify-between items-start mb-1.5">
                            <h4 class="text-[13px] font-extrabold {{ strtolower($notif->status) == 'rusak berat' ? 'text-red-600' : 'text-[#e07d17]' }} truncate">
                                {{ strtolower($notif->status) == 'rusak berat' ? 'Kondisi Kritis!' : 'Perlu Perhatian' }}
                            </h4>
                            <span class="text-[9px] font-bold text-slate-400 shrink-0">{{ $notif->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-[11px] text-slate-500 leading-relaxed">
                            Aset <strong class="text-slate-700">{{ $notif->aset->nama_perangkat ?? 'Tidak Diketahui' }}</strong> di <strong class="text-slate-700">{{ $notif->aset->lokasi_ruangan ?? 'Lokasi Tidak Diketahui' }}</strong> terdeteksi <strong class="{{ strtolower($notif->status) == 'rusak berat' ? 'text-red-500' : 'text-[#005891]' }}">{{ $notif->status }}</strong>.
                        </p>
                    </div>
                </div>
            @empty
                <!-- Kosong -->
            @endforelse
        </div>

        <!-- MENU BAWAH -->
        <div class="fixed bottom-0 w-full max-w-md bg-white border-t border-slate-100 flex justify-around py-3 pb-6 rounded-t-3xl shadow-[0_-10px_40px_rgba(0,0,0,0.04)] z-50">
            <!-- (Isi menu bawah sama seperti sebelumnya) -->
            <a href="/beranda" class="flex flex-col items-center gap-1.5 text-slate-300 transition-colors"><i class="fa-solid fa-house text-[20px]"></i><span class="text-[9px] font-bold">Home</span></a>
            <a href="/riwayat" class="flex flex-col items-center gap-1.5 text-slate-300 transition-colors"><i class="fa-solid fa-clock-rotate-left text-[20px]"></i><span class="text-[9px] font-bold">Riwayat</span></a>
            <a href="/notifikasi" class="flex flex-col items-center gap-1.5 text-[#005891] transition-colors"><i class="fa-solid fa-bell text-[20px]"></i><span class="text-[9px] font-extrabold">Notifikasi</span></a>
            <a href="/profil" class="flex flex-col items-center gap-1.5 text-slate-300 transition-colors"><i class="fa-solid fa-user text-[20px]"></i><span class="text-[9px] font-bold">Profil</span></a>
        </div>
    </div>
</body>
</html>