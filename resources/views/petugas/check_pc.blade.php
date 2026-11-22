@extends('layouts.petugas')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <h3 class="text-xl font-extrabold text-slate-800 mb-4">Pengecekan PC / Monitor</h3>
        
        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 mb-6">
            <p class="text-xs text-slate-500 font-bold uppercase mb-1">Target Pengecekan:</p>
            <p class="text-lg font-black text-[#005891]">{{ $aset->nama_perangkat }} ({{ $aset->kategori }})</p>
            <div class="mt-2.5 pt-2.5 border-t border-slate-200/70 flex flex-wrap items-center justify-between gap-2 text-xs">
                <p class="text-slate-600 font-medium">
                    <i class="fa-solid fa-location-dot text-slate-400 mr-1"></i> {{ $aset->ruangan->nama_ruangan ?? 'Belum ada ruangan' }}
                </p>
                <span class="inline-flex items-center gap-1.5 rounded-lg bg-blue-100/70 px-2.5 py-1 font-bold text-[#005891] border border-blue-200/70">
                    <i class="fa-solid fa-user text-[10px]"></i> {{ $aset->nama_pengguna ?? 'Pengguna belum ditentukan' }}
                </span>
            </div>
        </div>

        <form action="{{ route('aset.update_kondisi', $aset->id) }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-2">Kondisi Fisik & Fungsi Utama</label>
                <div class="grid grid-cols-3 gap-3">
                    <label class="cursor-pointer">
                        <input type="radio" name="kondisi" value="Normal" class="peer sr-only" required>
                        <div class="text-center p-2 rounded-lg border-2 border-slate-200 peer-checked:border-green-500 peer-checked:bg-green-50 hover:bg-slate-50 transition">
                            <span class="block text-sm font-bold text-green-600">Normal</span>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="kondisi" value="Rusak Ringan" class="peer sr-only">
                        <div class="text-center p-2 rounded-lg border-2 border-slate-200 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 hover:bg-slate-50 transition">
                            <span class="block text-sm font-bold text-yellow-600">Rusak Ringan</span>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="kondisi" value="Rusak Berat" class="peer sr-only">
                        <div class="text-center p-2 rounded-lg border-2 border-slate-200 peer-checked:border-red-500 peer-checked:bg-red-50 hover:bg-slate-50 transition">
                            <span class="block text-sm font-bold text-red-600">Rusak Berat</span>
                        </div>
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Catatan / Keluhan User</label>
                <textarea name="catatan" rows="3" placeholder="Contoh: PC sering mati sendiri, koneksi internet sering putus..." class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:border-[#005891]"></textarea>
            </div>

            <button type="submit" class="w-full py-3 bg-[#005891] text-white rounded-lg text-sm font-bold hover:bg-blue-800 transition">Simpan Laporan PC</button>
        </form>
    </div>
</div>
@endsection