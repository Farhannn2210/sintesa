<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SINTESA BPS Prov. Sulteng</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <style> 
        body { font-family: "Plus Jakarta Sans", sans-serif; } 
        @keyframes shine { 100% { transform: translateX(100%); } }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        .animate-float { animation: float 6s ease-in-out infinite; }
        
        .bg-grid-pattern {
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden antialiased bg-slate-50">

    <!-- BAGIAN KIRI: BRANDING & INFORMASI -->
    <div class="relative hidden lg:flex lg:w-5/12 xl:w-1/2 flex-col justify-between bg-gradient-to-br from-[#004b7c] via-[#003d66] to-[#002842] p-12 overflow-hidden z-10">
        
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
        <div class="absolute -top-32 -left-32 h-96 w-96 rounded-full bg-[#F28F20]/20 blur-[100px]"></div>
        
        <div class="relative z-10 flex items-center gap-3">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[#F28F20] to-[#e07d14] shadow-lg shadow-orange-500/30">
                <i class="fa-solid fa-boxes-stacked text-white text-xl"></i>
            </div>
            <span class="text-3xl font-extrabold text-white tracking-wide">SINTESA</span>
        </div>

        <div class="relative z-10 max-w-lg mb-10 mt-auto">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/10 backdrop-blur-md mb-8 shadow-sm">
                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse ring-4 ring-emerald-400/20"></span>
                <span class="text-[10px] font-extrabold text-blue-50 tracking-widest uppercase">IT Asset Management Platform</span>
            </div>
            <h1 class="text-4xl xl:text-[2.8rem] font-extrabold text-white leading-tight mb-6 tracking-tight">
                Pantau & Kelola Aset TI Lebih Cerdas.
            </h1>
            <p class="text-base text-blue-100/80 font-medium leading-relaxed max-w-md">
                Sistem Informasi Inventaris dan Pengecekan Aset TI terintegrasi khusus untuk Badan Pusat Statistik Provinsi Sulawesi Tengah.
            </p>
        </div>

        <div class="relative z-10 flex items-center justify-between border-t border-white/10 pt-6 mt-auto">
            <div class="text-[11px] font-bold text-blue-200/50 tracking-widest uppercase">
                &copy; {{ date('Y') }} BPS Prov. Sulteng
            </div>
        </div>
    </div>

    <!-- BAGIAN KANAN: FORM LOGIN -->
    <div class="relative flex flex-1 flex-col bg-slate-50 overflow-hidden">
        
        <div class="absolute inset-0 bg-grid-pattern opacity-40 z-0"></div>
        <div class="absolute top-[-10%] right-[-5%] h-[500px] w-[500px] rounded-full bg-blue-400/15 blur-[80px] pointer-events-none z-0"></div>
        <div class="absolute bottom-[-10%] left-[-10%] h-[400px] w-[400px] rounded-full bg-orange-400/15 blur-[80px] pointer-events-none z-0"></div>

        <div class="absolute top-8 right-8 z-20 hidden md:flex items-center gap-2.5 rounded-2xl bg-white/80 backdrop-blur-md px-5 py-2.5 shadow-sm border border-slate-200/60 animate-float">
            <span class="relative flex h-2.5 w-2.5">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
            </span>
            <span class="text-xs font-bold text-slate-600">Sistem Online</span>
        </div>

        <!-- Container Form -->
        <div class="relative z-10 flex flex-1 items-center justify-center px-6 sm:px-12 lg:px-16 overflow-y-auto">
            <div class="w-full max-w-[460px] py-12">
                
                <div class="lg:hidden flex flex-col items-center justify-center text-center mb-8">
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-[#004b7c] to-[#002842] shadow-xl mb-4">
                        <i class="fa-solid fa-boxes-stacked text-[#F28F20] text-3xl"></i>
                    </div>
                    <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight mb-1">SINTESA</h1>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">BPS Prov. Sulteng</p>
                </div>

                <!-- Kartu Form -->
                <div class="bg-white/90 backdrop-blur-xl p-8 sm:p-12 rounded-[2.5rem] shadow-[0_20px_60px_-15px_rgba(0,30,80,0.08)] border border-white ring-1 ring-slate-100">
                    
                    <div class="mb-10 text-center sm:text-left">
                        <h2 class="text-3xl font-extrabold text-slate-800 mb-3">Selamat Datang 👋</h2>
                        <p class="text-sm font-medium text-slate-500 leading-relaxed">Masuk dengan kredensial Administrator atau Petugas Lapangan Anda.</p>
                    </div>

                    <!-- Notifikasi Error Jika Login Gagal -->
                    @if($errors->any())
                        <div class="mb-6 rounded-2xl bg-red-50 p-4 text-sm text-red-600 border border-red-100 flex items-start gap-3 shadow-sm">
                            <i class="fa-solid fa-circle-exclamation mt-0.5 text-red-500"></i>
                            <div>
                                <span class="font-extrabold block mb-1">Login Gagal!</span>
                                <ul class="list-disc pl-4 text-xs font-medium">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- ACTION DIUBAH KE url('/login') -->
                    <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                        @csrf <!-- Pengganti token -->

                        <div class="space-y-2.5">
                            <label for="email" class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-widest ml-1">Email / Username</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4.5 flex items-center pointer-events-none ml-2">
                                    <i class="fa-regular fa-envelope text-slate-400 group-focus-within:text-[#0075c2] transition-colors text-lg"></i>
                                </div>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                                    class="block w-full rounded-2xl border-2 border-slate-100 pl-12 py-4 text-sm font-bold text-slate-800 focus:border-[#0075c2] focus:bg-white outline-none transition-all placeholder:text-slate-400 placeholder:font-semibold bg-slate-50 hover:bg-slate-100/70" 
                                    placeholder="nama@bps.go.id">
                            </div>
                        </div>

                        <div class="space-y-2.5">
                            <div class="flex items-center justify-between ml-1 mr-1">
                                <label for="password" class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-widest">Kata Sandi</label>
                                <a href="#" class="text-[11px] font-extrabold text-[#0075c2] hover:text-[#004b7c] transition-colors">Lupa sandi?</a>
                            </div>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4.5 flex items-center pointer-events-none ml-2">
                                    <i class="fa-solid fa-lock text-slate-400 group-focus-within:text-[#0075c2] transition-colors text-lg"></i>
                                </div>
                                <input id="password" name="password" type="password" required 
                                    class="block w-full rounded-2xl border-2 border-slate-100 pl-12 pr-12 py-4 text-sm font-bold text-slate-800 focus:border-[#0075c2] focus:bg-white outline-none transition-all placeholder:text-slate-400 placeholder:font-semibold bg-slate-50 hover:bg-slate-100/70" 
                                    placeholder="••••••••">
                                
                                <!-- Tombol Mata Diberi ID -->
                                <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-700 transition-colors mr-1">
                                    <i id="eyeIcon" class="fa-regular fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center pt-2 ml-1">
                            <label class="relative flex items-center rounded-full cursor-pointer" htmlFor="remember-me">
                                <input type="checkbox" name="remember-me" id="remember-me" class="peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border-2 border-slate-300 transition-all checked:border-[#0075c2] checked:bg-[#0075c2] hover:border-[#0075c2]" />
                                <span class="absolute text-white transition-opacity opacity-0 pointer-events-none top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 peer-checked:opacity-100">
                                    <i class="fa-solid fa-check text-[10px] stroke-2"></i>
                                </span>
                            </label>
                            <span class="ml-2.5 text-[13px] font-bold text-slate-600 cursor-pointer select-none" onclick="document.getElementById('remember-me').click()">Ingat sesi saya</span>
                        </div>

                        <div class="pt-6">
                            <button type="submit" 
                                class="group relative flex w-full justify-center rounded-2xl bg-gradient-to-r from-[#F28F20] to-[#f5a142] py-5 px-6 text-base font-extrabold text-white shadow-xl shadow-orange-500/30 hover:shadow-orange-500/40 focus:outline-none transition-all hover:-translate-y-1 active:translate-y-0 overflow-hidden">
                                <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/30 to-transparent group-hover:animate-[shine_1.2s_ease-in-out]"></div>
                                <span class="flex items-center gap-2.5 relative z-10 tracking-wide py-0.5">
                                    Masuk ke Sistem
                                    <i class="fa-solid fa-arrow-right text-sm transition-transform duration-300 group-hover:translate-x-1.5"></i>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="mt-8 flex justify-center items-center gap-6 text-slate-300">
                    <i class="fa-solid fa-server text-xl"></i>
                    <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                    <i class="fa-solid fa-desktop text-xl"></i>
                    <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                    <i class="fa-solid fa-wifi text-xl"></i>
                </div>

            </div>
        </div>
    </div>

    <!-- SCRIPT UNTUK FITUR MATA (SHOW/HIDE PASSWORD) -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            // Cek apakah tipenya password atau text
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text'; // Tampilkan teks
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye'); // Ubah ikon mata terbuka
                eyeIcon.classList.add('text-[#0075c2]'); // Beri warna biru sedikit
            } else {
                passwordInput.type = 'password'; // Sembunyikan teks
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash'); // Ubah ikon mata tertutup
                eyeIcon.classList.remove('text-[#0075c2]');
            }
        });
    </script>
</body>
</html>