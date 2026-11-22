<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTESA Admin - Denah Ruangan</title>
    
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
      
      .table-scroll {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 transparent;
      }
      
      .node-btn { transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1), filter 0.2s; cursor: pointer; }
      .node-btn:hover { filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.15)); z-index: 50; }
      .node-btn:active { transform: scale(0.92); }
      .node-selected { transform: scale(1.15); z-index: 60; filter: drop-shadow(0 0 8px rgba(0, 117, 194, 0.55)); }
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
                    @if(auth()->user()->foto ?? false)
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
        <div class="relative min-h-full min-w-[1150px]">
            
            <div class="absolute left-0 top-0 z-0 h-64 w-full bg-[#0075c2]" aria-hidden="true"></div>

            <header class="relative z-10 flex h-20 items-center justify-between px-8 text-white">
                <label class="flex h-11 w-80 items-center gap-3 rounded-xl bg-white/20 px-4 transition">
                    <i class="fa-solid fa-magnifying-glass text-sm text-blue-100"></i>
                    <input type="search" placeholder="Cari aset, ruangan, atau laporan..." class="w-full border-0 bg-transparent text-xs text-white outline-none placeholder:text-blue-200" />
                </label>
                <div class="flex items-center gap-5">
                    <span class="flex items-center gap-2 text-xs font-medium text-blue-100">
                        <i class="fa-regular fa-calendar text-sm"></i> {{ now()->isoFormat('dddd, D MMM Y') }}
                    </span>
                    <button class="relative flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 transition hover:bg-white/20">
                        <i class="fa-regular fa-bell text-lg"></i>
                        <span class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-[#F28F20] ring-2 ring-[#0075c2]"></span>
                    </button>
                </div>
            </header>

            <section class="relative z-10 px-8 pb-8 pt-4 text-white">
                <h1 class="text-2xl font-extrabold tracking-tight">Denah Posisi UPS & Workstation</h1>
                <p class="mt-2 text-xs leading-relaxed text-blue-100/90">Visualisasi tata letak inventaris TI BPS Provinsi Sulawesi Tengah.</p>
            </section>

            <!-- SPLIT LAYOUT PANEL -->
            <section class="relative z-20 -mt-2 flex h-[calc(100vh-160px)] min-h-[600px] gap-6 px-8 pb-8">
                
                <!-- KIRI: KANVAS DENAH -->
                <div class="relative flex flex-1 flex-col overflow-hidden rounded-2xl bg-white shadow-xl shadow-blue-900/10 border border-slate-100">
                    
                    <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4 bg-slate-50/50">
                        <h2 class="text-sm font-extrabold text-slate-800"><i class="fa-solid fa-map text-slate-400 mr-2"></i> Ruang Pengolahan IPDS</h2>
                        <div class="flex gap-4 text-[10px] font-bold text-slate-500 bg-white px-3 py-1.5 rounded-lg border border-slate-200">
                            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-[#10b981]"></span> Normal / Ada NUP</span>
                            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-red-600"></span> Rusak</span>
                            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-[#F28F20]"></span> N/A (Belum Ada NUP)</span>
                        </div>
                    </div>

                    <div class="table-scroll relative flex-1 overflow-auto bg-[#f1f5f9] p-8">
                        
                        <!-- KANVAS UTAMA -->
                        <div class="relative mx-auto h-[780px] w-[860px] border-[3px] border-[#1e3a8a] bg-[#f8fafc] shadow-sm">
                            
                            <!-- BORDER GUDANG (Kiri Atas) -->
                            <div class="absolute top-0 left-0 w-[270px] h-[220px] bg-[#f8fafc] border-b-[3px] border-r-[3px] border-[#1e3a8a]"></div>
                            
                            <!-- PINTU GUDANG -->
                            <div class="absolute top-[-3px] left-[270px] w-[140px] h-[3px] bg-[#f8fafc]"></div>
                            <div class="absolute top-0 left-[270px] w-[100px] border-b-[2px] border-dashed border-[#1e3a8a] origin-top-left rotate-[40deg]"></div>
                            <div class="absolute top-[-16px] left-[280px] bg-[#f8fafc] px-2 text-[11px] font-extrabold tracking-widest text-[#1e3a8a]">PINTU GUDANG</div>
                            
                            <!-- PINTU RUANGAN (Kiri Bawah) -->
                            <div class="absolute bottom-[110px] left-[-3px] w-[3px] h-[120px] bg-[#f8fafc]"></div>
                            <div class="absolute bottom-[110px] left-0 w-[100px] border-b-[2px] border-dashed border-[#1e3a8a] origin-bottom-left rotate-[-50deg]"></div>
                            <div class="absolute bottom-[145px] left-[-80px] bg-white px-2 py-1.5 border border-slate-200 shadow-sm rounded text-[9px] font-extrabold tracking-widest text-[#1e3a8a] text-center">PINTU<br>RUANGAN</div>
                            
                            <!-- PINTU SERVER (Bawah Tengah) -->
                            <div class="absolute bottom-[-3px] left-[390px] w-[140px] h-[3px] bg-[#f8fafc]"></div>
                            <div class="absolute bottom-0 left-[390px] w-[100px] border-b-[2px] border-dashed border-[#1e3a8a] origin-bottom-left rotate-[-45deg]"></div>
                            <div class="absolute bottom-[-45px] left-[405px] bg-white px-2 py-1.5 border border-slate-200 shadow-sm rounded text-[9px] font-extrabold tracking-widest text-[#1e3a8a] text-center">PINTU<br>SERVER</div>

                            <!-- MEJA BUNDAR (Kanan - Dinaikkan sedikit agar jarak dengan meja bawah lega) -->
                            <div class="absolute top-[125px] right-[80px] h-[390px] w-[150px] rounded-full border-[2px] border-[#1e3a8a] bg-[#eff6ff]/30"></div>
                            
                            <!-- MEJA PERSEGI PANJANG (Kiri Bawah) -->
                            <div class="absolute bottom-[60px] left-[110px] h-[90px] w-[260px] rounded-xl border-[2px] border-[#1e3a8a] bg-[#eff6ff]/30"></div>
                            
                            <!-- MEJA PERSEGI PANJANG (Kanan Bawah) -->
                            <div class="absolute bottom-[60px] right-[80px] h-[90px] w-[340px] rounded-xl border-[2px] border-[#1e3a8a] bg-[#eff6ff]/30"></div>

                            @php
                                // Peta status aset berdasarkan NUP (merah jika ada perangkat di NUP tersebut yang rusak)
                                $asetStatusMap = [];
                                foreach ($asets as $itemAset) {
                                    $rawNup = trim($itemAset->nup ?? '');
                                    $cleanNup = ltrim(preg_replace('/^[^0-9]+/', '', $rawNup), '0');
                                    $kondAset = strtolower($itemAset->kondisi ?? '');
                                    $isRusak = in_array($kondAset, ['rusak ringan', 'rusak berat']);

                                    if ($rawNup !== '') {
                                        if (!isset($asetStatusMap[$rawNup]) || $isRusak) {
                                            $asetStatusMap[$rawNup] = $kondAset;
                                        }
                                    }
                                    if ($cleanNup !== '') {
                                        if (!isset($asetStatusMap[$cleanNup]) || $isRusak) {
                                            $asetStatusMap[$cleanNup] = $kondAset;
                                        }
                                    }
                                }

                                function drawPC($nup, $x, $y, $rotation = 0, $nupPos = 'bottom', $isNA = false, $statusMap = []) {
                                    $bgColor = $isNA ? 'bg-[#F28F20]' : 'bg-[#10b981]';
                                    $nupText = $isNA ? 'N/A' : $nup;

                                    if (!$isNA && isset($statusMap[$nup]) && in_array($statusMap[$nup], ['rusak ringan', 'rusak berat'])) {
                                        $bgColor = 'bg-red-600';
                                    }
                                    
                                    $labelStyle = '';
                                    if ($nupPos == 'bottom') $labelStyle = 'bottom: -24px; left: 50%; transform: translateX(-50%);';
                                    if ($nupPos == 'top') $labelStyle = 'top: -24px; left: 50%; transform: translateX(-50%);';
                                    if ($nupPos == 'right') $labelStyle = 'top: 50%; right: -42px; transform: translateY(-50%);';
                                    if ($nupPos == 'left') $labelStyle = 'top: 50%; left: -42px; transform: translateY(-50%);';
                                    
                                    if ($isNA && empty($nup)) {
                                        $pcIcon = "<svg style='transform: rotate({$rotation}deg);' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='#94a3b8' class='w-8 h-8 opacity-40 drop-shadow-sm'><path d='M4 4h16v12H4z'/><path d='M2 4a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2 0v12h16V4H4zm5 16h6v2H9v-2z'/></svg>";
                                        return "<div class='absolute flex items-center justify-center' style='left: {$x}px; top: {$y}px; width: 32px; height: 32px;'>{$pcIcon}</div>";
                                    }

                                    $pcIcon = "<svg style='transform: rotate({$rotation}deg);' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='#1e3a8a' class='w-8 h-8 drop-shadow-md'><path d='M4 4h16v12H4z'/><path d='M2 4a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2 0v12h16V4H4zm5 16h6v2H9v-2z'/></svg>";
                                    
                                    return "
                                    <div class='absolute flex items-center justify-center node-btn' style='left: {$x}px; top: {$y}px; width: 32px; height: 32px;'
                                        onclick='showDetail(this)' data-nup='{$nupText}' data-bg='{$bgColor}'>
                                        {$pcIcon}
                                        <div class='absolute flex h-5 min-w-[34px] items-center justify-center rounded {$bgColor} px-1.5 text-[10px] font-bold text-white shadow-md ring-1 ring-white/50' style='{$labelStyle} z-index: 10;'>
                                            {$nupText}
                                        </div>
                                    </div>";
                                }
                            @endphp

                            <!-- KELOMPOK KIRI ATAS (Area Luar Gudang) -->
                            {!! drawPC('', 230, 160, 0, 'bottom', true, $asetStatusMap) !!}
                            {!! drawPC('86', 230, 230, 0, 'right', false, $asetStatusMap) !!}
                            
                            {!! drawPC('63', 150, 310, 0, 'bottom', false, $asetStatusMap) !!}
                            {!! drawPC('N/A', 230, 310, 0, 'bottom', true, $asetStatusMap) !!}

                            <!-- KELOMPOK TENGAH KIRI (Vertikal) -->
                            {!! drawPC('N/A', 80, 400, 0, 'right', true, $asetStatusMap) !!}
                            {!! drawPC('82', 80, 470, 0, 'right', false, $asetStatusMap) !!}
                            {!! drawPC('N/A', 80, 540, 0, 'right', true, $asetStatusMap) !!}

                            <!-- MEJA PERSEGI KIRI BAWAH -->
                            {!! drawPC('19', 135, 595, 0, 'top', false, $asetStatusMap) !!}
                            {!! drawPC('N/A', 205, 595, 0, 'top', true, $asetStatusMap) !!}
                            {!! drawPC('N/A', 275, 595, 0, 'top', true, $asetStatusMap) !!}
                            {!! drawPC('78', 135, 695, 180, 'bottom', false, $asetStatusMap) !!}
                            {!! drawPC('15', 205, 695, 180, 'bottom', false, $asetStatusMap) !!}
                            {!! drawPC('N/A', 275, 695, 180, 'bottom', true, $asetStatusMap) !!}

                            <!-- MEJA PERSEGI KANAN BAWAH -->
                            {!! drawPC('65', 465, 595, 0, 'top', false, $asetStatusMap) !!}
                            {!! drawPC('72', 535, 595, 0, 'top', false, $asetStatusMap) !!}
                            {!! drawPC('N/A', 605, 595, 0, 'top', true, $asetStatusMap) !!}
                            {!! drawPC('98', 675, 595, 0, 'top', false, $asetStatusMap) !!}
                            {!! drawPC('N/A', 465, 695, 180, 'bottom', true, $asetStatusMap) !!}
                            {!! drawPC('N/A', 535, 695, 180, 'bottom', true, $asetStatusMap) !!}
                            {!! drawPC('18', 605, 695, 180, 'bottom', false, $asetStatusMap) !!}
                            {!! drawPC('67', 675, 695, 180, 'bottom', false, $asetStatusMap) !!}

                            <!-- MEJA BUNDAR / OVAL -->
                            {!! drawPC('', 690, 110, 0, 'top', true, $asetStatusMap) !!}
                            {!! drawPC('64', 610, 195, -15, 'left', false, $asetStatusMap) !!}
                            {!! drawPC('49', 600, 275, -5, 'left', false, $asetStatusMap) !!}
                            {!! drawPC('N/A', 605, 355, 5, 'left', true, $asetStatusMap) !!}
                            {!! drawPC('84', 615, 435, 15, 'left', false, $asetStatusMap) !!}
                            {!! drawPC('14', 690, 500, 0, 'bottom', false, $asetStatusMap) !!}
                            {!! drawPC('88', 765, 235, 15, 'right', false, $asetStatusMap) !!}
                            {!! drawPC('', 765, 325, 0, 'right', true, $asetStatusMap) !!}


                            <!-- DATA INJECTOR UNTUK JAVASCRIPT -->
                            <div id="aset-data-container" class="hidden">
                                @foreach($asets as $aset)
                                    @php
                                        $kondisi = strtolower($aset->kondisi ?? '');
                                        $statusText = 'Belum Dicek';
                                        $badgeColor = 'bg-slate-400';
                                        $icon = 'fa-circle-question';
                                        $severity = 0;

                                        if ($kondisi === 'normal') {
                                            $statusText = 'Normal';
                                            $badgeColor = 'bg-[#10b981]';
                                            $icon = 'fa-circle-check';
                                            $severity = 1;
                                        } elseif ($kondisi === 'rusak ringan') {
                                            $statusText = 'Rusak Ringan';
                                            $badgeColor = 'bg-[#F28F20]';
                                            $icon = 'fa-triangle-exclamation';
                                            $severity = 2;
                                        } elseif ($kondisi === 'rusak berat') {
                                            $statusText = 'Rusak Berat';
                                            $badgeColor = 'bg-red-500';
                                            $icon = 'fa-circle-xmark';
                                            $severity = 3;
                                        }
                                        
                                        $baterai = '-';
                                        $beban = '-';
                                        $suhu = '-';
                                        $output = '-';
                                        $catatan = $aset->catatan ?: 'Belum ada catatan pengecekan.';
                                        $waktu = '-';
                                        $timestamp = 0;

                                        $cekTerakhir = $aset->pengecekans->sortByDesc('created_at')->first();
                                        if ($cekTerakhir) {
                                            $baterai = ($cekTerakhir->battery_health !== null && $cekTerakhir->battery_health !== '') ? $cekTerakhir->battery_health . '%' : '-';
                                            $beban = ($cekTerakhir->beban !== null && $cekTerakhir->beban !== '') ? $cekTerakhir->beban . '%' : '-';
                                            $suhu = ($cekTerakhir->suhu !== null && $cekTerakhir->suhu !== '') ? $cekTerakhir->suhu . '°C' : '-';
                                            $output = ($cekTerakhir->tegangan !== null && $cekTerakhir->tegangan !== '') ? $cekTerakhir->tegangan . 'V' : '-';
                                            $catatan = $cekTerakhir->catatan ?: ($aset->catatan ?: 'Tidak ada catatan khusus.');
                                            $waktu = $cekTerakhir->tanggal_cek 
                                                ? \Carbon\Carbon::parse($cekTerakhir->tanggal_cek)->format('d M Y, H:i') . ' WITA' 
                                                : ($cekTerakhir->created_at ? $cekTerakhir->created_at->format('d M Y, H:i') . ' WITA' : '-');
                                            $timestamp = $cekTerakhir->created_at ? $cekTerakhir->created_at->timestamp : 0;
                                        }
                                    @endphp
                                    <div class="aset-data-item" 
                                        data-nup="{{ trim($aset->nup ?? '') }}"
                                        data-kategori="{{ $aset->kategori ?? 'Perangkat' }}"
                                        data-status="{{ $statusText }}"
                                        data-severity="{{ $severity }}"
                                        data-badge="{{ $badgeColor }}"
                                        data-icon="{{ $icon }}"
                                        data-nama="{{ $aset->nama_perangkat ?? 'Perangkat TI' }}"
                                        data-kode="{{ $aset->kode_qr ?? '-' }}"
                                        data-pengguna="{{ $aset->nama_pengguna ?? '' }}"
                                        data-baterai="{{ $baterai }}"
                                        data-beban="{{ $beban }}"
                                        data-suhu="{{ $suhu }}"
                                        data-output="{{ $output }}"
                                        data-catatan="{{ $catatan }}"
                                        data-waktu="{{ $waktu }}"
                                        data-ts="{{ $timestamp }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KANAN: PANEL DETAIL ASET -->
                <div class="flex w-80 shrink-0 flex-col overflow-hidden rounded-2xl bg-white shadow-xl shadow-blue-900/10 border border-slate-100">
                    
                    <div id="panel-kosong" class="flex-1 flex flex-col items-center justify-center p-5 text-center opacity-60">
                        <i class="fa-solid fa-hand-pointer text-5xl text-slate-200 mb-4 drop-shadow-sm"></i>
                        <h3 class="font-extrabold text-slate-700 text-sm mb-1.5">Pilih Perangkat</h3>
                        <p class="text-xs font-medium text-slate-500 leading-relaxed px-2">Klik salah satu titik meja pada denah di sebelah kiri untuk melihat detail perangkat, hasil form cek, dan penggunanya.</p>
                    </div>

                    <div id="panel-isi" class="hidden flex-1 flex-col h-full">
                        <div class="border-b border-slate-100 bg-[#0075c2] p-5 text-white shadow-inner">
                            <div class="flex items-center justify-between mb-3">
                                <span id="view-nup" class="rounded-lg bg-white/20 px-2.5 py-1 text-[10px] font-extrabold tracking-wider">NUP #--</span>
                                <span id="view-badge" class="flex items-center gap-1.5 rounded-full px-2.5 py-1 text-[10px] font-bold text-white shadow-sm bg-[#10b981]">
                                    <i id="view-icon" class="fa-solid fa-circle-check"></i> <span id="view-status">Normal</span>
                                </span>
                            </div>
                            <h3 id="view-nama" class="text-base font-extrabold leading-snug">Nama Perangkat</h3>
                            <p id="view-kode" class="font-mono text-[11px] font-medium text-blue-200 mt-1">KODE-ASET</p>
                        </div>

                        <div class="flex-1 overflow-y-auto p-5 space-y-5">
                            <!-- INFO PENGGUNA ASET -->
                            <div class="rounded-xl border border-blue-100 bg-blue-50/60 p-3.5 flex items-center gap-3">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#0075c2] text-white shadow-sm">
                                    <i class="fa-solid fa-user text-xs"></i>
                                </span>
                                <div class="min-w-0 flex-1">
                                    <p class="text-[9px] font-extrabold uppercase tracking-wider text-slate-400">Pengguna / Pemegang Aset</p>
                                    <p id="view-pengguna" class="text-xs font-extrabold text-slate-800 truncate mt-0.5">-</p>
                                </div>
                            </div>

                            <!-- DAFTAR PERANGKAT DI NUP INI (UPS, PC, MONITOR) -->
                            <div id="view-device-section" class="hidden">
                                <p class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 mb-2.5">Perangkat di Titik Ini</p>
                                <div id="view-device-list" class="space-y-2"></div>
                            </div>

                            <!-- PARAMETER UPS TERAKHIR -->
                            <div>
                                <p class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 mb-2.5">Parameter UPS Terakhir</p>
                                <div class="grid grid-cols-2 gap-2.5">
                                    <div class="rounded-xl border border-slate-100 bg-slate-50 p-3 transition hover:bg-white hover:shadow-md">
                                        <div class="text-[10px] font-bold text-slate-500 mb-1 flex justify-between">Baterai <i class="fa-solid fa-car-battery text-slate-300"></i></div>
                                        <div id="view-baterai" class="text-base font-extrabold text-slate-800">-</div>
                                    </div>
                                    <div class="rounded-xl border border-slate-100 bg-slate-50 p-3 transition hover:bg-white hover:shadow-md">
                                        <div class="text-[10px] font-bold text-slate-500 mb-1 flex justify-between">Beban <i class="fa-solid fa-bolt text-slate-300"></i></div>
                                        <div id="view-beban" class="text-base font-extrabold text-slate-800">-</div>
                                    </div>
                                    <div class="rounded-xl border border-slate-100 bg-slate-50 p-3 transition hover:bg-white hover:shadow-md">
                                        <div class="text-[10px] font-bold text-slate-500 mb-1 flex justify-between">Suhu <i class="fa-solid fa-temperature-half text-slate-300"></i></div>
                                        <div id="view-suhu" class="text-base font-extrabold text-slate-800">-</div>
                                    </div>
                                    <div class="rounded-xl border border-slate-100 bg-slate-50 p-3 transition hover:bg-white hover:shadow-md">
                                        <div class="text-[10px] font-bold text-slate-500 mb-1 flex justify-between">Output <i class="fa-solid fa-plug text-slate-300"></i></div>
                                        <div id="view-output" class="text-base font-extrabold text-slate-800">-</div>
                                    </div>
                                </div>
                            </div>

                            <!-- CATATAN & HASIL FORM PENGECEKAN -->
                            <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">
                                <p class="text-[10px] font-bold text-slate-500 mb-1.5"><i class="fa-regular fa-comment-dots mr-1"></i> Hasil Form / Catatan Petugas</p>
                                <p id="view-catatan" class="text-xs font-semibold text-slate-700 leading-relaxed whitespace-pre-line">-</p>
                            </div>
                            
                            <div class="border-t border-slate-100 pt-3 text-center">
                                <p class="text-[10px] font-medium text-slate-400">Pengecekan Terakhir</p>
                                <p id="view-waktu" class="text-[11px] font-bold text-slate-600 mt-0.5">-</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        function findAsetsByNup(targetNup) {
            const items = Array.from(document.querySelectorAll('.aset-data-item'));
            return items.filter(item => {
                const raw = (item.getAttribute('data-nup') || '').trim();
                if (!raw) return false;
                if (raw === targetNup) return true;
                const cleaned = raw.replace(/^[^0-9]+/, '').replace(/^0+/, '');
                return cleaned !== '' && cleaned === targetNup;
            });
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function showDetail(element) {
            document.querySelectorAll('.node-btn').forEach(btn => btn.classList.remove('node-selected'));
            element.classList.add('node-selected');

            document.getElementById('panel-kosong').classList.add('hidden');
            document.getElementById('panel-isi').classList.remove('hidden');
            document.getElementById('panel-isi').classList.add('flex');

            const nup = element.getAttribute('data-nup');
            const deviceSection = document.getElementById('view-device-section');
            const deviceList = document.getElementById('view-device-list');
            deviceList.innerHTML = '';
            deviceSection.classList.add('hidden');
            
            let statusText = 'Belum Ada';
            let icon = 'fa-triangle-exclamation';
            let badgeBg = 'bg-[#F28F20]';
            let nama = 'Slot Kosong / N/A';
            let kode = '-';
            let pengguna = 'Belum ditentukan';
            let penggunaMuted = true;
            let baterai = '-';
            let beban = '-';
            let suhu = '-';
            let output = '-';
            let catatan = 'Posisi meja ini belum memiliki perangkat yang terdata.';
            let waktu = '-';

            if (nup !== 'N/A') {
                const matched = findAsetsByNup(nup);
                if (matched.length > 0) {
                    // Prioritaskan UPS untuk parameter listrik, atau ambil perangkat pertama
                    const upsItem = matched.find(el => (el.getAttribute('data-kategori') || '').toLowerCase() === 'ups');
                    const primary = upsItem || matched[0];

                    // Ambil status tertinggi (Rusak Berat > Rusak Ringan > Normal > Belum Dicek)
                    let worst = matched[0];
                    matched.forEach(el => {
                        if (parseInt(el.getAttribute('data-severity') || '0', 10) > parseInt(worst.getAttribute('data-severity') || '0', 10)) {
                            worst = el;
                        }
                    });

                    statusText = worst.getAttribute('data-status');
                    icon = worst.getAttribute('data-icon');
                    badgeBg = worst.getAttribute('data-badge');

                    if (matched.length === 1) {
                        nama = primary.getAttribute('data-nama');
                        kode = primary.getAttribute('data-kode');
                    } else {
                        nama = `${matched.length} Perangkat Terdaftar`;
                        kode = matched.map(el => el.getAttribute('data-kategori')).join(' • ');
                    }

                    // Cari nama pengguna dari perangkat yang sudah diisi
                    const userItem = matched.find(el => (el.getAttribute('data-pengguna') || '').trim() !== '');
                    if (userItem) {
                        pengguna = userItem.getAttribute('data-pengguna').trim();
                        penggunaMuted = false;
                    }

                    // Ambil parameter UPS jika ada
                    if (upsItem) {
                        baterai = upsItem.getAttribute('data-baterai');
                        beban = upsItem.getAttribute('data-beban');
                        suhu = upsItem.getAttribute('data-suhu');
                        output = upsItem.getAttribute('data-output');
                    }

                    // Tampilkan daftar perangkat (UPS, PC, Monitor, dll.)
                    deviceSection.classList.remove('hidden');
                    matched.forEach(el => {
                        const dKat = escapeHtml(el.getAttribute('data-kategori'));
                        const dNama = escapeHtml(el.getAttribute('data-nama'));
                        const dKode = escapeHtml(el.getAttribute('data-kode'));
                        const dStatus = escapeHtml(el.getAttribute('data-status'));
                        const dBadge = el.getAttribute('data-badge');
                        const dCatatan = escapeHtml(el.getAttribute('data-catatan'));

                        deviceList.innerHTML += `
                            <div class="rounded-xl border border-slate-100 bg-slate-50/90 p-3">
                                <div class="flex items-center justify-between gap-2 mb-1">
                                    <span class="rounded bg-blue-100/80 px-1.5 py-0.5 text-[9px] font-extrabold text-[#0075c2] uppercase">${dKat}</span>
                                    <span class="rounded-full ${dBadge} px-2 py-0.5 text-[9px] font-bold text-white">${dStatus}</span>
                                </div>
                                <p class="text-xs font-extrabold text-slate-800">${dNama}</p>
                                <p class="font-mono text-[10px] text-slate-400 mt-0.5">${dKode}</p>
                                <p class="text-[10px] text-slate-600 mt-1.5 pt-1.5 border-t border-slate-200/60">${dCatatan}</p>
                            </div>
                        `;
                    });

                    // Ambil pengecekan terbaru di antara perangkat pada NUP ini
                    let latest = matched[0];
                    matched.forEach(el => {
                        if (parseInt(el.getAttribute('data-ts') || '0', 10) > parseInt(latest.getAttribute('data-ts') || '0', 10)) {
                            latest = el;
                        }
                    });
                    waktu = latest.getAttribute('data-waktu');
                    catatan = matched.length === 1
                        ? primary.getAttribute('data-catatan')
                        : matched.map(el => `[${el.getAttribute('data-kategori')}] ${el.getAttribute('data-catatan')}`).join('\n');
                } else {
                    nama = 'Perangkat Belum Terdata';
                    catatan = 'NUP ini ada di denah, namun belum diinput ke Master Aset oleh Admin.';
                    badgeBg = 'bg-slate-400';
                    statusText = 'Tidak Ditemukan';
                }
            }

            document.getElementById('view-nup').textContent = nup !== 'N/A' ? `NUP #${nup}` : 'N/A';
            document.getElementById('view-nama').textContent = nama;
            document.getElementById('view-kode').textContent = kode;
            document.getElementById('view-status').textContent = statusText;
            document.getElementById('view-icon').className = `fa-solid ${icon}`;
            
            const badge = document.getElementById('view-badge');
            badge.className = `flex items-center gap-1.5 rounded-full px-2.5 py-1 text-[10px] font-bold text-white shadow-sm ${badgeBg}`;

            const penggunaEl = document.getElementById('view-pengguna');
            penggunaEl.textContent = pengguna;
            penggunaEl.className = penggunaMuted 
                ? 'text-xs font-medium italic text-slate-400 truncate mt-0.5' 
                : 'text-xs font-extrabold text-slate-800 truncate mt-0.5';

            document.getElementById('view-baterai').textContent = baterai;
            document.getElementById('view-beban').textContent = beban;
            document.getElementById('view-suhu').textContent = suhu;
            document.getElementById('view-output').textContent = output;
            document.getElementById('view-catatan').textContent = catatan;
            document.getElementById('view-waktu').textContent = waktu;
        }
    </script>
</body>
</html>