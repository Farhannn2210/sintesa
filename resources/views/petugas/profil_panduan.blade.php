<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTESA - Panduan Aplikasi</title>
    
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
      <h1 class="text-xl font-extrabold tracking-tight text-white">Panduan Aplikasi</h1>
      <span class="w-10"></span> <!-- Spacer -->
    </div>
  </header>

  <!-- LIST PANDUAN -->
  <section class="relative z-10 -mt-6 px-5 space-y-4">
    
    <!-- Panduan 1 -->
    <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 transition hover:shadow-md">
      <div class="flex items-center gap-3 mb-2">
        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#EFF7FD] text-[#0075c2]">
          <i class="fa-solid fa-qrcode text-lg"></i>
        </div>
        <h2 class="text-[13px] font-extrabold text-slate-800">Cara Scan Aset</h2>
      </div>
      <p class="text-xs leading-relaxed text-slate-500 font-medium pl-12">
        Buka menu Beranda, ketuk tombol <b class="text-[#0075c2]">SCAN ASET</b> di tengah layar. Arahkan kamera ke stiker BMN BPS pada UPS. Sistem akan mendeteksi NUP secara otomatis.
      </p>
    </div>

    <!-- Panduan 2 -->
    <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 transition hover:shadow-md">
      <div class="flex items-center gap-3 mb-2">
        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#FFF5E9] text-[#F28F20]">
          <i class="fa-solid fa-server text-lg"></i>
        </div>
        <h2 class="text-[13px] font-extrabold text-slate-800">Arti Status Perangkat</h2>
      </div>
      <ul class="text-xs leading-relaxed text-slate-500 font-medium pl-12 space-y-2">
        <li><span class="text-emerald-600 font-extrabold">Normal:</span> Tegangan, baterai, dan suhu optimal.</li>
        <li><span class="text-amber-600 font-extrabold">Warning:</span> Ada anomali (suhu tinggi/baterai lemah).</li>
        <li><span class="text-red-600 font-extrabold">Rusak:</span> Perangkat mati atau tidak berfungsi.</li>
      </ul>
    </div>

    <!-- Panduan 3 -->
    <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 transition hover:shadow-md">
      <div class="flex items-center gap-3 mb-2">
        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-red-50 text-red-500">
          <i class="fa-solid fa-camera-rotate text-lg"></i>
        </div>
        <h2 class="text-[13px] font-extrabold text-slate-800">Kamera Tidak Merespon?</h2>
      </div>
      <p class="text-xs leading-relaxed text-slate-500 font-medium pl-12">
        Pastikan Anda telah memberikan izin akses kamera <i>(Allow Camera Permissions)</i> pada browser Anda. Jika stiker rusak, gunakan fitur <b class="text-slate-700">Input Kode Manual</b>.
      </p>
    </div>

  </section>

</main>
</body>
</html>