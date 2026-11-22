@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div>
        <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight">Ringkasan Aset TI IPDS</h3>
        <p class="text-sm text-slate-500 mt-1">Status kesiapan PC, Monitor, dan UPS di lingkungan BPS Provinsi Sulawesi Tengah.</p>
    </div>

    <!-- KARTU STATISTIK AWAL -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase">Total UPS</p>
                    <p class="text-2xl font-black text-[#005891] mt-1">3 Unit</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-[#005891]">
                    <i class="fa-solid fa-car-battery text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase">PC Terdata</p>
                    <p class="text-2xl font-black text-slate-800 mt-1">0 Unit</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600">
                    <i class="fa-solid fa-desktop text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase">Monitor</p>
                    <p class="text-2xl font-black text-slate-800 mt-1">0 Unit</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600">
                    <i class="fa-solid fa-tv text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase">Ruangan Terpetakan</p>
                    <p class="text-2xl font-black text-emerald-600 mt-1">2 Lokasi</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                    <i class="fa-solid fa-door-open text-lg"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection