<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTESA - Edit Profil</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      body { font-family: "Plus Jakarta Sans", sans-serif; background-color: #f8fafc; }
      ::-webkit-scrollbar { width: 0px; }
    </style>
</head>
<body class="antialiased flex justify-center min-h-screen">

    @php
        $user = auth()->user();
        $namaLengkap = $user->name ?? 'Admin IPDS';
        $fotoProfil = $user->foto ?? null;
        
        $words = explode(" ", $namaLengkap);
        $inisial = "";
        if (count($words) >= 2) {
            $inisial = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        } else {
            $inisial = strtoupper(substr($namaLengkap, 0, 2));
        }
    @endphp

<main class="w-full max-w-md bg-[#F8FAFC] min-h-screen relative overflow-x-hidden shadow-2xl pb-10">
  
  <header class="bg-[#005891] rounded-b-[40px] px-6 pt-10 pb-24 relative z-0">
    <div class="flex items-center justify-between text-white">
      <a href="/profil" class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 transition hover:bg-white/20 active:scale-95">
        <i class="fa-solid fa-arrow-left"></i>
      </a>
      <h1 class="text-xs font-extrabold tracking-widest uppercase">EDIT PROFIL</h1>
      <span class="w-10"></span>
    </div>
  </header>

  <section class="relative z-10 -mt-16 px-6">
    <form action="/profil/edit" method="POST" enctype="multipart/form-data" class="rounded-[30px] bg-white p-6 shadow-[0_15px_40px_-10px_rgba(0,0,0,0.05)] border border-slate-100">
      @csrf 
      
      <!-- FOTO PROFIL DINAMIS -->
      <div class="flex flex-col items-center mb-8 -mt-14">
        <div class="relative">
          <div class="flex h-24 w-24 items-center justify-center overflow-hidden rounded-full bg-[#F28F20] text-3xl font-extrabold text-white border-4 border-white shadow-md">
            @if($fotoProfil)
                <img src="{{ asset('uploads/profil/' . $fotoProfil) }}" alt="Foto" class="w-full h-full object-cover">
            @else
                {{ $inisial }}
            @endif
          </div>
          
          <label class="absolute bottom-0 right-0 flex h-8 w-8 cursor-pointer items-center justify-center rounded-full border-[3px] border-white bg-[#005891] text-white shadow-sm transition hover:bg-[#00385d] active:scale-95">
            <input type="file" name="foto" accept="image/*" class="sr-only" />
            <i class="fa-solid fa-camera text-xs"></i>
          </label>
        </div>
        <p class="mt-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Ketuk untuk ubah foto</p>
      </div>

      <div class="space-y-4">
        
        <div>
          <label class="mb-1.5 block text-[10px] font-extrabold uppercase tracking-widest text-slate-500">Nama Lengkap</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
              <i class="fa-solid fa-user"></i>
            </div>
            <input type="text" name="name" value="{{ $namaLengkap }}" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 pl-11 pr-4 py-3.5 text-[13px] font-extrabold text-slate-800 outline-none transition-all focus:bg-white focus:border-[#005891] focus:ring-4 focus:ring-blue-50" />
          </div>
        </div>

        <div>
          <label class="mb-1.5 block text-[10px] font-extrabold uppercase tracking-widest text-slate-500">Nomor Induk / NIP</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
              <i class="fa-solid fa-id-card"></i>
            </div>
            <input type="text" name="nip" value="199010202022031001" class="w-full rounded-2xl border border-slate-200 bg-slate-50 pl-11 pr-4 py-3.5 text-[13px] font-extrabold tabular-nums text-slate-800 outline-none transition-all focus:bg-white focus:border-[#005891] focus:ring-4 focus:ring-blue-50" />
          </div>
        </div>

        <div>
          <label class="mb-1.5 block text-[10px] font-extrabold uppercase tracking-widest text-slate-500">Jabatan</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
              <i class="fa-solid fa-briefcase"></i>
            </div>
            <input type="text" name="jabatan" value="Petugas Lapangan BPS" class="w-full rounded-2xl border border-slate-200 bg-slate-50 pl-11 pr-4 py-3.5 text-[13px] font-extrabold text-slate-800 outline-none transition-all focus:bg-white focus:border-[#005891] focus:ring-4 focus:ring-blue-50" />
          </div>
        </div>

        <div>
          <label class="mb-1.5 block text-[10px] font-extrabold uppercase tracking-widest text-slate-500">Nomor HP</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
              <i class="fa-solid fa-phone"></i>
            </div>
            <input type="tel" name="no_hp" value="081234567890" class="w-full rounded-2xl border border-slate-200 bg-slate-50 pl-11 pr-4 py-3.5 text-[13px] font-extrabold tabular-nums text-slate-800 outline-none transition-all focus:bg-white focus:border-[#005891] focus:ring-4 focus:ring-blue-50" />
          </div>
        </div>
      </div>

      <button type="submit" class="mt-8 w-full rounded-2xl bg-[#005891] py-4 text-[13px] font-extrabold text-white shadow-[0_8px_20px_rgba(0,88,145,0.25)] transition-all hover:bg-[#00385d] active:scale-95 flex justify-center items-center gap-2">
        <i class="fa-solid fa-floppy-disk text-lg"></i> Simpan Perubahan
      </button>

    </form>
  </section>
</main>
</body>
</html>