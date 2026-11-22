<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SINTESA Petugas - Cek Kondisi Aset</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <style>
      body { font-family: "Plus Jakarta Sans", sans-serif; background-color: #f8fafc; }
      /* Sembunyikan radio button asli, kita pakai label sebagai tombol */
      input[type="radio"] { display: none; }
      
      /* Efek saat card dipilih */
      input[type="radio"]:checked + div {
          border-width: 2px;
      }
      #radio-normal:checked + div { border-color: #10b981; background-color: #ecfdf5; }
      #radio-ringan:checked + div { border-color: #f59e0b; background-color: #fffbeb; }
      #radio-berat:checked + div { border-color: #ef4444; background-color: #fef2f2; }
      
      /* Checklist icon muncul saat dipilih */
      .check-icon { display: none; }
      input[type="radio"]:checked + div .check-icon { display: block; }
    </style>
</head>
<body class="text-slate-800 antialiased">

    <!-- Kontainer khusus ukuran HP (Mobile Max-Width) -->
    <div class="mx-auto max-w-md bg-white min-h-screen relative pb-24 shadow-2xl">
        
        <!-- HEADER MOBILE -->
        <header class="sticky top-0 z-30 flex items-center gap-4 bg-[#0075c2] px-5 py-4 text-white shadow-md">
            <a href="javascript:history.back()" class="flex h-8 w-8 items-center justify-center rounded-full bg-white/20 hover:bg-white/30 transition">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-sm font-extrabold tracking-wide">Form Pengecekan</h1>
                <p class="text-[10px] text-blue-100 opacity-90">SINTESA Mobile</p>
            </div>
        </header>

        <!-- KONTEN UTAMA -->
        <main class="px-5 pt-6">
            <!-- Kartu Info Aset & Pengguna yang di-scan -->
            <div class="mb-8 rounded-2xl border border-slate-100 bg-slate-50 p-4 shadow-sm">
                <div class="flex items-start gap-3.5">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#0075c2] text-white">
                        <i class="fa-solid fa-server text-xl"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">{{ $aset->kategori ?? 'Inventaris TI' }}</span>
                        <h2 class="text-sm font-extrabold text-slate-800 truncate">{{ $aset->nama_perangkat ?? 'Perangkat Ditemukan!' }}</h2>
                        <p class="mt-0.5 font-mono text-[11px] font-bold text-slate-500">{{ $aset->kode_qr ?? '-' }}</p>
                    </div>
                </div>
                <div class="mt-3.5 pt-3 border-t border-slate-200/70 flex flex-wrap items-center justify-between gap-2 text-[11px]">
                    <span class="inline-flex items-center gap-1.5 font-medium text-slate-500">
                        <i class="fa-solid fa-location-dot text-slate-400"></i>
                        {{ $aset->ruangan->nama_ruangan ?? 'Ruangan belum diatur' }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-2.5 py-1 font-bold text-[#0075c2] border border-blue-100">
                        <i class="fa-solid fa-user text-[10px]"></i>
                        {{ $aset->nama_pengguna ?? 'Pengguna belum ditentukan' }}
                    </span>
                </div>
            </div>

            <!-- FORM PENGECEKAN -->
            <form action="{{ route('aset.update_kondisi', $aset->id) }}" method="POST">
                @csrf
                
                <h3 class="mb-3 text-xs font-extrabold text-slate-800">Bagaimana kondisi perangkat saat ini? <span class="text-red-500">*</span></h3>
                
                <!-- 3 PILIHAN KONDISI (SESUAI ATURAN PUSAT) -->
                <div class="space-y-3 mb-8">
                    
                    <!-- Pilihan 1: NORMAL -->
                    <label class="block cursor-pointer">
                        <input type="radio" name="kondisi" id="radio-normal" value="Normal" required>
                        <div class="relative flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 transition-all">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                                <i class="fa-solid fa-face-smile"></i>
                            </span>
                            <div class="flex-1">
                                <h4 class="text-sm font-extrabold text-slate-800">Normal</h4>
                                <p class="text-[10px] font-medium text-slate-500">Berfungsi baik, tidak ada kendala.</p>
                            </div>
                            <i class="fa-solid fa-circle-check check-icon absolute right-4 text-emerald-500 text-lg"></i>
                        </div>
                    </label>

                    <!-- Pilihan 2: RUSAK RINGAN -->
                    <label class="block cursor-pointer">
                        <input type="radio" name="kondisi" id="radio-ringan" value="Rusak Ringan">
                        <div class="relative flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 transition-all">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-orange-100 text-[#F28F20]">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </span>
                            <div class="flex-1">
                                <h4 class="text-sm font-extrabold text-slate-800">Rusak Ringan</h4>
                                <p class="text-[10px] font-medium text-slate-500">Bisa dipakai, tapi butuh perbaikan kecil.</p>
                            </div>
                            <i class="fa-solid fa-circle-check check-icon absolute right-4 text-[#F28F20] text-lg"></i>
                        </div>
                    </label>

                    <!-- Pilihan 3: RUSAK BERAT -->
                    <label class="block cursor-pointer">
                        <input type="radio" name="kondisi" id="radio-berat" value="Rusak Berat">
                        <div class="relative flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 transition-all">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-500">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </span>
                            <div class="flex-1">
                                <h4 class="text-sm font-extrabold text-slate-800">Rusak Berat</h4>
                                <p class="text-[10px] font-medium text-slate-500">Mati total atau tidak bisa digunakan sama sekali.</p>
                            </div>
                            <i class="fa-solid fa-circle-check check-icon absolute right-4 text-red-500 text-lg"></i>
                        </div>
                    </label>

                </div>

                <!-- Input Catatan Tambahan -->
                <div class="mb-6">
                    <h3 class="mb-2 text-xs font-extrabold text-slate-800">Catatan / Tindakan (Opsional)</h3>
                    <textarea name="catatan" rows="3" placeholder="Contoh: Kabel power sedikit terkelupas..." class="w-full rounded-xl border border-slate-200 bg-slate-50 p-4 text-xs font-medium text-slate-700 outline-none transition focus:border-[#0075c2] focus:bg-white focus:ring-2 focus:ring-[#0075c2]/20"></textarea>
                </div>

                <!-- TOMBOL KIRIM -->
                <div class="fixed bottom-0 left-0 right-0 z-40 mx-auto max-w-md border-t border-slate-100 bg-white p-4 shadow-[0_-4px_20px_rgba(0,0,0,0.05)]">
                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#0075c2] py-3.5 text-sm font-extrabold text-white shadow-lg shadow-blue-500/30 transition hover:bg-[#005891] active:scale-[0.98]">
                        <i class="fa-solid fa-paper-plane text-xs"></i>
                        Kirim Hasil Pengecekan
                    </button>
                </div>

            </form>
        </main>
    </div>

</body>
</html>