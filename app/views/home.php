<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Landing Page | Peminjaman Alat Elektronik UNU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-blue-600 shadow text-white">
        <div class="container mx-auto flex justify-between items-center py-3 px-6">
            <div class="flex items-center gap-2 text-xl font-bold">
                <i class="fa-solid fa-laptop"></i>
                Peminjaman Alat Elektronik UNU
            </div>
            <nav class="flex gap-4">
                <a href="#about" class="hover:underline">Tentang</a>
                <a href="#features" class="hover:underline">Fitur</a>
                <a href="#login" class="hover:underline">Login</a>
            </nav>
        </div>
    </header>
    <!-- Hero Section -->
    <section class="flex-1 flex flex-col justify-center items-center text-center py-16 bg-gradient-to-b from-blue-50 to-purple-50">
        <h1 class="text-4xl md:text-5xl font-extrabold text-blue-800 mb-4 flex items-center justify-center gap-2"><i class="fa-solid fa-bolt text-yellow-400"></i> Selamat Datang di Website Peminjaman Alat Elektronik UNU</h1>
        <p class="text-lg md:text-xl text-gray-700 max-w-2xl mb-8">Aplikasi website ini memudahkan mahasiswa dan admin Universitas Nahdlatul Ulama untuk mengelola peminjaman, pengembalian, dan persetujuan alat elektronik secara online, cepat, dan transparan.</p>
        <a href="index.php?controller=auth&action=login" id="login" class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-lg shadow-lg font-semibold hover:scale-105 transition flex items-center gap-2"><i class="fa-solid fa-right-to-bracket"></i> Login Sekarang</a>
    </section>
    <!-- About Section -->
    <section id="about" class="py-16 bg-white">
        <div class="container mx-auto px-6 max-w-3xl text-center">
            <h2 class="text-3xl font-bold text-blue-700 mb-4 flex items-center justify-center gap-2"><i class="fa-solid fa-circle-info"></i> Tentang Aplikasi</h2>
            <p class="text-gray-700 text-lg">Website ini adalah sistem informasi peminjaman alat elektronik di Universitas Nahdlatul Ulama. Dengan aplikasi ini, proses peminjaman alat menjadi lebih mudah, terdata, dan terkontrol. Mahasiswa dapat mengajukan peminjaman, admin dapat melakukan approval, serta semua riwayat tercatat dengan rapi.</p>
        </div>
    </section>
    <!-- Feature Section -->
    <section id="features" class="py-16 bg-gradient-to-r from-blue-50 to-purple-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-purple-700 text-center mb-10 flex items-center justify-center gap-2"><i class="fa-solid fa-star"></i> Fitur Unggulan</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md p-6 text-center flex flex-col items-center">
                    <div class="text-blue-600 text-4xl mb-2"><i class="fa-solid fa-box"></i></div>
                    <h3 class="font-semibold text-xl mb-2">Manajemen Alat</h3>
                    <p class="text-gray-600">Data alat elektronik terkelola rapi, mudah ditambah, edit, dan hapus oleh admin.</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center flex flex-col items-center">
                    <div class="text-purple-600 text-4xl mb-2"><i class="fa-solid fa-pen-to-square"></i></div>
                    <h3 class="font-semibold text-xl mb-2">Peminjaman & Pengembalian</h3>
                    <p class="text-gray-600">Mahasiswa dapat mengajukan peminjaman dan mengembalikan alat secara online.</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center flex flex-col items-center">
                    <div class="text-blue-600 text-4xl mb-2"><i class="fa-solid fa-user-check"></i></div>
                    <h3 class="font-semibold text-xl mb-2">Approval Admin</h3>
                    <p class="text-gray-600">Admin dapat menyetujui atau menolak permintaan peminjaman dengan mudah.</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center flex flex-col items-center">
                    <div class="text-purple-600 text-4xl mb-2"><i class="fa-solid fa-chart-bar"></i></div>
                    <h3 class="font-semibold text-xl mb-2">Riwayat & Statistik</h3>
                    <p class="text-gray-600">Semua riwayat peminjaman tercatat dan tersedia statistik alat & peminjaman.</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center flex flex-col items-center">
                    <div class="text-blue-600 text-4xl mb-2"><i class="fa-solid fa-lock"></i></div>
                    <h3 class="font-semibold text-xl mb-2">Login Role-based</h3>
                    <p class="text-gray-600">Akses sistem aman, login terpisah untuk admin dan mahasiswa.</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center flex flex-col items-center">
                    <div class="text-purple-600 text-4xl mb-2"><i class="fa-solid fa-bolt"></i></div>
                    <h3 class="font-semibold text-xl mb-2">Akses Mudah</h3>
                    <p class="text-gray-600">Aplikasi dapat diakses kapan saja dan di mana saja melalui browser.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-6 mt-10 shadow-inner">
        <div class="container mx-auto px-6 text-center">
            &copy; <?= date('Y') ?> Peminjaman Alat Elektronik UNU. All rights reserved.
        </div>
    </footer>
</body>
</html> 