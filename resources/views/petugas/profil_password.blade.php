<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTESA - Ubah Password</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
      body { font-family: "Plus Jakarta Sans", sans-serif; background-color: #e2e8f0; }
      ::-webkit-scrollbar { width: 0px; }
    </style>
</head>
<body class="antialiased flex justify-center min-h-screen">

<main class="w-full max-w-md bg-[#F7F9FC] min-h-screen relative overflow-x-hidden shadow-2xl pb-10">
  
  <!-- HEADER LENGKUNG -->
  <header class="bg-gradient-to-br from-[#004b7c] to-[#0075c2] rounded-b-[30px] px-5 pt-8 pb-16 shadow-[0_10px_30px_rgba(0,75,194,0.2)]">
    <div class="flex items-center justify-between">
      <a href="/profil" class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 text-white transition hover:bg-white/15 active:scale-95">
        <i class="fa-solid fa-arrow-left"></i>
      </a>
      <h1 class="text-xl font-extrabold tracking-tight text-white">Ubah Password</h1>
      <span class="w-10"></span> <!-- Spacer -->
    </div>
  </header>

  <!-- FORMULIR UBAH PASSWORD -->
  <section class="relative z-10 -mt-6 px-5">
    <!-- Menambahkan action dan method -->
    <form action="/profil/password" method="POST" class="rounded-2xl bg-white p-5 shadow-sm border border-slate-100">
      @csrf <!-- Wajib untuk keamanan Laravel -->
      
      <!-- Ikon dan Teks Petunjuk -->
      <div class="text-center mb-6 pt-2">
        <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400 mb-3 shadow-inner">
          <i class="fa-solid fa-shield-halved text-3xl"></i>
        </div>
        <p class="text-[11px] font-bold text-slate-400 px-4 leading-relaxed">
          Ganti password Anda secara berkala untuk menjaga keamanan akun SINTESA.
        </p>
      </div>

      <!-- Pesan Error (Muncul jika password lama salah / tidak cocok) -->
      @if($errors->any())
        <div class="mb-4 rounded-xl bg-red-50 p-3 text-[11px] font-bold text-red-500 border border-red-100">
          <ul class="list-disc pl-4">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- KOLOM INPUT -->
      <div class="space-y-4">
        
        <!-- Password Lama -->
        <div>
          <label class="mb-2 block text-[11px] font-extrabold uppercase tracking-widest text-slate-500">Password Saat Ini</label>
          <div class="relative">
            <!-- Menambahkan name="current_password" -->
            <input type="password" name="current_password" required placeholder="Masukkan password lama" class="w-full rounded-xl border-0 bg-[#F1F5F9] px-4 py-3.5 pr-10 text-sm font-extrabold text-slate-800 outline-none transition-all focus:ring-2 focus:ring-[#005891]" />
            <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
              <i class="fa-regular fa-eye-slash"></i>
            </button>
          </div>
        </div>

        <hr class="border-slate-100 my-4">

        <!-- Password Baru -->
        <div>
          <label class="mb-2 block text-[11px] font-extrabold uppercase tracking-widest text-slate-500">Password Baru</label>
          <div class="relative">
            <!-- Menambahkan name="new_password" -->
            <input type="password" name="new_password" required placeholder="Minimal 8 karakter" class="w-full rounded-xl border-0 bg-[#F1F5F9] px-4 py-3.5 pr-10 text-sm font-extrabold text-slate-800 outline-none transition-all focus:ring-2 focus:ring-[#005891]" />
            <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
              <i class="fa-regular fa-eye-slash"></i>
            </button>
          </div>
        </div>

        <!-- Konfirmasi Password -->
        <div>
          <label class="mb-2 block text-[11px] font-extrabold uppercase tracking-widest text-slate-500">Konfirmasi Password Baru</label>
          <div class="relative">
            <!-- Menambahkan name="new_password_confirmation" -->
            <input type="password" name="new_password_confirmation" required placeholder="Ketik ulang password baru" class="w-full rounded-xl border-0 bg-[#F1F5F9] px-4 py-3.5 pr-10 text-sm font-extrabold text-slate-800 outline-none transition-all focus:ring-2 focus:ring-[#005891]" />
            <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
              <i class="fa-regular fa-eye-slash"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- TOMBOL SIMPAN -->
      <button type="submit" class="mt-8 w-full rounded-2xl bg-[#0075c2] py-4 text-sm font-extrabold text-white shadow-[0_8px_20px_rgba(0,117,194,0.3)] transition-all hover:bg-[#005891] active:scale-95 flex justify-center items-center gap-2">
        <i class="fa-solid fa-check text-lg"></i> Perbarui Password
      </button>

    </form>
  </section>

</main>
</body>
</html>