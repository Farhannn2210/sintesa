<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTESA - Profil Petugas</title>
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
        // Ambil data User dan Foto dari database
        $user = auth()->user();
        $namaLengkap = $user->name ?? 'Admin IPDS';
        $fotoProfil = $user->foto ?? null;
        
        $words = explode(" ", $namaLengkap);
        $inisial = "";
        if (count($words) >= 2) {
            $inisial = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        } else {
            $inisial = strtoupper(substr($namaLengkap, 0, 2));
        }
        
        $totalDicek = \App\Models\Pengecekan::count();
        $totalAset = \App\Models\Aset::count();
    @endphp

    <div class="w-full max-w-md bg-[#F8FAFC] min-h-screen relative overflow-x-hidden pb-28 shadow-2xl">
        
        <!-- HEADER PROFIL FINAL (Proporsional & Pas) -->
        <div class="bg-gradient-to-b from-[#004b7c] to-[#005891] rounded-b-[40px] px-6 pt-10 pb-12 relative z-0 flex flex-col items-center">
            
            <!-- Navigasi Atas -->
            <div class="flex justify-between items-center w-full mb-6 text-white">
                <a href="/beranda" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center active:scale-95 transition-all backdrop-blur-sm">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h1 class="text-[11px] font-extrabold tracking-widest uppercase">PROFIL SAYA</h1>
                <div class="w-10 h-10 opacity-0"></div> <!-- Spacer -->
            </div>

            <!-- Avatar -->
            <div class="w-24 h-24 bg-[#F28F20] rounded-full flex items-center justify-center border-4 border-white shadow-[0_10px_25px_rgba(0,0,0,0.2)] text-white font-extrabold text-3xl mb-4 overflow-hidden relative">
                @if($fotoProfil)
                    <img src="{{ asset('uploads/profil/' . $fotoProfil) }}" alt="Foto" class="w-full h-full object-cover">
                @else
                    {{ $inisial }}
                @endif
            </div>
            
            <!-- Nama & Role -->
            <h2 class="text-xl font-extrabold text-white text-center tracking-tight">{{ $namaLengkap }}</h2>
            <span class="inline-block bg-white/20 border border-white/30 backdrop-blur-md text-white text-[9px] font-extrabold px-4 py-1.5 rounded-full mt-2 uppercase tracking-widest shadow-sm">
                PETUGAS LAPANGAN
            </span>
        </div>

        <!-- KARTU STATISTIK MELAYANG -->
        <div class="px-6 -mt-8 relative z-10 mb-6">
            <div class="bg-white rounded-3xl p-5 shadow-[0_15px_35px_-10px_rgba(0,0,0,0.08)] border border-slate-50 flex w-full justify-around text-center items-center">
                <div class="flex-1">
                    <p class="text-2xl font-extrabold text-[#005891]">{{ $totalDicek }}</p>
                    <p class="text-[9px] font-extrabold text-slate-400 uppercase tracking-widest mt-1">Aset Dicek</p>
                </div>
                <div class="w-px bg-slate-100 h-10"></div>
                <div class="flex-1">
                    <p class="text-2xl font-extrabold text-[#F28F20]">{{ $totalAset }}</p>
                    <p class="text-[9px] font-extrabold text-slate-400 uppercase tracking-widest mt-1">Total Aset</p>
                </div>
            </div>
        </div>

        <!-- MENU PENGATURAN BAWAH -->
        <div class="px-6 space-y-3 mb-8">
            <a href="/profil/edit" class="bg-white p-4 rounded-2xl border border-slate-100 flex items-center justify-between active:scale-95 transition-all shadow-[0_4px_20px_rgb(0,0,0,0.02)] hover:border-blue-100">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-[#005891] bg-blue-50">
                        <i class="fa-solid fa-user-pen text-[15px]"></i>
                    </div>
                    <span class="text-[13px] font-extrabold text-slate-800">Edit Profil</span>
                </div>
                <i class="fa-solid fa-chevron-right text-slate-300 text-sm"></i>
            </a>

            <a href="/profil/panduan" class="bg-white p-4 rounded-2xl border border-slate-100 flex items-center justify-between active:scale-95 transition-all shadow-[0_4px_20px_rgb(0,0,0,0.02)] hover:border-orange-100">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-[#F28F20] bg-orange-50">
                        <i class="fa-solid fa-book text-[15px]"></i>
                    </div>
                    <span class="text-[13px] font-extrabold text-slate-800">Panduan Aplikasi</span>
                </div>
                <i class="fa-solid fa-chevron-right text-slate-300 text-sm"></i>
            </a>

            <a href="/profil/password" class="bg-white p-4 rounded-2xl border border-slate-100 flex items-center justify-between active:scale-95 transition-all shadow-[0_4px_20px_rgb(0,0,0,0.02)] hover:border-slate-200">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-slate-500 bg-slate-100">
                        <i class="fa-solid fa-lock text-[15px]"></i>
                    </div>
                    <span class="text-[13px] font-extrabold text-slate-800">Ubah Password</span>
                </div>
                <i class="fa-solid fa-chevron-right text-slate-300 text-sm"></i>
            </a>
            
            <form method="POST" action="{{ route('logout') }}" class="block w-full pt-3">
                @csrf
                <button type="submit" class="w-full bg-red-50 p-4 rounded-2xl border border-red-200 flex items-center justify-center gap-2 active:scale-95 transition-transform hover:bg-red-100 shadow-[0_4px_20px_rgb(0,0,0,0.02)]">
                    <i class="fa-solid fa-arrow-right-from-bracket text-red-500 text-[15px]"></i>
                    <span class="text-[13px] font-extrabold text-red-600">Keluar dari Akun</span>
                </button>
            </form>
        </div>

        <!-- MENU BAWAH (KONSISTEN) -->
        <div class="fixed bottom-0 w-full max-w-md bg-white border-t border-slate-100 flex justify-around py-3 pb-6 rounded-t-3xl shadow-[0_-10px_40px_rgba(0,0,0,0.04)] z-50">
            <a href="/beranda" class="flex flex-col items-center gap-1.5 text-slate-300 transition-colors"><i class="fa-solid fa-house text-[20px]"></i><span class="text-[9px] font-bold">Home</span></a>
            <a href="/riwayat" class="flex flex-col items-center gap-1.5 text-slate-300 transition-colors"><i class="fa-solid fa-clock-rotate-left text-[20px]"></i><span class="text-[9px] font-bold">Riwayat</span></a>
            <a href="/notifikasi" class="flex flex-col items-center gap-1.5 text-slate-300 transition-colors"><i class="fa-solid fa-bell text-[20px]"></i><span class="text-[9px] font-bold">Notifikasi</span></a>
            <a href="/profil" class="flex flex-col items-center gap-1.5 text-[#005891] transition-colors"><i class="fa-solid fa-user text-[20px]"></i><span class="text-[9px] font-extrabold">Profil</span></a>
        </div>
    </div>
</body>
</html>