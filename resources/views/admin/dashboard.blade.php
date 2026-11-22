<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTESA Admin - Dashboard</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
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
    <main class="relative min-w-0 flex-1 overflow-y-auto bg-[#F1F5F9]">
        <div class="relative min-h-full min-w-[900px]">
            <!-- BANNER BIRU DI ATAS -->
            <div class="absolute left-0 top-0 z-0 h-72 w-full bg-[#0075c2]" aria-hidden="true"></div>

            <!-- NAVBAR ATAS -->
            <header class="relative z-10 flex h-20 items-center justify-between px-8 text-white">
                <form action="{{ route('aset.index') }}" method="GET" class="flex h-11 w-80 items-center gap-3 rounded-xl bg-white/20 px-4 transition focus-within:bg-white/25 focus-within:ring-2 focus-within:ring-white/40">
                    <i class="fa-solid fa-magnifying-glass text-blue-100 text-sm"></i>
                    <input type="search" name="search" placeholder="Cari aset, NUP, atau pengguna..." class="w-full border-0 bg-transparent text-xs text-white outline-none placeholder:text-blue-200 font-medium" />
                </form>

                <div class="flex items-center gap-5">
                    <span class="flex items-center gap-2 text-xs font-medium text-blue-100">
                        <i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::now('Asia/Makassar')->isoFormat('dddd, D MMM Y') }}
                    </span>
                    <span class="h-6 w-px bg-white/20"></span>
                    
                    <!-- TOMBOL LONCENG NOTIFIKASI -->
                    <a href="{{ route('admin.riwayat') }}" class="relative flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 transition hover:bg-white/20" title="Lihat Notifikasi & Laporan">
                        <i class="fa-regular fa-bell text-base"></i>
                        <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-[#F28F20] ring-2 ring-[#0075c2]"></span>
                    </a>
                </div>
            </header>

            <!-- HEADER GREETING -->
            <section class="relative z-10 flex items-end justify-between px-8 pb-20 pt-4 text-white">
                <div>
                    <p class="mb-2 text-xs font-medium text-blue-100">Selamat datang, {{ auth()->user()->name ?? 'Admin' }}</p>
                    <h1 class="text-2xl font-extrabold tracking-tight">Dashboard SINTESA</h1>
                    <p class="mt-1 text-xs text-blue-100/90">Pantau kondisi aset TI BPS Provinsi Sulawesi Tengah dalam satu tempat.</p>
                </div>

                <a href="{{ route('aset.index') }}" class="flex items-center gap-2.5 rounded-xl bg-[#F28F20] px-5 py-3.5 text-xs font-bold text-white shadow-[0_8px_20px_rgba(0,75,124,0.20)] transition hover:bg-orange-600 active:scale-95">
                    <i class="fa-solid fa-qrcode text-sm"></i> Generate QR Code
                </a>
            </section>

            <!-- KARTU STATISTIK -->
            <section class="relative z-20 -mt-10 grid grid-cols-4 gap-6 px-8">
                <!-- Total Aset -->
                <article class="flex items-center gap-5 rounded-2xl bg-white p-6 shadow-xl shadow-blue-900/10">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-[#0075c2] text-xl">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </span>
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase">Total Aset</p>
                        <p class="mt-1 text-2xl font-extrabold tracking-tight text-slate-800">{{ $total ?? 0 }}</p>
                        <p class="mt-0.5 text-[10px] font-medium text-slate-400">Terdaftar di sistem</p>
                    </div>
                </article>

                <!-- Kondisi Normal -->
                <article class="flex items-center gap-5 rounded-2xl bg-white p-6 shadow-xl shadow-blue-900/10">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 text-xl">
                        <i class="fa-solid fa-circle-check"></i>
                    </span>
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase">Kondisi Normal</p>
                        <p class="mt-1 text-2xl font-extrabold tracking-tight text-slate-800">{{ $normal ?? 0 }}</p>
                        <p class="mt-0.5 text-[10px] font-bold text-emerald-600">{{ $persen_normal ?? 0 }}% dari total</p>
                    </div>
                </article>

                <!-- Rusak Ringan -->
                <article class="flex items-center gap-5 rounded-2xl bg-white p-6 shadow-xl shadow-blue-900/10">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-orange-50 text-[#F28F20] text-xl">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </span>
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase">Rusak Ringan</p>
                        <p class="mt-1 text-2xl font-extrabold tracking-tight text-slate-800">{{ $rusak_ringan ?? 0 }}</p>
                        <p class="mt-0.5 text-[10px] font-medium text-amber-600">Perlu diperiksa</p>
                    </div>
                </article>

                <!-- Rusak Berat -->
                <article class="flex items-center gap-5 rounded-2xl bg-white p-6 shadow-xl shadow-blue-900/10">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-50 text-red-500 text-xl">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </span>
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase">Rusak Berat</p>
                        <p class="mt-1 text-2xl font-extrabold tracking-tight text-slate-800">{{ $rusak_berat ?? 0 }}</p>
                        <p class="mt-0.5 text-[10px] font-medium text-red-500">Butuh penanganan</p>
                    </div>
                </article>
            </section>

            <!-- BAGIAN GRAFIK & AKTIVITAS -->
            @php
                $dataMingguIni  = $chartMingguIni ?? [0, 0, 0, 0, 0, 0, 0];
                $dataMingguLalu = $chartMingguLalu ?? [0, 0, 0, 0, 0, 0, 0];
                $jmlIni         = $totalMingguIni ?? array_sum($dataMingguIni);
                $jmlLalu        = $totalMingguLalu ?? array_sum($dataMingguLalu);
                $hariIniIdx     = $todayIndex ?? (\Carbon\Carbon::now('Asia/Makassar')->dayOfWeekIso - 1);
                $maxIni         = max(array_merge($dataMingguIni, [1]));
                $namaHari       = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];

                if ($jmlLalu > 0) {
                    $selisih = round((($jmlIni - $jmlLalu) / $jmlLalu) * 100);
                    $badgePerbandingan = $selisih >= 0
                        ? ['text' => "+{$selisih}% dari minggu lalu", 'class' => 'bg-emerald-50 text-emerald-600']
                        : ['text' => "{$selisih}% dari minggu lalu", 'class' => 'bg-amber-50 text-amber-600'];
                } elseif ($jmlIni > 0) {
                    $badgePerbandingan = ['text' => 'Aktif minggu ini', 'class' => 'bg-blue-50 text-[#0075c2]'];
                } else {
                    $badgePerbandingan = ['text' => 'Belum ada perbandingan', 'class' => 'bg-slate-100 text-slate-500'];
                }
            @endphp

            <section class="relative z-10 mt-8 grid grid-cols-3 gap-6 px-8 pb-8">
                <!-- Grafik Intensitas Pengecekan -->
                <article class="col-span-2 flex flex-col justify-between rounded-2xl border border-slate-200/60 bg-white p-6 shadow-sm">
                    <div>
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-base font-extrabold tracking-tight text-slate-800">Intensitas Pengecekan</h2>
                                <p id="chart-subtitle" class="mt-1 text-[11px] text-slate-400">Jumlah aset yang diperiksa selama minggu ini</p>
                            </div>
                            <select id="chart-period-select" onchange="switchChartPeriod(this.value)" class="cursor-pointer rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs font-bold text-slate-600 outline-none focus:border-[#0075c2]">
                                <option value="this_week">Minggu ini</option>
                                <option value="last_week">Minggu lalu</option>
                            </select>
                        </div>

                        <div class="mt-5 flex items-end gap-3">
                            <span id="chart-total-count" class="text-3xl font-extrabold text-slate-800">{{ $jmlIni }}</span>
                            <span class="mb-1 text-xs text-slate-400">pengecekan dilakukan</span>
                            <span id="chart-comparison-badge" class="mb-1 ml-auto rounded-full px-3 py-1 text-[10px] font-extrabold {{ $badgePerbandingan['class'] }}">
                                {{ $badgePerbandingan['text'] }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <!-- Bar Chart Dinamis -->
                        <div class="relative mt-8 grid h-48 grid-cols-7 items-end gap-4 border-b border-slate-100 px-3 pb-2">
                            @foreach($dataMingguIni as $idx => $nilai)
                                @php
                                    $isToday = ($idx === $hariIniIdx);
                                    $tinggiPersen = $nilai > 0 ? max(18, round(($nilai / $maxIni) * 100)) : 10;
                                    if ($nilai > 0) {
                                        $barClass = $isToday
                                            ? 'bg-[#F28F20] shadow-md shadow-orange-500/20'
                                            : 'bg-[#0075c2] shadow-sm shadow-blue-500/15';
                                        $numClass = $isToday ? 'text-[#F28F20] font-extrabold' : 'text-[#0075c2] font-extrabold';
                                    } else {
                                        $barClass = $isToday ? 'bg-slate-200' : 'bg-slate-100';
                                        $numClass = $isToday ? 'text-slate-500 font-extrabold' : 'text-slate-400 font-bold';
                                    }
                                @endphp
                                <div id="chart-bar-{{ $idx }}" style="height: {{ $tinggiPersen }}%;" class="group relative rounded-t-lg {{ $barClass }} transition-all duration-300">
                                    <span id="chart-val-{{ $idx }}" class="absolute -top-6 inset-x-0 text-center text-[10px] {{ $numClass }}">{{ $nilai }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-3 grid grid-cols-7 text-center text-xs font-bold text-slate-400">
                            @foreach($namaHari as $idx => $hari)
                                <span id="chart-day-{{ $idx }}" class="{{ $idx === $hariIniIdx ? 'text-[#0075c2] font-extrabold' : '' }}">{{ $hari }}</span>
                            @endforeach
                        </div>
                    </div>
                </article>

                <!-- Aktivitas Terbaru -->
                <article class="col-span-1 flex flex-col rounded-2xl border border-slate-200/60 bg-white p-6 shadow-sm">
                    <h2 class="text-base font-extrabold tracking-tight text-slate-800 mb-1">Pengecekan Terbaru</h2>
                    <p class="text-[11px] text-slate-400 mb-5">Aktivitas terbaru tim lapangan</p>

                    @if(($aktivitasTerbaru ?? collect())->count() > 0)
                        <div class="space-y-3 flex-1">
                            @foreach($aktivitasTerbaru as $item)
                                @php
                                    $statusRaw = strtolower($item->status ?? '');
                                    $statusStyle = ['bg-slate-100 text-slate-600', 'bg-slate-50 text-slate-500', 'fa-circle-question'];
                                    if ($statusRaw === 'normal') {
                                        $statusStyle = ['bg-emerald-50 text-emerald-700 border border-emerald-100', 'bg-emerald-50 text-emerald-600', 'fa-circle-check'];
                                    } elseif ($statusRaw === 'rusak ringan') {
                                        $statusStyle = ['bg-orange-50 text-[#F28F20] border border-orange-100', 'bg-orange-50 text-[#F28F20]', 'fa-triangle-exclamation'];
                                    } elseif ($statusRaw === 'rusak berat') {
                                        $statusStyle = ['bg-red-50 text-red-600 border border-red-100', 'bg-red-50 text-red-500', 'fa-circle-xmark'];
                                    }

                                    $penggunaAset = $item->nama_pengguna ?? ($item->aset->nama_pengguna ?? null);
                                    $waktuCek = $item->created_at
                                        ? $item->created_at->copy()->timezone('Asia/Makassar')->format('d M, H:i') . ' WITA'
                                        : '-';
                                @endphp
                                <div class="rounded-xl border border-slate-100 bg-slate-50/70 p-3.5 transition hover:bg-white hover:shadow-sm">
                                    <div class="flex items-start justify-between gap-2">
                                        <div class="flex items-center gap-2.5 min-w-0">
                                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ $statusStyle[1] }} text-xs">
                                                <i class="fa-solid {{ $statusStyle[2] }}"></i>
                                            </span>
                                            <div class="min-w-0">
                                                <p class="truncate text-xs font-extrabold text-slate-800">
                                                    {{ $item->aset->nama_perangkat ?? 'Perangkat Tidak Ditemukan' }}
                                                </p>
                                                <p class="truncate text-[10px] font-medium text-slate-400">
                                                    NUP {{ $item->aset->nup ?? '-' }} · {{ $item->aset->ruangan->nama_ruangan ?? 'Ruangan belum diset' }}
                                                </p>
                                            </div>
                                        </div>
                                        <span class="shrink-0 rounded-full px-2 py-0.5 text-[9px] font-bold capitalize {{ $statusStyle[0] }}">
                                            {{ $item->status ?? '-' }}
                                        </span>
                                    </div>
                                    <div class="mt-2.5 flex items-center justify-between border-t border-slate-200/60 pt-2 text-[10px]">
                                        <span class="inline-flex items-center gap-1 font-bold text-[#0075c2] truncate max-w-[145px]">
                                            <i class="fa-solid fa-user text-[9px]"></i>
                                            {{ $penggunaAset ?: 'Belum ditentukan' }}
                                        </span>
                                        <span class="font-medium text-slate-400 shrink-0">{{ $waktuCek }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex-1 flex flex-col items-center justify-center">
                            <div class="text-center py-8">
                                <span class="flex h-12 w-12 mx-auto items-center justify-center rounded-full bg-slate-100 text-slate-400 text-lg mb-3">
                                    <i class="fa-solid fa-folder-open"></i>
                                </span>
                                <p class="text-xs font-bold text-slate-600">Belum ada aktivitas</p>
                                <p class="text-[10px] text-slate-400 mt-1">Lakukan scan atau pemeriksaan aset untuk melihat riwayat terbaru di sini.</p>
                            </div>
                        </div>
                    @endif

                    <a href="{{ route('admin.riwayat') }}" class="mt-5 flex items-center justify-center gap-2 rounded-xl bg-blue-50 py-3 text-xs font-bold text-[#0075c2] hover:bg-blue-100 transition-colors">
                        Lihat Semua Aktivitas <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </article>
            </section>

            <!-- FOOTER -->
            <footer class="relative z-10 flex items-center justify-between px-8 pb-6 text-xs text-slate-400 font-medium">
                <span>© 2026 SINTESA · BPS Provinsi Sulawesi Tengah</span>
                <span>Sistem Inventaris dan Pengecekan Aset TI</span>
            </footer>
        </div>
    </main>

    <script>
        const chartDatasets = {
            this_week: {
                subtitle: 'Jumlah aset yang diperiksa selama minggu ini',
                total: {{ $jmlIni }},
                values: @json($dataMingguIni),
                highlightToday: true,
                badgeText: @json($badgePerbandingan['text']),
                badgeClass: @json($badgePerbandingan['class'])
            },
            last_week: {
                subtitle: 'Jumlah aset yang diperiksa selama minggu lalu',
                total: {{ $jmlLalu }},
                values: @json($dataMingguLalu),
                highlightToday: false,
                badgeText: 'Rekap minggu sebelumnya',
                badgeClass: 'bg-slate-100 text-slate-600'
            }
        };
        const todayIdx = {{ $hariIniIdx }};

        function switchChartPeriod(period) {
            const data = chartDatasets[period];
            if (!data) return;

            document.getElementById('chart-subtitle').textContent = data.subtitle;
            document.getElementById('chart-total-count').textContent = data.total;

            const badgeEl = document.getElementById('chart-comparison-badge');
            badgeEl.textContent = data.badgeText;
            badgeEl.className = `mb-1 ml-auto rounded-full px-3 py-1 text-[10px] font-extrabold ${data.badgeClass}`;

            const maxVal = Math.max(...data.values, 1);

            data.values.forEach((val, idx) => {
                const bar = document.getElementById(`chart-bar-${idx}`);
                const labelVal = document.getElementById(`chart-val-${idx}`);
                const labelDay = document.getElementById(`chart-day-${idx}`);

                const isToday = data.highlightToday && idx === todayIdx;
                const heightPct = val > 0 ? Math.max(18, Math.round((val / maxVal) * 100)) : 10;

                bar.style.height = `${heightPct}%`;
                labelVal.textContent = val;

                if (val > 0) {
                    bar.className = isToday
                        ? 'group relative rounded-t-lg bg-[#F28F20] shadow-md shadow-orange-500/20 transition-all duration-300'
                        : 'group relative rounded-t-lg bg-[#0075c2] shadow-sm shadow-blue-500/15 transition-all duration-300';
                    labelVal.className = isToday
                        ? 'absolute -top-6 inset-x-0 text-center text-[10px] text-[#F28F20] font-extrabold'
                        : 'absolute -top-6 inset-x-0 text-center text-[10px] text-[#0075c2] font-extrabold';
                } else {
                    bar.className = isToday
                        ? 'group relative rounded-t-lg bg-slate-200 transition-all duration-300'
                        : 'group relative rounded-t-lg bg-slate-100 transition-all duration-300';
                    labelVal.className = isToday
                        ? 'absolute -top-6 inset-x-0 text-center text-[10px] text-slate-500 font-extrabold'
                        : 'absolute -top-6 inset-x-0 text-center text-[10px] text-slate-400 font-bold';
                }

                labelDay.className = isToday ? 'text-[#0075c2] font-extrabold' : '';
            });
        }
    </script>
</body>
</html>