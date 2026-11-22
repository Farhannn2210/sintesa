<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTESA Admin - Master Aset</title>
    
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

      dialog::backdrop {
        background: rgb(15 23 42 / 0.5);
        backdrop-filter: blur(4px);
      }
      dialog[open] {
        animation: modal-enter 180ms ease-out;
      }
      @keyframes modal-enter {
        from { opacity: 0; transform: translateY(8px) scale(0.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
      }
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

            <header class="relative z-10 flex h-20 items-center justify-end px-8 text-white">
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
                <h1 class="text-2xl font-extrabold tracking-tight">Data Master Aset</h1>
                <p class="mt-2 text-xs leading-relaxed text-blue-100/90">Kelola, pantau, dan tambah inventaris TI BPS.</p>
            </section>

            <section class="relative z-20 -mt-12 flex h-[calc(100vh-180px)] min-h-[420px] flex-col px-8 pb-8">
                
                @if(session('success'))
                    <div class="mb-4 flex items-center justify-between gap-3 rounded-xl bg-emerald-50 px-4 py-3 border border-emerald-100">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-circle-check text-emerald-500"></i>
                            <p class="text-xs font-bold text-emerald-800">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <div class="flex h-full flex-col overflow-hidden rounded-2xl bg-white shadow-xl shadow-blue-900/10 border border-slate-100">
                    
                    <div class="flex shrink-0 items-center justify-between gap-4 border-b border-slate-100 p-5">
                        <!-- FITUR SEARCH & FILTER -->
                        <form action="{{ route('aset.index') }}" method="GET" class="flex items-center gap-3">
                            <!-- Kotak Pencarian -->
                            <label class="flex h-11 w-72 items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 transition focus-within:border-[#0075c2] focus-within:ring-2 focus-within:ring-blue-100">
                                <i class="fa-solid fa-magnifying-glass text-xs text-slate-400"></i>
                                <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari aset, NUP, atau pengguna..." class="min-w-0 flex-1 border-0 bg-transparent text-xs font-semibold text-slate-700 outline-none placeholder:text-slate-400" />
                            </label>
                            
                            <!-- Dropdown Filter Kategori -->
                            <div class="relative">
                                <select name="kategori" onchange="this.form.submit()" class="flex h-11 appearance-none items-center gap-2 rounded-xl border border-slate-200 bg-white pl-10 pr-8 text-xs font-bold text-slate-600 hover:bg-slate-50 focus:border-[#0075c2] focus:outline-none focus:ring-2 focus:ring-blue-100 cursor-pointer">
                                    <option value="">Semua Kategori</option>
                                    <option value="Laptop" {{ request('kategori') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                                    <option value="PC" {{ request('kategori') == 'PC' ? 'selected' : '' }}>PC Workstation</option>
                                    <option value="Monitor" {{ request('kategori') == 'Monitor' ? 'selected' : '' }}>Monitor / Smart TV</option>
                                    <option value="Printer" {{ request('kategori') == 'Printer' ? 'selected' : '' }}>Printer / Scanner</option>
                                    <option value="UPS" {{ request('kategori') == 'UPS' ? 'selected' : '' }}>UPS</option>
                                    <option value="Jaringan" {{ request('kategori') == 'Jaringan' ? 'selected' : '' }}>Jaringan</option>
                                    <option value="Meja" {{ request('kategori') == 'Meja' ? 'selected' : '' }}>Meja</option>
                                    <option value="Kursi" {{ request('kategori') == 'Kursi' ? 'selected' : '' }}>Kursi</option>
                                </select>
                                <i class="fa-solid fa-sliders text-sm text-slate-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                <i class="fa-solid fa-chevron-down text-xs text-slate-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            </div>

                            <span class="ml-1 text-[11px] font-medium text-slate-400">Total: {{ $asets->count() }} aset</span>
                            
                            <!-- Tombol Reset akan otomatis muncul jika sedang mencari sesuatu -->
                            @if(request('search') || request('kategori'))
                                <a href="{{ route('aset.index') }}" class="text-xs text-red-500 hover:text-red-700 font-bold ml-2 underline">Reset</a>
                            @endif

                            <!-- Tombol Submit disembunyikan (Bisa pakai Enter saja di keyboard) -->
                            <button type="submit" class="hidden"></button>
                        </form>
                        
                        <a href="{{ route('aset.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-[#F28F20] px-5 py-2.5 text-xs font-bold text-white shadow-[0_8px_20px_rgba(242,143,32,0.25)] transition hover:bg-orange-600 active:scale-95">
                            <i class="fa-solid fa-plus"></i> Tambah Aset Baru
                        </a>
                    </div>

                    <div class="table-scroll min-h-0 flex-1 overflow-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="sticky top-0 z-10 border-b border-slate-100 bg-slate-50 text-[11px] font-extrabold uppercase tracking-widest text-slate-400">
                                <tr>
                                    <th class="px-6 py-4">Kode QR/NUP</th>
                                    <th class="px-5 py-4">Nama Perangkat</th>
                                    <th class="px-5 py-4">Kategori</th>
                                    <th class="px-5 py-4">Lokasi Ruangan</th>
                                    <th class="px-5 py-4">Pengguna</th>
                                    <th class="px-5 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($asets as $aset)
                                    <tr class="transition-colors hover:bg-blue-50/30">
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <span class="block font-mono text-xs font-bold text-slate-500">{{ $aset->kode_qr }}</span>
                                            <span class="block text-[9px] font-semibold text-slate-400 mt-0.5">NUP: {{ $aset->nup ?? '-' }}</span>
                                        </td>
                                        <td class="px-5 py-4">
                                            <span class="block whitespace-nowrap text-xs font-extrabold text-slate-800">{{ $aset->nama_perangkat }}</span>
                                            <span class="mt-1 block text-[10px] font-medium text-slate-400 w-44 truncate">{{ $aset->spesifikasi ?? 'Tidak ada deskripsi' }}</span>
                                        </td>
                                        <td class="px-5 py-4">
                                            @php
                                                $badgeColor = match(strtolower($aset->kategori)) {
                                                    'ups' => 'bg-purple-100 text-purple-700 border-purple-200',
                                                    'laptop' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                    'pc' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                                    'printer', 'printer / scanner' => 'bg-amber-100 text-amber-700 border-amber-200',
                                                    'jaringan' => 'bg-violet-100 text-violet-700 border-violet-200',
                                                    'monitor', 'smart tv' => 'bg-teal-100 text-teal-700 border-teal-200',
                                                    'meja' => 'bg-orange-100 text-orange-700 border-orange-200',
                                                    'kursi' => 'bg-rose-100 text-rose-700 border-rose-200',
                                                    default => 'bg-slate-100 text-slate-700 border-slate-200',
                                                };
                                            @endphp

                                            <span class="inline-flex items-center rounded-lg border px-2.5 py-1 text-[11px] font-bold {{ $badgeColor }}">
                                                {{ $aset->kategori }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-5 py-4 text-xs font-bold text-slate-600">
                                            {{ $aset->ruangan->nama_ruangan ?? 'Belum diset' }}
                                        </td>
                                        <td class="whitespace-nowrap px-5 py-4">
                                            @if($aset->nama_pengguna)
                                                <div class="inline-flex items-center gap-2 rounded-lg border border-slate-200/80 bg-slate-50 px-2.5 py-1">
                                                    <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#0075c2]/10 text-[#0075c2]">
                                                        <i class="fa-solid fa-user text-[9px]"></i>
                                                    </span>
                                                    <span class="text-xs font-bold text-slate-700">{{ $aset->nama_pengguna }}</span>
                                                </div>
                                            @else
                                                <span class="text-[11px] font-medium italic text-slate-400">Belum ditentukan</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4">
                                            @php
                                                $kondisi = strtolower($aset->kondisi ?? 'belum dicek');
                                                $badgeKondisi = ['bg-slate-50 text-slate-500 border border-slate-200', 'fa-circle-question'];
                                                
                                                // Aturan baku dari Pusat BPS
                                                if($kondisi == 'normal') {
                                                    $badgeKondisi = ['bg-emerald-50 text-emerald-700 border border-emerald-100', 'fa-circle-check'];
                                                } elseif($kondisi == 'rusak ringan') {
                                                    $badgeKondisi = ['bg-orange-50 text-orange-700 border border-orange-100', 'fa-triangle-exclamation'];
                                                } elseif($kondisi == 'rusak berat') {
                                                    $badgeKondisi = ['bg-red-50 text-red-700 border border-red-100', 'fa-circle-xmark'];
                                                }
                                            @endphp
                                            <span class="inline-flex items-center gap-1.5 rounded-full {{ $badgeKondisi[0] }} px-2.5 py-1 text-[10px] font-bold capitalize">
                                                <i class="fa-solid {{ $badgeKondisi[1] }}"></i> {{ $kondisi }}
                                            </span>
                                        </td>
                                        
                                        <!-- TOMBOL AKSI -->
                                        <td class="px-6 py-4">
                                            <div class="flex justify-end gap-1">
                                                <button type="button" data-open-modal="qr-modal-{{ $aset->id }}" class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition" title="Lihat QR">
                                                    <i class="fa-solid fa-qrcode"></i>
                                                </button>
                                                <a href="{{ route('aset.edit', $aset->id) }}" class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-blue-50 hover:text-[#0075c2] transition" title="Edit Aset">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <button type="button" data-open-modal="delete-modal-{{ $aset->id }}" class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-red-50 hover:text-red-600 transition" title="Hapus Aset">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- MODAL QR KHUSUS UNTUK ASET INI -->
                                    <dialog id="qr-modal-{{ $aset->id }}" class="fixed inset-0 z-50 m-auto w-80 max-w-[calc(100%-32px)] overflow-visible rounded-2xl bg-white p-6 text-center text-slate-800 shadow-2xl">
                                        <button type="button" data-close-modal class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full text-slate-400 hover:bg-slate-100 transition">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                        <h2 class="mt-1 text-base font-extrabold tracking-tight">QR Code Aset</h2>
                                        <p class="mt-1.5 text-[11px] font-medium text-slate-400">Cetak dan tempelkan pada perangkat.</p>
                                        
                                        <div class="mx-auto mt-6 flex aspect-square w-52 flex-col items-center justify-center p-3 rounded-2xl border-2 border-dashed border-slate-200 bg-white">
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ $aset->kode_qr }}" alt="QR Code" class="w-full h-full object-contain mix-blend-multiply">
                                        </div>

                                        <p class="mt-5 text-sm font-extrabold text-slate-800">{{ $aset->nama_perangkat }}</p>
                                        <p class="mt-1 font-mono text-[11px] font-bold text-slate-500">{{ $aset->kode_qr }}</p>
                                        @if($aset->nama_pengguna)
                                            <p class="mt-1 mb-4 text-[11px] font-semibold text-[#0075c2]">Pengguna: {{ $aset->nama_pengguna }}</p>
                                        @else
                                            <div class="mb-4"></div>
                                        @endif
                                        
                                        <button type="button" onclick="window.print()" class="w-full rounded-xl bg-[#F28F20] px-5 py-3 text-xs font-bold text-white shadow-lg shadow-[#F28F20]/30 transition hover:bg-[#e0801a] flex items-center justify-center gap-2">
                                            <i class="fa-solid fa-print"></i> Cetak QR
                                        </button>
                                    </dialog>

                                    <!-- MODAL HAPUS KHUSUS UNTUK ASET INI -->
                                    <dialog id="delete-modal-{{ $aset->id }}" class="fixed inset-0 z-50 m-auto w-96 max-w-[calc(100%-32px)] overflow-visible rounded-2xl bg-white p-6 text-center text-slate-800 shadow-2xl">
                                        <div class="mx-auto mt-2 flex h-16 w-16 items-center justify-center rounded-full bg-red-50 ring-8 ring-red-50/50">
                                            <i class="fa-regular fa-trash-can text-2xl text-red-500"></i>
                                        </div>
                                        <h2 class="mt-6 text-lg font-extrabold tracking-tight">Hapus Aset Ini?</h2>
                                        <p class="mt-3 text-xs leading-6 text-slate-500 font-medium">Data <span class="font-bold text-slate-700">{{ $aset->nama_perangkat }}</span> akan dihapus permanen. Anda yakin?</p>
                                        
                                        <div class="mt-8 flex gap-3">
                                            <button type="button" data-close-modal class="w-full rounded-xl bg-slate-100 py-3.5 text-xs font-extrabold text-slate-600 transition hover:bg-slate-200">
                                                Batal
                                            </button>
                                            <form action="{{ route('aset.destroy', $aset->id) }}" method="POST" class="w-full">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full rounded-xl bg-red-600 py-3.5 text-xs font-extrabold text-white shadow-lg shadow-red-500/20 transition hover:bg-red-700 active:scale-95">
                                                    Ya, Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </dialog>

                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="h-16 w-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                                    <i class="fa-solid fa-box-open text-3xl text-slate-300"></i>
                                                </div>
                                                <p class="text-sm font-extrabold text-slate-700">Belum Ada Data Aset</p>
                                                <p class="text-[11px] font-medium text-slate-400 mt-1 max-w-sm">Anda belum menambahkan perangkat inventaris apapun.</p>
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

    <script>
        document.querySelectorAll("[data-open-modal]").forEach((button) => {
            button.addEventListener("click", () => {
                document.getElementById(button.dataset.openModal).showModal();
            });
        });

        document.querySelectorAll("[data-close-modal]").forEach((button) => {
            button.addEventListener("click", () => {
                button.closest("dialog").close();
            });
        });

        document.querySelectorAll("dialog").forEach((dialog) => {
            dialog.addEventListener("click", (event) => {
                const bounds = dialog.getBoundingClientRect();
                const outside = event.clientX < bounds.left || event.clientX > bounds.right || event.clientY < bounds.top || event.clientY > bounds.bottom;
                if (event.target === dialog && outside) { dialog.close(); }
            });
        });
    </script>
</body>
</html>