<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTESA Admin - Profil</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    body { font-family: "Plus Jakarta Sans", sans-serif; }
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: #f1f5f9; }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#F1F5F9] text-slate-800 flex h-screen overflow-hidden antialiased">

    <!-- SIDEBAR KIRI -->
    <aside class="flex w-64 shrink-0 flex-col bg-[#004b7c] text-white shadow-2xl z-20">
        <a href="/admin/dashboard" class="flex items-center gap-3 px-6 pb-6 pt-8 border-b border-white/10">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#F28F20] shadow-[0_6px_20px_rgba(242,143,32,0.3)]">
                <i class="fa-solid fa-boxes-stacked text-white text-lg"></i>
            </span>
            <div>
                <span class="block text-xl font-extrabold tracking-wide">SINTESA</span>
                <span class="block text-[10px] font-medium text-blue-200/70">BPS Prov. Sulteng</span>
            </div>
        </a>

        <p class="mb-3 mt-6 px-7 text-[10px] font-bold uppercase tracking-[0.18em] text-blue-200/50">Menu Utama</p>

        <nav class="space-y-1.5 pr-4">
            <a href="/admin/dashboard" class="border-l-4 border-transparent text-blue-100/75 hover:bg-white/5 hover:text-white font-medium flex items-center gap-3 rounded-r-xl py-3.5 pl-5 pr-4 text-sm transition-all">
                <i class="fa-solid fa-chart-pie w-5 text-center opacity-75"></i> Dashboard
            </a>
            <a href="{{ route('aset.index') }}" class="border-l-4 border-transparent text-blue-100/75 hover:bg-white/5 hover:text-white font-medium flex items-center gap-3 rounded-r-xl py-3.5 pl-5 pr-4 text-sm transition-all">
                <i class="fa-solid fa-desktop w-5 text-center opacity-75"></i> Master Aset
            </a>
            <a href="{{ route('admin.denah') }}" class="border-l-4 border-transparent text-blue-100/75 hover:bg-white/5 hover:text-white font-medium flex items-center gap-3 rounded-r-xl py-3.5 pl-5 pr-4 text-sm transition-all">
                <i class="fa-solid fa-map-location-dot w-5 text-center opacity-75"></i> Denah Ruangan
            </a>
            <a href="{{ route('admin.riwayat') }}" class="border-l-4 border-transparent text-blue-100/75 hover:bg-white/5 hover:text-white font-medium flex items-center gap-3 rounded-r-xl py-3.5 pl-5 pr-4 text-sm transition-all">
                <i class="fa-solid fa-file-invoice w-5 text-center opacity-75"></i> Riwayat & Laporan
            </a>
        </nav>

        <div class="mt-auto p-5 relative border-t border-white/10 bg-white/5">
            <div class="w-full flex items-center justify-between pt-2">
                <div class="flex items-center gap-3 min-w-0">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#F28F20] text-sm font-extrabold text-white overflow-hidden border-2 border-[#004b7c]">
                        @if(auth()->user()->foto)
                            <img src="{{ asset('uploads/profil/' . auth()->user()->foto) }}" alt="Foto" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
                        @endif
                    </span>
                    <span class="min-w-0 flex-1">
                        <span class="block truncate text-xs font-bold text-[#F28F20]">{{ auth()->user()->name ?? 'Admin IPDS' }}</span>
                        <span class="block text-[10px] text-blue-200/65">Halaman Profil</span>
                    </span>
                </div>
            </div>
        </div>
    </aside>

    <!-- KONTEN UTAMA (Kini Full Width Lebar) -->
    <main class="relative min-w-0 flex-1 overflow-y-auto bg-[#F1F5F9] p-8 lg:p-10">
        
        <!-- w-full memastikan konten meregang menyesuaikan layar -->
        <div class="w-full pb-12">
            
            <!-- Breadcrumb / Tombol Kembali -->
            <div class="flex items-center gap-4 mb-8">
                <a href="/admin/dashboard" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-blue-50 hover:text-[#005891] transition-colors shadow-sm">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Profil Administrator</h2>
            </div>

            <!-- HEADER KARTU PROFIL -->
            <div class="rounded-[32px] bg-gradient-to-br from-[#00385d] via-[#005891] to-[#0075c2] shadow-[0_15px_40px_-10px_rgba(0,88,145,0.4)] relative overflow-hidden mb-10 p-8 sm:p-12 flex flex-col md:flex-row items-center gap-8 border border-white/10">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -mt-10 -mr-10"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-white/5 rounded-full blur-2xl -mb-10 -ml-10"></div>

                <div class="w-36 h-36 rounded-full border-4 border-white/20 shadow-2xl overflow-hidden bg-[#F28F20] flex items-center justify-center text-5xl font-extrabold text-white shrink-0 relative z-10">
                    @if(auth()->user()->foto)
                        <img src="{{ asset('uploads/profil/' . auth()->user()->foto) }}" alt="Foto Admin" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(auth()->user()->name ?? 'Admin', 0, 2)) }}
                    @endif
                </div>

                <div class="flex-1 relative z-10 text-center md:text-left">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">{{ auth()->user()->name ?? 'Admin IPDS' }}</h1>
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-3">
                        <span class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md text-white px-4 py-1.5 rounded-full text-xs font-bold border border-white/20">
                            <i class="fa-solid fa-shield-halved text-blue-200"></i> Super Administrator
                        </span>
                        <span class="inline-flex items-center gap-2 bg-black/10 backdrop-blur-md text-blue-100 px-4 py-1.5 rounded-full text-xs font-medium border border-white/10">
                            <i class="fa-solid fa-envelope"></i> {{ auth()->user()->email ?? 'admin@bps.go.id' }}
                        </span>
                    </div>
                </div>

                <div class="relative z-10 shrink-0">
                    <a href="/admin/profil/edit" class="inline-flex items-center gap-2 bg-white text-[#005891] hover:bg-slate-50 px-6 py-3.5 rounded-2xl font-extrabold text-sm shadow-xl hover:shadow-2xl transition-all hover:-translate-y-0.5 border border-white/50">
                        <i class="fa-solid fa-pen text-xs"></i> Edit Profil
                    </a>
                </div>
            </div>

            <!-- GRID BAWAH -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- KOLOM KIRI (Pengaturan & Keluar) -->
                <div class="lg:col-span-4 space-y-6">
                    <h3 class="text-xs font-extrabold text-slate-400 uppercase tracking-widest pl-1">Pengaturan Akun</h3>
                    
                    <a href="/admin/profil/password" class="flex items-center gap-4 bg-white p-5 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md hover:border-blue-100 transition-all group">
                        <div class="w-14 h-14 bg-slate-50 text-slate-500 rounded-2xl flex items-center justify-center text-xl group-hover:bg-blue-50 group-hover:text-[#005891] transition-colors">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-extrabold text-slate-800">Ubah Password</h4>
                            <p class="text-[11px] font-medium text-slate-400 mt-1">Perbarui kata sandi admin</p>
                        </div>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-3 bg-red-50 hover:bg-red-100 text-red-600 px-6 py-4.5 rounded-3xl border border-red-100 font-extrabold text-sm transition-all shadow-sm">
                            <i class="fa-solid fa-arrow-right-from-bracket text-lg"></i> Keluar dari Admin
                        </button>
                    </form>
                </div>

                <!-- KOLOM KANAN (Aktivitas Dinamis / Realtime) -->
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 h-full">
                        <div class="flex justify-between items-center mb-8">
                            <h3 class="text-lg font-extrabold text-slate-800">Aktivitas Sistem Terakhir</h3>
                            <span class="text-xs font-bold text-slate-400 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">Hari ini</span>
                        </div>

                        <div class="space-y-8 relative">
                            <!-- Garis Timeline -->
                            <div class="absolute left-[23px] top-6 bottom-4 w-0.5 bg-slate-100"></div>

                            <!-- 1. Akses Profil Saat Ini -->
                            <div class="flex gap-5 relative z-10">
                                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#005891] flex items-center justify-center shrink-0 border-2 border-white text-lg shadow-sm">
                                    <i class="fa-solid fa-eye"></i>
                                </div>
                                <div class="pt-2.5">
                                    <h4 class="text-sm font-extrabold text-slate-800">Membuka Profil Admin</h4>
                                    <p class="text-xs font-medium text-slate-400 mt-1">Baru saja diakses</p>
                                </div>
                            </div>

                            <!-- 2. Data Real-time dari Tabel Pengecekan -->
                            @forelse($aktivitasHariIni as $item)
                            <div class="flex gap-5 relative z-10">
                                @php
                                    $warnaIcon = 'bg-emerald-50 text-emerald-500';
                                    $iconShape = 'fa-check';
                                    if(strtolower($item->kondisi) == 'rusak ringan') { $warnaIcon = 'bg-orange-50 text-orange-500'; $iconShape = 'fa-triangle-exclamation'; }
                                    if(strtolower($item->kondisi) == 'rusak berat') { $warnaIcon = 'bg-red-50 text-red-500'; $iconShape = 'fa-xmark'; }
                                @endphp
                                <div class="w-12 h-12 rounded-2xl {{ $warnaIcon }} flex items-center justify-center shrink-0 border-2 border-white text-lg shadow-sm">
                                    <i class="fa-solid {{ $iconShape }}"></i>
                                </div>
                                <div class="pt-2.5">
                                    <h4 class="text-sm font-extrabold text-slate-800">
                                        Pengecekan: {{ $item->aset->nama_barang ?? 'Aset TI' }}
                                    </h4>
                                    <p class="text-xs font-medium text-slate-400 mt-1">
                                        Dilaporkan <span class="font-bold uppercase">{{ $item->kondisi }}</span> • {{ $item->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            @empty
                            <div class="flex gap-5 relative z-10">
                                <div class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center shrink-0 border-2 border-white text-lg shadow-sm">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                </div>
                                <div class="pt-2.5">
                                    <h4 class="text-sm font-extrabold text-slate-800">Belum ada pengecekan aset</h4>
                                    <p class="text-xs font-medium text-slate-400 mt-1">Sistem belum mencatat pemeriksaan aset oleh petugas hari ini.</p>
                                </div>
                            </div>
                            @endforelse

                            <!-- 3. Sesi Login -->
                            <div class="flex gap-5 relative z-10">
                                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0 border-2 border-white text-lg shadow-sm">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                </div>
                                <div class="pt-2.5">
                                    <h4 class="text-sm font-extrabold text-slate-800">Login Admin Berhasil</h4>
                                    <p class="text-xs font-medium text-slate-400 mt-1">Sesi pengelolaan sistem dimulai hari ini.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</body>
</html>