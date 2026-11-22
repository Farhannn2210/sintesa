@extends('layouts.petugas')

@section('content')
<div class="max-w-xl mx-auto p-4">
    <div class="mb-4">
        <a href="{{ route('scan.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-700">
            ← Batal / Kembali
        </a>
        <h1 class="text-xl font-extrabold text-slate-800 mt-2">Pengecekan Kondisi UPS</h1>
        <p class="text-xs text-slate-500">Isi parameter teknis dan kondisi perangkat dengan akurat</p>
    </div>

    <!-- Informasi Target Aset & Pengguna -->
    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 mb-6">
        <div class="flex items-center gap-3">
            <div class="bg-blue-50 p-3 rounded-xl text-[#0075c2] shrink-0">
                <i class="fa-solid fa-server text-lg"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Target Pengecekan</span>
                <h3 class="font-bold text-slate-800 text-sm truncate">{{ $aset->nama_perangkat }}</h3>
                <p class="text-[11px] text-slate-500 font-mono">{{ $aset->kode_qr }}</p>
            </div>
        </div>
        <div class="mt-3 pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-2 text-[11px]">
            <span class="inline-flex items-center gap-1.5 text-slate-500 font-medium">
                <i class="fa-solid fa-location-dot text-slate-400"></i>
                {{ $aset->ruangan->nama_ruangan ?? 'Ruangan belum diatur' }}
            </span>
            <span class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50/80 px-2.5 py-1 font-bold text-[#0075c2] border border-blue-100">
                <i class="fa-solid fa-user text-[10px]"></i>
                {{ $aset->nama_pengguna ?? 'Pengguna belum ditentukan' }}
            </span>
        </div>
    </div>

    <!-- Form Pengecekan -->
    <form action="/simpan-pengecekan" method="POST" class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 space-y-5">
        @csrf
        
        <input type="hidden" name="kode_aset" value="{{ $aset->kode_qr }}">

        <!-- Pilihan Status / Kondisi Perangkat -->
        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Status Perangkat *</label>
            <div class="grid grid-cols-3 gap-3">
                <label class="flex flex-col items-center justify-center p-3 rounded-2xl border-2 border-slate-100 cursor-pointer hover:border-emerald-500 transition has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/30">
                    <input type="radio" name="kondisi" value="Normal" class="sr-only" required>
                    <i class="fa-solid fa-circle-check text-emerald-500 text-base mb-1"></i>
                    <span class="text-xs font-bold text-slate-700">Normal</span>
                </label>

                <label class="flex flex-col items-center justify-center p-3 rounded-2xl border-2 border-slate-100 cursor-pointer hover:border-amber-500 transition has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50/30">
                    <input type="radio" name="kondisi" value="Rusak Ringan" class="sr-only">
                    <i class="fa-solid fa-triangle-exclamation text-amber-500 text-base mb-1"></i>
                    <span class="text-xs font-bold text-slate-700">Rusak Ringan</span>
                </label>

                <label class="flex flex-col items-center justify-center p-3 rounded-2xl border-2 border-slate-100 cursor-pointer hover:border-rose-500 transition has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/30">
                    <input type="radio" name="kondisi" value="Rusak Berat" class="sr-only">
                    <i class="fa-solid fa-circle-xmark text-rose-500 text-base mb-1"></i>
                    <span class="text-xs font-bold text-slate-700">Rusak Berat</span>
                </label>
            </div>
        </div>

        <!-- Parameter Teknis Khusus UPS -->
        <div>
            <div class="flex justify-between items-center mb-2">
                <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Parameter Teknis</label>
                <span class="text-[10px] bg-slate-100 text-slate-500 font-bold px-2 py-0.5 rounded-md">Khusus UPS</span>
            </div>
            
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[11px] font-medium text-slate-500 mb-1">Baterai (%)</label>
                    <input type="number" name="baterai" placeholder="0-100" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs font-bold text-slate-700 outline-none focus:border-blue-500 focus:bg-white">
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-slate-500 mb-1">Load (%)</label>
                    <input type="number" name="load" placeholder="0-100" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs font-bold text-slate-700 outline-none focus:border-blue-500 focus:bg-white">
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-slate-500 mb-1">Suhu (°C)</label>
                    <input type="number" step="0.1" name="suhu" placeholder="Cth: 28" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs font-bold text-slate-700 outline-none focus:border-blue-500 focus:bg-white">
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-slate-500 mb-1">Output (V)</label>
                    <input type="number" step="0.1" name="output" placeholder="Cth: 220" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs font-bold text-slate-700 outline-none focus:border-blue-500 focus:bg-white">
                </div>
            </div>
        </div>

        <!-- Catatan Tambahan -->
        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Catatan Tambahan <span class="text-[10px] text-slate-400 font-normal">(Opsional)</span></label>
            <textarea name="catatan" rows="3" placeholder="Tambahkan kondisi fisik, temuan lainnya..." class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs font-medium text-slate-700 outline-none focus:border-blue-500 focus:bg-white"></textarea>
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="w-full rounded-xl bg-[#F28F20] px-5 py-3 text-xs font-bold text-white shadow-lg shadow-[#F28F20]/30 transition hover:bg-[#e0801a] flex items-center justify-center gap-2">
            <i class="fa-solid fa-check"></i> Simpan Hasil Pengecekan
        </button>
    </form>
</div>
@endsection