<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTESA Admin - Riwayat & Laporan</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <style>
      body { font-family: "Plus Jakarta Sans", sans-serif; }
      ::-webkit-scrollbar { width: 6px; height: 6px; }
      ::-webkit-scrollbar-track { background: #f1f5f9; }
      ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
      .table-scroll { scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent; }
    </style>
</head>
<body class="bg-[#F1F5F9] text-slate-800 flex h-screen overflow-hidden antialiased">

    <!-- SIDEBAR KIRI (UNIFIED) -->
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
            <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'border-l-4 border-[#F28F20] bg-white/10 text-white font-bold' : 'border-l-4 border-transparent text-blue-100/75 hover:bg-white/5 hover:text-white font-medium' }} flex items-center gap-3 rounded-r-xl py-3.5 pl-5 pr-4 text-sm transition-all">
                <i class="fa-solid fa-chart-pie w-5 text-center {{ request()->is('admin/dashboard') ? 'text-[#F28F20]' : 'opacity-75' }}"></i> Dashboard
            </a>
            
            <a href="{{ route('aset.index') }}" class="{{ request()->is('aset*') ? 'border-l-4 border-[#F28F20] bg-white/10 text-white font-bold' : 'border-l-4 border-transparent text-blue-100/75 hover:bg-white/5 hover:text-white font-medium' }} flex items-center gap-3 rounded-r-xl py-3.5 pl-5 pr-4 text-sm transition-all">
                <i class="fa-solid fa-desktop w-5 text-center {{ request()->is('aset*') ? 'text-[#F28F20]' : 'opacity-75' }}"></i> Master Aset
            </a>
            
            <a href="{{ route('admin.denah') }}" class="{{ request()->is('admin/denah*') ? 'border-l-4 border-[#F28F20] bg-white/10 text-white font-bold' : 'border-l-4 border-transparent text-blue-100/75 hover:bg-white/5 hover:text-white font-medium' }} flex items-center gap-3 rounded-r-xl py-3.5 pl-5 pr-4 text-sm transition-all">
                <i class="fa-solid fa-map-location-dot w-5 text-center {{ request()->is('admin/denah*') ? 'text-[#F28F20]' : 'opacity-75' }}"></i> Denah Ruangan
            </a>
            
            <a href="{{ route('admin.riwayat') }}" class="{{ request()->is('admin/riwayat*') ? 'border-l-4 border-[#F28F20] bg-white/10 text-white font-bold' : 'border-l-4 border-transparent text-blue-100/75 hover:bg-white/5 hover:text-white font-medium' }} flex items-center gap-3 rounded-r-xl py-3.5 pl-5 pr-4 text-sm transition-all">
                <i class="fa-solid fa-file-invoice w-5 text-center {{ request()->is('admin/riwayat*') ? 'text-[#F28F20]' : 'opacity-75' }}"></i> Riwayat & Laporan
            </a>
        </nav>

        <div class="mt-auto p-5">
            <div class="mb-5 rounded-2xl bg-white/5 p-4 ring-1 ring-inset ring-white/10">
                <span class="inline-flex items-center gap-2 text-[11px] font-semibold text-blue-100">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span> Sistem Normal
                </span>
                <p class="mt-1 text-[10px] text-blue-200/60">Data tersinkronisasi aman.</p>
            </div>

            <a href="/admin/profil" class="flex items-center gap-3 border-t border-white/10 pt-4 hover:opacity-80 transition-opacity">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#F28F20] text-sm font-extrabold text-white overflow-hidden border-2 border-[#004b7c]">
                    @if(auth()->user()->foto)
                        <img src="{{ asset('uploads/profil/' . auth()->user()->foto) }}" alt="Foto" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
                    @endif
                </span>
                <span class="min-w-0 flex-1">
                    <span class="block truncate text-xs font-bold text-white">{{ auth()->user()->name ?? 'Admin IPDS' }}</span>
                    <span class="block text-[10px] text-blue-200/65">Administrator</span>
                </span>
                <i class="fa-solid fa-chevron-right text-xs text-blue-200/60"></i>
            </a>
        </div>
    </aside>

    <!-- KONTEN UTAMA KANAN -->
    <main class="relative min-w-0 flex-1 overflow-auto">
        <div class="relative min-h-full min-w-[1050px]">
            
            <div class="absolute left-0 top-0 z-0 h-64 w-full bg-[#0075c2]" aria-hidden="true"></div>

            <header class="relative z-10 flex h-20 items-center justify-between px-8 text-white">
                <label class="flex h-11 w-80 items-center gap-3 rounded-xl bg-white/20 px-4 transition focus-within:bg-white/25 focus-within:ring-2 focus-within:ring-white/40">
                    <i class="fa-solid fa-magnifying-glass text-sm text-blue-100"></i>
                    <input type="search" placeholder="Cari aset, ruangan, atau laporan..." class="w-full border-0 bg-transparent text-xs text-white outline-none placeholder:text-blue-200" />
                </label>
                <div class="flex items-center gap-5">
                    <span class="flex items-center gap-2 text-xs font-medium text-blue-100">
                        <i class="fa-regular fa-calendar text-sm"></i> {{ now()->isoFormat('dddd, D MMM Y') }}
                    </span>
                    <span class="h-6 w-px bg-white/20"></span>
                    <button class="relative flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 transition hover:bg-white/20">
                        <i class="fa-regular fa-bell text-lg"></i>
                        <span class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-[#F28F20] ring-2 ring-[#0075c2]"></span>
                    </button>
                </div>
            </header>

            <section class="relative z-10 px-8 pb-16 pt-4 text-white">
                <div class="flex items-end justify-between">
                    <div>
                        <h1 class="text-2xl font-extrabold tracking-tight">Riwayat Pengecekan Aset</h1>
                        <p class="mt-2 text-xs leading-relaxed text-blue-100/90">Pantau seluruh aktivitas dan kondisi aset TI dari petugas lapangan.</p>
                    </div>
                    <a href="{{ route('riwayat.export') }}" class="flex items-center gap-2 rounded-xl bg-[#F28F20] px-5 py-2.5 text-xs font-bold text-white shadow-lg transition hover:bg-orange-600">
                        <i class="fa-solid fa-download"></i> Ekspor Laporan
                    </a>
                </div>
            </section>

            <!-- KARTU TABEL -->
            <section class="relative z-20 -mt-12 flex h-[calc(100vh-180px)] min-h-[420px] flex-col px-8 pb-8">
                
                <div class="flex h-full flex-col overflow-hidden rounded-2xl bg-white shadow-xl shadow-blue-900/10 border border-slate-100">
                    
                    <!-- Filter Bar -->
                    <div class="flex shrink-0 items-center justify-between gap-4 border-b border-slate-100 p-5 bg-white">
                        <div class="flex items-center gap-3">
                            <label class="flex h-11 w-72 items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 transition focus-within:border-[#0075c2] focus-within:bg-white focus-within:ring-2 focus-within:ring-blue-100">
                                <i class="fa-solid fa-magnifying-glass text-xs text-slate-400"></i>
                                <input type="search" placeholder="Cari laporan..." class="min-w-0 flex-1 border-0 bg-transparent text-xs font-semibold text-slate-700 outline-none placeholder:text-slate-400" />
                            </label>
                            <select class="h-11 rounded-xl border border-slate-200 bg-white px-4 text-xs font-bold text-slate-600 outline-none hover:bg-slate-50">
                                <option>Semua Status</option>
                                <option>Normal</option>
                                <option>Rusak Ringan</option>
                                <option>Rusak Berat</option>
                            </select>
                        </div>
                        <div class="flex items-center gap-4 border-l border-slate-200 pl-5">
                            <div class="text-right">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Laporan</p>
                                <p class="text-lg font-extrabold text-[#0075c2] leading-none mt-1.5">{{ count($riwayats) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Area Tabel -->
                    <div class="table-scroll min-h-0 flex-1 overflow-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="sticky top-0 z-10 border-b border-slate-100 bg-slate-50 text-[11px] font-extrabold uppercase tracking-widest text-slate-500">
                                <tr>
                                    <th class="px-6 py-4">Waktu Cek</th>
                                    <th class="px-5 py-4">Aset & Lokasi</th>
                                    <th class="px-5 py-4">Pengguna Aset</th>
                                    <th class="px-5 py-4">Status</th>
                                    <th class="px-5 py-4">Parameter (UPS)</th>
                                    <th class="px-6 py-4">Catatan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 bg-white">
                                @forelse($riwayats as $item)
                                <tr class="transition-colors hover:bg-blue-50/40">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="block text-xs font-extrabold text-slate-700">{{ \Carbon\Carbon::parse($item->tanggal_cek)->format('d M Y') }}</span>
                                        <span class="block text-[10px] font-semibold text-slate-400 mt-1">{{ \Carbon\Carbon::parse($item->tanggal_cek)->format('H:i') }} WITA</span>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="block whitespace-nowrap text-xs font-extrabold text-[#0075c2]">{{ $item->aset->kode_qr ?? '-' }}</span>
                                        <span class="mt-1 block text-[11px] font-bold text-slate-700">{{ $item->aset->nama_perangkat ?? '-' }}</span>
                                        <span class="block text-[10px] font-medium text-slate-400 mt-0.5">{{ $item->aset->ruangan->nama_ruangan ?? 'Ruangan Belum Diatur' }}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4">
                                        @php
                                            $pengguna = $item->nama_pengguna ?? ($item->aset->nama_pengguna ?? null);
                                        @endphp
                                        @if($pengguna)
                                            <div class="inline-flex items-center gap-2 rounded-lg border border-slate-200/80 bg-slate-50 px-2.5 py-1">
                                                <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#0075c2]/10 text-[#0075c2]">
                                                    <i class="fa-solid fa-user text-[9px]"></i>
                                                </span>
                                                <span class="text-xs font-bold text-slate-700">{{ $pengguna }}</span>
                                            </div>
                                        @else
                                            <span class="text-[11px] font-medium italic text-slate-400">Belum ditentukan</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        @php
                                            $kond = strtolower($item->status);
                                            $badge = ['bg-slate-50 text-slate-500', 'fa-circle-question'];
                                            if($kond == 'normal') $badge = ['bg-emerald-50 text-emerald-700 border border-emerald-100', 'fa-circle-check'];
                                            elseif($kond == 'rusak ringan') $badge = ['bg-orange-50 text-orange-700 border border-orange-100', 'fa-triangle-exclamation'];
                                            elseif($kond == 'rusak berat') $badge = ['bg-red-50 text-red-700 border border-red-100', 'fa-circle-xmark'];
                                        @endphp
                                        <span class="inline-flex items-center gap-1.5 rounded-full {{ $badge[0] }} px-2.5 py-1 text-[10px] font-bold capitalize shadow-sm">
                                            <i class="fa-solid {{ $badge[1] }}"></i> {{ $kond }}
                                        </span>
                                    </td>
                                    
                                    <!-- Parameter -->
                                    <td class="px-5 py-4 min-w-[220px]">
                                        @if(strtoupper($item->aset->kategori ?? '') == 'UPS')
                                            <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-[11px]">
                                                <div class="flex items-center justify-between border-b border-slate-100 pb-1.5">
                                                    <span class="text-slate-400 font-medium">Baterai</span>
                                                    <span class="font-extrabold text-slate-700">{{ $item->battery_health ?? '-' }}%</span>
                                                </div>
                                                <div class="flex items-center justify-between border-b border-slate-100 pb-1.5">
                                                    <span class="text-slate-400 font-medium">Beban</span>
                                                    <span class="font-extrabold text-slate-700">{{ $item->beban ?? '-' }}%</span>
                                                </div>
                                                <div class="flex items-center justify-between pt-0.5">
                                                    <span class="text-slate-400 font-medium">Suhu</span>
                                                    <span class="font-extrabold text-slate-700">{{ $item->suhu ?? '-' }}°C</span>
                                                </div>
                                                <div class="flex items-center justify-between pt-0.5">
                                                    <span class="text-slate-400 font-medium">Output</span>
                                                    <span class="font-extrabold text-slate-700">{{ $item->tegangan ?? '-' }}V</span>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-[11px] text-slate-400 italic font-medium">N/A</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-[11px] font-medium text-slate-500 max-w-[200px] leading-relaxed" title="{{ $item->catatan }}">
                                        {{ $item->catatan ?? 'Tidak ada catatan.' }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="h-16 w-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                                <i class="fa-solid fa-folder-open text-3xl text-slate-300"></i>
                                            </div>
                                            <p class="text-sm font-extrabold text-slate-700">Belum Ada Riwayat Laporan</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </main>

</body>
</html>