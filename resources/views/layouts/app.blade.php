<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SINTESA - BPS Sulteng' }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <!-- SIDEBAR SINTESA -->
    <aside class="w-64 bg-[#005891] text-white flex flex-col shadow-xl z-20 shrink-0">
        <div class="h-20 flex items-center px-6 border-b border-white/10 gap-3">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center p-1.5 shadow-md">
                <i class="fa-solid fa-boxes-stacked text-[#005891] text-xl"></i>
            </div>
            <div>
                <h1 class="text-lg font-extrabold tracking-wide">SINTESA</h1>
                <p class="text-[10px] text-blue-200 font-medium">Aset TI & Monitoring IPDS</p>
            </div>
        </div>

        <nav class="flex-1 py-4 space-y-1.5 px-3">
            <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-2.5 {{ request()->is('/') ? 'bg-white/10 text-white font-semibold' : 'text-blue-100 hover:bg-white/10 font-medium' }} rounded-xl text-sm transition">
                <i class="fa-solid fa-chart-pie w-5 text-center"></i> Dashboard
            </a>
            <a href="{{ route('aset.index') }}" class="flex items-center gap-3 px-4 py-2.5 {{ request()->is('aset*') ? 'bg-white/10 text-white font-semibold' : 'text-blue-100 hover:bg-white/10 font-medium' }} rounded-xl text-sm transition">
                <i class="fa-solid fa-desktop w-5 text-center"></i> Master Aset
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-blue-100 hover:bg-white/10 rounded-xl font-medium text-sm transition">
                <i class="fa-solid fa-map-location-dot w-5 text-center"></i> Denah Ruangan
            </a>
            <a href="/admin/riwayat" class="flex items-center gap-3 px-4 py-2.5 text-blue-100 hover:bg-white/10 rounded-xl font-medium text-sm transition">
                <i class="fa-solid fa-file-waveform w-5 text-center"></i> Riwayat & Laporan
            </a>
        </nav>

        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3 text-xs text-blue-200">
                <i class="fa-solid fa-building-columns"></i> BPS Prov. Sulteng
            </div>
        </div>
    </aside>

    <!-- CONTENT AREA -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8">
            <h2 class="text-base font-bold text-slate-700">Sistem INventarisasi TEknologi & Sentral Aset</h2>
            <span class="text-xs font-semibold bg-blue-50 text-[#005891] px-3 py-1 rounded-full border border-blue-100">IPDS Area</span>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </div>
    </main>

</body>
</html>