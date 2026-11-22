<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTESA Admin - Edit Aset</title>
    
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
    </style>
</head>
<body class="bg-[#F1F5F9] text-slate-800 flex h-screen overflow-hidden antialiased">

    <!-- SIDEBAR KIRI -->
    <aside class="flex w-64 shrink-0 flex-col bg-[#004b7c] text-white shadow-2xl z-20">
        <a href="/admin/dashboard" class="flex items-center gap-3 px-6 pb-8 pt-8">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#F28F20] shadow-[0_6px_20px_rgba(242,143,32,0.20)]">
                <i class="fa-solid fa-boxes-stacked text-white text-lg"></i>
            </span>
            <span>
                <span class="block text-xl font-extrabold tracking-wide">SINTESA</span>
                <span class="mt-1 block text-[10px] font-medium text-blue-200/70">BPS Prov. Sulteng</span>
            </span>
        </a>

        <p class="mb-3 px-7 text-[10px] font-bold uppercase tracking-[0.18em] text-blue-200/50">Menu Utama</p>

        <nav class="space-y-2 pr-4">
            <a href="/admin/dashboard" class="flex items-center gap-3 rounded-r-xl border-l-4 border-transparent py-3.5 pl-5 pr-4 text-sm font-medium text-blue-100/75 transition hover:bg-white/5 hover:text-white">
                <i class="fa-solid fa-chart-pie w-5 text-center"></i> Dashboard
            </a>
            <a href="{{ route('aset.index') }}" aria-current="true" class="flex items-center gap-3 rounded-r-xl border-l-4 border-[#F28F20] bg-white/10 py-3.5 pl-5 pr-4 text-sm font-bold text-white">
                <i class="fa-solid fa-desktop w-5 text-center text-[#F28F20]"></i> Master Aset
            </a>
            <a href="{{ route('admin.denah') }}" class="flex items-center gap-3 rounded-r-xl border-l-4 border-transparent py-3.5 pl-5 pr-4 text-sm font-medium text-blue-100/75 transition hover:bg-white/5 hover:text-white">
                <i class="fa-solid fa-map-location-dot w-5 text-center"></i> Denah Ruangan
            </a>
            <a href="{{ route('admin.riwayat') }}" class="flex items-center gap-3 rounded-r-xl border-l-4 border-transparent py-3.5 pl-5 pr-4 text-sm font-medium text-blue-100/75 transition hover:bg-white/5 hover:text-white">
                <i class="fa-solid fa-file-invoice w-5 text-center"></i> Riwayat & Laporan
            </a>
        </nav>
    </aside>

    <!-- KONTEN UTAMA KANAN -->
    <main class="relative min-w-0 flex-1 overflow-y-auto">
        <div class="relative min-h-full">
            
            <div class="absolute left-0 top-0 z-0 h-64 w-full bg-[#0075c2]" aria-hidden="true"></div>

            <header class="relative z-10 flex h-20 items-center justify-between gap-4 px-8 text-white">
                <a href="{{ route('aset.index') }}" class="-ml-3 inline-flex items-center gap-2 rounded-xl px-3 py-2.5 text-xs font-bold transition hover:bg-white/10">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <div class="flex items-center gap-3 text-[11px] text-blue-100/80">
                    <a href="{{ route('aset.index') }}" class="transition hover:text-white">Master Aset</a>
                    <i class="fa-solid fa-chevron-right text-[8px]"></i>
                    <span class="font-semibold text-white">Edit Aset</span>
                </div>
            </header>

            <section class="relative z-10 flex items-end justify-between px-8 pb-16 pt-4 text-white">
                <div>
                    <p class="mb-2 text-[10px] font-bold uppercase tracking-[0.16em] text-blue-200">Manajemen Inventaris</p>
                    <h1 class="text-2xl font-extrabold tracking-tight">Form Edit Aset</h1>
                    <p class="mt-2 text-xs leading-relaxed text-blue-100/90">Perbarui informasi perangkat TI BPS yang sudah terdaftar.</p>
                </div>
                <div class="flex items-center gap-3 bg-white/10 px-4 py-2.5 rounded-xl border border-white/20">
                    <i class="fa-solid fa-qrcode text-white"></i>
                    <div>
                        <p class="text-[10px] text-blue-200">Kode QR Terdaftar</p>
                        <p class="text-xs font-bold font-mono text-white">{{ $aset->kode_qr }}</p>
                    </div>
                </div>
            </section>

            <!-- FORM EDIT (OVERLAPPING) -->
            <div class="relative z-20 -mt-12 px-8 pb-10">
                <form action="{{ route('aset.update', $aset->id) }}" method="POST" class="rounded-2xl bg-white p-8 shadow-xl shadow-blue-900/10 border border-slate-100">
                    
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-8 flex items-center justify-between gap-4 border-b border-slate-100 pb-5">
                        <div class="flex items-center gap-3">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                <i class="fa-solid fa-pen-to-square text-lg"></i>
                            </span>
                            <div>
                                <h2 class="text-base font-extrabold text-slate-800">Ubah Informasi Aset</h2>
                                <p class="mt-1 text-[11px] text-slate-400">Pastikan data yang diubah sesuai dengan kondisi fisik saat ini.</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="mb-2.5 block text-xs font-extrabold text-slate-600">NUP / Kode Barang <span class="text-[#F28F20]">*</span></label>
                            <input type="text" name="nup" value="{{ old('nup', $aset->nup) }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-mono text-sm font-bold text-slate-800 outline-none transition focus:border-[#0075c2] focus:bg-white focus:ring-4 focus:ring-[#0075c2]/10" />
                        </div>

                        <div>
                            <label class="mb-2.5 block text-xs font-extrabold text-slate-600">Nama Perangkat <span class="text-[#F28F20]">*</span></label>
                            <input type="text" name="nama_perangkat" value="{{ old('nama_perangkat', $aset->nama_perangkat) }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm font-bold text-slate-800 outline-none transition focus:border-[#0075c2] focus:bg-white focus:ring-4 focus:ring-[#0075c2]/10" />
                        </div>

                        <div>
                            <label class="mb-2.5 block text-xs font-extrabold text-slate-600">Kategori Perangkat <span class="text-[#F28F20]">*</span></label>
                            <div class="relative">
                                @php $kat = old('kategori', $aset->kategori); @endphp
                                <select name="kategori" required class="w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 pr-10 text-sm font-bold text-slate-800 outline-none transition focus:border-[#0075c2] focus:bg-white focus:ring-4 focus:ring-[#0075c2]/10">
                                    <option value="">Pilih Kategori...</option>
                                    <option value="UPS" {{ $kat == 'UPS' ? 'selected' : '' }}>UPS (Uninterruptible Power Supply)</option>
                                    <option value="PC" {{ $kat == 'PC' ? 'selected' : '' }}>PC / Komputer Desktop</option>
                                    <option value="Laptop" {{ $kat == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                                    <option value="Printer" {{ $kat == 'Printer' ? 'selected' : '' }}>Printer / Scanner</option>
                                    <option value="Jaringan" {{ $kat == 'Jaringan' ? 'selected' : '' }}>Perangkat Jaringan (Switch/Router)</option>
                                    <option value="Monitor" {{ $kat == 'Monitor' ? 'selected' : '' }}>Monitor / Layar</option>
                                    <option value="Smart TV" {{ $kat == 'Smart TV' ? 'selected' : '' }}>Smart TV / Display Presentasi</option>
                                    <option value="Meja" {{ $kat == 'Meja' ? 'selected' : '' }}>Meja Kerja / Kantor</option>
                                    <option value="Kursi" {{ $kat == 'Kursi' ? 'selected' : '' }}>Kursi Kerja / Kantor</option>
                                    <option value="Lainnya" {{ $kat == 'Lainnya' ? 'selected' : '' }}>Inventaris / Fasilitas Lainnya</option>
                                </select>
                                <i class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                            </div>
                        </div>

                        <div>
                            <label class="mb-2.5 block text-xs font-extrabold text-slate-600">Lokasi Penempatan Ruangan <span class="text-[#F28F20]">*</span></label>
                            <div class="relative">
                                <select name="ruangan_id" required class="w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 pr-10 text-sm font-bold text-slate-800 outline-none transition focus:border-[#0075c2] focus:bg-white focus:ring-4 focus:ring-[#0075c2]/10">
                                    @foreach($ruangans as $ruangan)
                                        <option value="{{ $ruangan->id }}" {{ $aset->ruangan_id == $ruangan->id ? 'selected' : '' }}>
                                            {{ $ruangan->nama_ruangan }}
                                        </option>
                                    @endforeach
                                </select>
                                <i class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                            </div>
                        </div>

                        <!-- Pengguna / Penanggung Jawab Aset (BARU) -->
                        <div class="md:col-span-2">
                            <label class="mb-2.5 block text-xs font-extrabold text-slate-600">Pengguna / Penanggung Jawab Aset <span class="ml-1 font-medium text-slate-400">(Isi nama pegawai atau tim pemegang)</span></label>
                            <div class="relative">
                                <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                    <i class="fa-solid fa-user-tag text-sm"></i>
                                </span>
                                <input type="text" name="nama_pengguna" value="{{ old('nama_pengguna', $aset->nama_pengguna) }}" placeholder="Contoh: Muh. Farhan (atau Tim IPDS jika digunakan bersama)" class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-11 pr-4 text-sm font-bold text-slate-800 outline-none transition placeholder:font-medium placeholder:text-slate-400 focus:border-[#0075c2] focus:bg-white focus:ring-4 focus:ring-[#0075c2]/10" />
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2.5 block text-xs font-extrabold text-slate-600">Spesifikasi Detail <span class="ml-1 font-medium text-slate-400">(Opsional)</span></label>
                            <textarea name="spesifikasi" rows="4" class="w-full resize-y rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm font-medium leading-relaxed text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-[#0075c2] focus:bg-white focus:ring-4 focus:ring-[#0075c2]/10">{{ old('spesifikasi', $aset->spesifikasi) }}</textarea>
                        </div>
                    </div>

                    <div class="mt-10 flex flex-wrap items-center justify-end gap-4 border-t border-slate-100 pt-6">
                        <a href="{{ route('aset.index') }}" class="rounded-xl px-6 py-3.5 text-xs font-extrabold text-slate-500 transition hover:bg-slate-100 hover:text-slate-800">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-8 py-3.5 text-xs font-extrabold text-white shadow-[0_8px_20px_rgba(5,150,105,0.22)] transition hover:bg-emerald-700 active:scale-95">
                            <i class="fa-solid fa-check text-sm"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </main>

</body>
</html>