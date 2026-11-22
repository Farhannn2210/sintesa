<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SINTESA - Petugas Lapangan</title>
    @vite('resources/css/app.css')
    <!-- FontAwesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 antialiased pb-20">

    <!-- Top Navbar Khusus Mobile -->
    <nav class="bg-[#005891] text-white p-4 sticky top-0 z-50 shadow-md flex justify-between items-center">
        <div class="font-extrabold text-lg flex items-center gap-2">
            <i class="fa-solid fa-qrcode"></i> SINTESA
        </div>
        <!-- Tombol darurat untuk kembali ke Admin sementara kita belum punya login -->
        <a href="{{ route('aset.index') }}" class="text-xs bg-white/20 px-3 py-1.5 rounded-lg font-semibold hover:bg-white/30 transition">
            Ke Admin
        </a>
    </nav>

    <!-- Area Konten Utama -->
    <main class="p-4">
        @yield('content')
    </main>

</body>
</html>