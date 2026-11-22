<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SINTESA Petugas - Cek Kondisi</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
    body {
        font-family: "Plus Jakarta Sans", sans-serif;
    }
    input[type="number"] {
        appearance: textfield;
        -moz-appearance: textfield;
    }
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        margin: 0;
        -webkit-appearance: none;
    }
    </style>
</head>
<body class="bg-slate-50 antialiased text-slate-800">

    @php
        // Deteksi otomatis: Apakah ini UPS atau PC berdasarkan kode QR
        $qrCode = request('qr', 'Belum Terdeteksi');
        $isUps = Str::contains($qrCode, 'UPS', true);
    @endphp

    <main class="mx-auto max-w-md bg-[#f8fafc] min-h-screen relative pb-32 shadow-2xl flex flex-col">
        
        <!-- HEADER -->
        <header class="bg-gradient-to-b from-[#004b7c] to-[#0075c2] rounded-b-[2.5rem] px-5 pb-16 pt-6 text-white shadow-lg">
            <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-xs font-bold text-blue-100 hover:text-white transition mb-6">
                <i class="fa-solid fa-arrow-left"></i> Batal / Kembali
            </a>
            <div>
                <h1 class="text-xl font-extrabold tracking-tight">
                    {{ $isUps ? 'Cek Kondisi UPS' : 'Cek Kondisi Perangkat' }}
                </h1>
                <p class="mt-1.5 text-xs text-blue-100/85">
                    Isi parameter dengan akurat
                </p>
            </div>
        </header>

        <!-- KARTU TARGET PENGECEKAN -->
        <div class="relative z-40 -mt-6 px-5">
            <section class="flex items-center gap-4 rounded-3xl border border-white bg-white p-5 shadow-xl shadow-blue-900/10">
                <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100/60 text-[#0075c2]">
                    <i class="fa-solid {{ $isUps ? 'fa-server' : 'fa-desktop' }} text-2xl"></i>
                </span>
                <div class="min-w-0 flex-1">
                    <p class="text-[9px] font-extrabold uppercase tracking-[0.16em] text-slate-400">Target Pengecekan</p>
                    <h2 class="mt-1.5 text-base font-extrabold tracking-tight">
                        {{ $isUps ? 'UPS Ruangan' : 'Perangkat TI' }}
                    </h2>
                    <p class="mt-1.5 flex items-center gap-1.5 text-[10px] text-slate-400">
                        <i class="fa-solid fa-qrcode text-[#0075c2]/70"></i>
                        <span class="font-mono font-bold">{{ $qrCode }}</span>
                    </p>
                </div>
            </section>
        </div>

        <!-- FORM UTAMA -->
        <!-- DIREVISI: Hapus form ganda dan arahkan langsung ke route yang benar -->
        <form id="inspection-form" action="{{ route('pengecekan.store') }}" method="POST" class="mt-7 space-y-6 px-5"> 
            @csrf
            <input type="hidden" name="kode_aset" value="{{ $qrCode }}" />

            <!-- PILIHAN STATUS -->
            <fieldset>
                <legend class="mb-3 text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-500">Status Perangkat *</legend>
                <div class="grid grid-cols-3 gap-2.5">
                    
                    <!-- NORMAL -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="kondisi" value="normal" required class="peer sr-only" />
                        <span class="flex min-h-24 flex-col items-center justify-center gap-2 rounded-2xl border border-emerald-100/70 bg-emerald-50/40 text-emerald-600 transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:shadow-[0_6px_18px_-6px_rgba(16,185,129,0.25)]">
                            <i class="fa-regular fa-circle-check text-xl"></i>
                            <span class="text-[11px] text-center font-bold">Normal</span>
                        </span>
                        <span class="absolute right-2 top-2 flex h-3.5 w-3.5 items-center justify-center rounded-full bg-emerald-500 text-[7px] text-white opacity-0 transition peer-checked:opacity-100"><i class="fa-solid fa-check"></i></span>
                    </label>

                    <!-- RUSAK RINGAN -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="kondisi" value="rusak ringan" class="peer sr-only" />
                        <span class="flex min-h-24 flex-col items-center justify-center gap-2 rounded-2xl border border-orange-100/70 bg-orange-50/40 text-[#D97810] transition-all peer-checked:border-[#F28F20] peer-checked:bg-orange-50 peer-checked:shadow-[0_6px_18px_-6px_rgba(242,143,32,0.25)]">
                            <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                            <span class="text-[11px] text-center font-bold leading-tight">Rusak<br>Ringan</span>
                        </span>
                        <span class="absolute right-2 top-2 flex h-3.5 w-3.5 items-center justify-center rounded-full bg-[#F28F20] text-[7px] text-white opacity-0 transition peer-checked:opacity-100"><i class="fa-solid fa-check"></i></span>
                    </label>

                    <!-- RUSAK BERAT -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="kondisi" value="rusak berat" class="peer sr-only" />
                        <span class="flex min-h-24 flex-col items-center justify-center gap-2 rounded-2xl border border-red-100/70 bg-red-50/40 text-red-500 transition-all peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:shadow-[0_6px_18px_-6px_rgba(239,68,68,0.25)]">
                            <i class="fa-regular fa-circle-xmark text-xl"></i>
                            <span class="text-[11px] text-center font-bold leading-tight">Rusak<br>Berat</span>
                        </span>
                        <span class="absolute right-2 top-2 flex h-3.5 w-3.5 items-center justify-center rounded-full bg-red-500 text-[7px] text-white opacity-0 transition peer-checked:opacity-100"><i class="fa-solid fa-check"></i></span>
                    </label>
                </div>
            </fieldset>

            <!-- PARAMETER TEKNIS (HANYA MUNCUL JIKA QR MENGANDUNG KATA 'UPS') -->
            @if($isUps)
            <section class="rounded-3xl border border-slate-100 bg-white p-5 shadow-[0_8px_28px_-14px_rgba(0,75,124,0.12)]">
                <div class="mb-5 flex items-center justify-between">
                    <h2 class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-500">Parameter Teknis</h2>
                    <span class="rounded-full bg-blue-50 px-2 py-1 text-[9px] font-semibold text-[#0075c2]">Khusus UPS</span>
                </div>

                <div class="grid grid-cols-2 gap-x-4 gap-y-5">
                    <div>
                        <label class="mb-2 flex items-center gap-2 text-[11px] font-semibold text-slate-500">
                            <i class="fa-solid fa-battery-three-quarters text-emerald-500"></i> Baterai (%)
                        </label>
                        <input type="number" name="baterai" min="0" max="100" placeholder="0–100" class="w-full rounded-xl border-0 bg-slate-50 px-4 py-3.5 text-base font-extrabold tabular-nums text-slate-800 outline-none transition placeholder:text-sm placeholder:font-medium placeholder:text-slate-300 focus:bg-emerald-50/40 focus:ring-2 focus:ring-emerald-500/40" />
                    </div>
                    <div>
                        <label class="mb-2 flex items-center gap-2 text-[11px] font-semibold text-slate-500">
                            <i class="fa-solid fa-gauge-high text-[#F28F20]"></i> Load (%)
                        </label>
                        <input type="number" name="load" min="0" max="100" placeholder="0–100" class="w-full rounded-xl border-0 bg-slate-50 px-4 py-3.5 text-base font-extrabold tabular-nums text-slate-800 outline-none transition placeholder:text-sm placeholder:font-medium placeholder:text-slate-300 focus:bg-orange-50/40 focus:ring-2 focus:ring-orange-400/40" />
                    </div>
                    <div>
                        <label class="mb-2 flex items-center gap-2 text-[11px] font-semibold text-slate-500">
                            <i class="fa-solid fa-temperature-half text-rose-400"></i> Suhu (°C)
                        </label>
                        <input type="number" name="suhu" step="0.1" placeholder="Cth: 28" class="w-full rounded-xl border-0 bg-slate-50 px-4 py-3.5 text-base font-extrabold tabular-nums text-slate-800 outline-none transition placeholder:text-sm placeholder:font-medium placeholder:text-slate-300 focus:bg-rose-50/40 focus:ring-2 focus:ring-rose-400/40" />
                    </div>
                    <div>
                        <label class="mb-2 flex items-center gap-2 text-[11px] font-semibold text-slate-500">
                            <i class="fa-solid fa-bolt text-[#0075c2]"></i> Output (V)
                        </label>
                        <input type="number" name="output" step="0.1" placeholder="Cth: 220" class="w-full rounded-xl border-0 bg-slate-50 px-4 py-3.5 text-base font-extrabold tabular-nums text-slate-800 outline-none transition placeholder:text-sm placeholder:font-medium placeholder:text-slate-300 focus:bg-blue-50/40 focus:ring-2 focus:ring-[#0075c2]/40" />
                    </div>
                </div>
            </section>
            @endif

            <!-- CATATAN TAMBAHAN -->
            <section>
                <div class="mb-3 flex items-center justify-between">
                    <h2 class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-500">Catatan Tambahan</h2>
                    <span class="text-[10px] text-slate-400">Opsional</span>
                </div>
                <textarea name="catatan" rows="4" placeholder="Tambahkan kondisi fisik, temuan lainnya..." class="w-full resize-y rounded-2xl border border-slate-100 bg-white px-4 py-3.5 text-xs leading-6 text-slate-700 shadow-[0_5px_20px_-12px_rgba(0,75,124,0.12)] outline-none transition placeholder:text-slate-400 focus:border-blue-200 focus:ring-2 focus:ring-[#0075c2]/15"></textarea>
            </section>
        </form>

        <!-- TOMBOL SIMPAN (MELAYANG DI BAWAH) -->
        <div class="fixed bottom-0 left-1/2 z-50 w-full max-w-md -translate-x-1/2 bg-gradient-to-t from-[#f8fafc] via-[#f8fafc]/95 to-[#f8fafc]/0 px-5 pb-[max(20px,env(safe-area-inset-bottom))] pt-8">
            <button type="submit" form="inspection-form" class="flex min-h-14 w-full items-center justify-center gap-2.5 rounded-2xl bg-[#F28F20] px-4 py-4 text-sm font-extrabold text-white shadow-[0_10px_24px_-6px_rgba(242,143,32,0.45)] transition hover:bg-orange-600 active:scale-[0.98]">
                <i class="fa-solid fa-check"></i>
                Simpan Hasil Pengecekan
            </button>
        </div>
    </main>

</body>
</html>