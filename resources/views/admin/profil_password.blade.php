<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTESA Admin - Ubah Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    body { font-family: "Plus Jakarta Sans", sans-serif; }
    </style>
</head>
<body class="bg-[#F1F5F9] text-slate-800 flex h-screen overflow-hidden antialiased">

    <!-- SIDEBAR KIRI -->
    <aside class="flex w-64 shrink-0 flex-col bg-[#004b7c] text-white shadow-2xl z-20">
        <a href="/admin/dashboard" class="flex items-center gap-3 px-6 pb-6 pt-8 border-b border-white/10">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#F28F20]">
                <i class="fa-solid fa-boxes-stacked text-white text-lg"></i>
            </span>
            <div>
                <span class="block text-xl font-extrabold tracking-wide">SINTESA</span>
                <span class="block text-[10px] font-medium text-blue-200/70">BPS Prov. Sulteng</span>
            </div>
        </a>
        <div class="mt-auto p-5 relative border-t border-white/10 bg-white/5">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#F28F20] text-sm font-extrabold text-white"><i class="fa-solid fa-lock"></i></span>
                <span class="min-w-0 flex-1">
                    <span class="block truncate text-xs font-bold text-[#F28F20]">Keamanan</span>
                </span>
            </div>
        </div>
    </aside>

    <!-- KONTEN UTAMA: UBAH PASSWORD -->
    <main class="relative min-w-0 flex-1 overflow-y-auto bg-[#F1F5F9] p-8">
        <div class="w-full max-w-3xl pb-12">
            
            <div class="flex items-center gap-3 mb-8">
                <a href="/admin/profil" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-blue-50 hover:text-[#005891] transition-colors shadow-sm">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Pengaturan Password</h2>
            </div>

            <form action="/admin/profil/password" method="POST" class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-10">
                @csrf
                
                <div class="flex items-center gap-4 mb-8 pb-8 border-b border-slate-100">
                    <div class="w-14 h-14 bg-red-50 text-red-500 rounded-xl flex items-center justify-center text-2xl"><i class="fa-solid fa-shield-halved"></i></div>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-800">Ubah Kata Sandi</h3>
                        <p class="text-xs font-medium text-slate-500 mt-1">Pastikan menggunakan kombinasi password yang kuat.</p>
                    </div>
                </div>

                @if($errors->any())
                    <div class="mb-6 rounded-xl bg-red-50 p-4 text-xs font-bold text-red-600 border border-red-100">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-6">
                    <div>
                        <label class="mb-2 block text-xs font-extrabold uppercase tracking-widest text-slate-500">Password Saat Ini</label>
                        <input type="password" name="current_password" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm font-extrabold text-slate-800 outline-none focus:bg-white focus:border-[#005891] focus:ring-4 focus:ring-blue-50 transition-all" />
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-extrabold uppercase tracking-widest text-slate-500">Password Baru</label>
                        <input type="password" name="new_password" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm font-extrabold text-slate-800 outline-none focus:bg-white focus:border-[#005891] focus:ring-4 focus:ring-blue-50 transition-all" />
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-extrabold uppercase tracking-widest text-slate-500">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm font-extrabold text-slate-800 outline-none focus:bg-white focus:border-[#005891] focus:ring-4 focus:ring-blue-50 transition-all" />
                    </div>
                </div>

                <div class="mt-10 flex justify-end">
                    <button type="submit" class="rounded-xl bg-[#005891] px-8 py-3.5 text-sm font-extrabold text-white shadow-[0_8px_20px_rgba(0,88,145,0.25)] hover:bg-[#004b7c] transition-all flex items-center gap-2">
                        <i class="fa-solid fa-check"></i> Perbarui Password
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>