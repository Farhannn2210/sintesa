<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SINTESA Petugas - Scan QR</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://unpkg.com/html5-qrcode"></script>

    <style>
        body { font-family: "Plus Jakarta Sans", sans-serif; background-color: #f8fafc; }
        #reader { width: 100%; border-radius: 1.5rem; overflow: hidden; border: none !important; }
        #reader video { object-fit: cover; border-radius: 1.5rem; width: 100%; height: 100%; }
        #reader__dashboard_section_csr span, #reader__dashboard_section_swaplink { display: none !important; }
    </style>
</head>
<body class="text-slate-800 antialiased">

    <div class="mx-auto max-w-md bg-[#f8fafc] min-h-screen relative shadow-2xl flex flex-col">
        
        <!-- Header -->
        <div class="bg-[#0075c2] rounded-b-[2.5rem] px-6 pb-24 pt-6 text-white shadow-lg">
            <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-xs font-bold text-blue-100 hover:text-white transition mb-6">
                <i class="fa-solid fa-arrow-left"></i> Batal / Kembali
            </a>
            <p class="text-[9px] font-extrabold uppercase tracking-[0.2em] text-blue-200/70 mb-1">SINTESA · SISTEM ASET TI</p>
            <h1 class="text-2xl font-extrabold tracking-tight">Scan QR Aset</h1>
            <p class="mt-1 text-xs text-blue-100/90">Arahkan kamera ke stiker BMN</p>
        </div>

        <!-- Kamera Preview -->
        <div class="px-5 -mt-16 relative z-10">
            <div class="rounded-[2rem] bg-black p-1.5 shadow-2xl ring-4 ring-white/20">
                <div class="relative rounded-3xl bg-black overflow-hidden flex items-center justify-center min-h-[320px]">
                    <div id="reader" class="w-full h-full"></div>
                    <div id="loading-camera" class="absolute inset-0 flex flex-col items-center justify-center text-white/50 bg-black z-20">
                        <i class="fa-solid fa-camera animate-pulse text-3xl mb-2"></i>
                        <span class="text-xs font-bold">Mengaktifkan Kamera...</span>
                    </div>
                </div>
            </div>
            <p class="mt-4 text-center text-[10px] font-medium text-slate-400">Posisikan QR code di dalam bingkai.<br>Aset akan terdeteksi otomatis.</p>
        </div>

        <!-- Menu Tambahan -->
        <div class="px-6 mt-8 pb-8 flex-1">
            <p class="text-[9px] font-extrabold uppercase tracking-widest text-slate-400 mb-4">Atau Gunakan Cara Lain</p>
            
            <div class="space-y-3">
                <!-- Tombol Galeri -->
                <label for="qr-input-file" class="flex items-center gap-4 rounded-2xl bg-white p-4 shadow-sm border border-slate-100 cursor-pointer active:scale-[0.98] transition">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#0075c2]">
                        <i class="fa-regular fa-image"></i>
                    </span>
                    <div class="flex-1">
                        <h3 id="teks-galeri" class="text-xs font-extrabold text-slate-800">Scan dari Galeri</h3>
                        <p class="text-[10px] font-medium text-slate-400">Pilih foto QR dari penyimpanan</p>
                    </div>
                    <i class="fa-solid fa-chevron-right text-xs text-slate-300"></i>
                    <input type="file" id="qr-input-file" accept="image/*" class="hidden">
                </label>

                <!-- Tombol Manual -->
                <button id="btn-manual" class="w-full flex items-center gap-4 rounded-2xl bg-white p-4 shadow-sm border border-slate-100 active:scale-[0.98] transition text-left">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-[#F28F20]">
                        <i class="fa-regular fa-keyboard"></i>
                    </span>
                    <div class="flex-1">
                        <h3 class="text-xs font-extrabold text-slate-800">Input Kode Manual</h3>
                        <p class="text-[10px] font-medium text-slate-400">Ketik NUP aset jika stiker rusak</p>
                    </div>
                    <i class="fa-solid fa-chevron-right text-xs text-slate-300"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL CUSTOM POP-UP INPUT MANUAL -->
    <div id="modal-manual" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm px-5 opacity-0 pointer-events-none transition-opacity duration-300">
        <div id="modal-content" class="w-full max-w-sm rounded-3xl bg-white p-6 shadow-2xl transform scale-95 transition-transform duration-300">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-50 text-[#F28F20] mb-4">
                <i class="fa-solid fa-keyboard text-xl"></i>
            </div>
            <h3 class="mb-1 text-lg font-extrabold text-slate-800">Input Kode Manual</h3>
            <p class="mb-5 text-xs font-medium text-slate-500">Masukkan kode aset untuk memulai pengecekan.</p>
            
            <input type="text" id="input-kode" placeholder="Cth: SINTESA-UPS-001" class="w-full rounded-xl border-none bg-slate-50 p-4 text-sm font-bold text-slate-800 outline-none ring-1 ring-slate-200 transition focus:ring-2 focus:ring-[#0075c2]">
            <p id="error-msg" class="mt-2 hidden text-[10px] font-bold text-red-500">Kode tidak boleh kosong!</p>

            <div class="mt-6 flex gap-3">
                <button id="btn-batal" class="flex-1 rounded-xl bg-slate-100 py-3.5 text-xs font-extrabold text-slate-600 transition hover:bg-slate-200">Batal</button>
                <button id="btn-lanjut" class="flex-1 rounded-xl bg-[#0075c2] py-3.5 text-xs font-extrabold text-white shadow-lg shadow-blue-500/30 transition hover:bg-[#005891]">Lanjut <i class="fa-solid fa-arrow-right ml-1"></i></button>
            </div>
        </div>
    </div>

    <!-- SCRIPT LOGIKA BACA QR & NAVIGASI -->
    <script>
        const html5QrCode = new Html5Qrcode("reader");
        let isCameraActive = false;

        function bawaKeFormPengecekan(kodeAset) {
            let urlTujuan = "/tes-form-scan?qr=" + encodeURIComponent(kodeAset);
            if(isCameraActive) {
                html5QrCode.stop().then(() => window.location.href = urlTujuan).catch(() => window.location.href = urlTujuan);
            } else {
                window.location.href = urlTujuan;
            }
        }

        // 1. KAMERA
        const config = { fps: 10, qrbox: { width: 250, height: 250 } };
        html5QrCode.start({ facingMode: "environment" }, config, (teksQR) => {
            bawaKeFormPengecekan(teksQR);
        }).then(() => {
            isCameraActive = true;
            document.getElementById('loading-camera').style.display = 'none';
        }).catch(() => {
            document.getElementById('loading-camera').innerHTML = "<span class='text-[10px] font-bold text-red-400'>Kamera tidak tersedia.</span>";
        });

        // 2. GALERI (DIPERBAIKI)
        const inputGaleri = document.getElementById('qr-input-file');
        const teksGaleri = document.getElementById('teks-galeri');
        
        inputGaleri.addEventListener('change', (e) => {
            if (e.target.files.length === 0) return;
            
            // Ubah tampilan tombol jadi loading
            teksGaleri.innerText = "Memproses Gambar...";
            teksGaleri.classList.add("animate-pulse", "text-[#0075c2]");

            const fileGambar = e.target.files[0];

            // Fungsi inti untuk membaca gambar
            const jalankanScanGaleri = () => {
                html5QrCode.scanFile(fileGambar, true)
                .then(teksQR => {
                    bawaKeFormPengecekan(teksQR);
                })
                .catch(err => {
                    alert("QR Code tidak terdeteksi! Pastikan gambar stiker jelas, tidak buram, dan berisi QR Code valid.");
                    // Kembalikan tombol ke semula jika gagal
                    teksGaleri.innerText = "Scan dari Galeri";
                    teksGaleri.classList.remove("animate-pulse", "text-[#0075c2]");
                    inputGaleri.value = ""; 
                });
            };

            // CEGAH BENTROK: Matikan kamera dulu sebelum membaca galeri
            if (isCameraActive) {
                html5QrCode.stop().then(() => {
                    isCameraActive = false;
                    jalankanScanGaleri();
                }).catch(() => jalankanScanGaleri());
            } else {
                jalankanScanGaleri();
            }
        });

        // 3. POP-UP MANUAL
        const modal = document.getElementById('modal-manual');
        const modalContent = document.getElementById('modal-content');
        const inputKode = document.getElementById('input-kode');
        const errorMsg = document.getElementById('error-msg');

        document.getElementById('btn-manual').addEventListener('click', () => {
            modal.classList.remove('pointer-events-none');
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            inputKode.value = '';
            errorMsg.classList.add('hidden');
            setTimeout(() => inputKode.focus(), 300);
        });

        document.getElementById('btn-batal').addEventListener('click', () => {
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
            modalContent.classList.add('scale-95');
        });

        document.getElementById('btn-lanjut').addEventListener('click', () => {
            const kode = inputKode.value.trim();
            if(kode) {
                bawaKeFormPengecekan(kode);
            } else {
                errorMsg.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>