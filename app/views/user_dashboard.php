<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa - UNU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        safelist: [
          "backdrop-blur", "backdrop-blur-md", "bg-white/30", "border-white/30", "shadow-2xl",
          "bg-white/40", "bg-white/50", "bg-white/80", "border", "rounded-2xl"
        ]
      }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
        .sticky-header th { position: sticky; top: 0; background: rgba(255,255,255,0.5); backdrop-filter: blur(8px); z-index: 2; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-200/60 via-purple-200/60 to-white min-h-screen flex flex-col">
    <!-- Header Glass -->
    <header class="backdrop-blur bg-white/30 border-b border-white/30 shadow-2xl sticky top-0 z-30">
        <div class="container mx-auto flex justify-between items-center py-3 px-6">
            <div class="flex items-center gap-2 text-xl font-bold text-blue-800 drop-shadow"><i class="fa-solid fa-house"></i> Dashboard Mahasiswa</div>
            <div class="relative group">
                <button class="flex items-center gap-2 font-semibold focus:outline-none text-blue-900"><i class="fa-solid fa-user-circle text-2xl"></i><span class="hidden md:inline">Mahasiswa</span><i class="fa-solid fa-chevron-down text-xs"></i></button>
                <div class="absolute right-0 mt-2 w-40 bg-white/80 backdrop-blur border border-white/30 text-gray-700 rounded shadow-lg py-2 opacity-0 group-hover:opacity-100 group-focus:opacity-100 transition pointer-events-none group-hover:pointer-events-auto">
                    <a href="index.php?controller=auth&action=logout" class="block px-4 py-2 hover:bg-blue-100 flex items-center gap-2"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Statistik Card Glass -->
    <section class="container mx-auto mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="backdrop-blur bg-white/30 border border-white/30 shadow-2xl rounded-2xl flex flex-col items-center py-8 hover:scale-105 transition cursor-pointer">
            <i class="fa-solid fa-laptop text-4xl mb-2 text-blue-700 drop-shadow"></i>
            <div class="text-4xl font-bold animate-pulse text-blue-900 drop-shadow"><?= $totalAlat ?></div>
            <div class="text-lg font-semibold text-blue-700">Total Alat</div>
        </div>
        <div class="backdrop-blur bg-white/30 border border-white/30 shadow-2xl rounded-2xl flex flex-col items-center py-8 hover:scale-105 transition cursor-pointer">
            <i class="fa-solid fa-circle-check text-4xl mb-2 text-green-600 drop-shadow"></i>
            <div class="text-4xl font-bold animate-pulse text-green-700 drop-shadow"><?= $tersedia ?></div>
            <div class="text-lg font-semibold text-green-700">Tersedia</div>
        </div>
        <div class="backdrop-blur bg-white/30 border border-white/30 shadow-2xl rounded-2xl flex flex-col items-center py-8 hover:scale-105 transition cursor-pointer">
            <i class="fa-solid fa-clock text-4xl mb-2 text-yellow-500 drop-shadow"></i>
            <div class="text-4xl font-bold animate-pulse text-yellow-600 drop-shadow"><?= $dipinjam ?></div>
            <div class="text-lg font-semibold text-yellow-600">Dipinjam</div>
        </div>
    </section>
    <!-- Daftar Alat Elektronik Glass -->
    <section class="container mx-auto mt-10">
        <div class="backdrop-blur bg-white/30 border border-white/30 shadow-2xl rounded-2xl p-8">
            <div class="flex justify-between items-center mb-6">
                <div class="font-bold text-xl flex items-center gap-2 text-blue-800 drop-shadow"><i class="fa-solid fa-list"></i> Daftar Alat Elektronik</div>
            </div>
            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full bg-white/30 backdrop-blur border border-white/30 rounded-lg shadow-2xl text-sm">
                    <thead class="bg-white/50 sticky-header">
                        <tr>
                            <th class="px-3 py-2 border-b">ID</th>
                            <th class="px-3 py-2 border-b">Nama Alat</th>
                            <th class="px-3 py-2 border-b">Kategori</th>
                            <th class="px-3 py-2 border-b">Status</th>
                            <th class="px-3 py-2 border-b">Kondisi</th>
                            <th class="px-3 py-2 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alatList as $a): ?>
                        <tr class="border-b hover:bg-blue-100/40 even:bg-white/20">
                            <td class="px-3 py-2"> <?= $a['id'] ?> </td>
                            <td class="px-3 py-2"> <?= htmlspecialchars($a['nama']) ?> </td>
                            <td class="px-3 py-2"> <?= htmlspecialchars($a['kategori']) ?> </td>
                            <td class="px-3 py-2">
                                <?php if($a['status']==='tersedia'): ?>
                                    <span class="inline-flex items-center gap-1 bg-green-100/80 text-green-700 px-2 py-1 rounded text-xs font-semibold" title="Alat tersedia"><i class="fa-solid fa-circle-check"></i> Tersedia</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 bg-yellow-100/80 text-yellow-700 px-2 py-1 rounded text-xs font-semibold" title="Alat sedang dipinjam"><i class="fa-solid fa-clock"></i> Dipinjam</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-3 py-2"> <?= htmlspecialchars($a['kondisi']) ?> </td>
                            <td class="px-3 py-2">
                                <?php if($a['status']==='tersedia'): ?>
                                    <form method="post" class="inline">
                                        <input type="hidden" name="id" value="<?= $a['id'] ?>">
                                        <button type="submit" name="pinjam" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-1 rounded shadow hover:scale-105 transition flex items-center gap-2"><i class="fa-solid fa-arrow-right-arrow-left"></i> Pinjam</button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-gray-400 italic">Tidak tersedia</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Riwayat Peminjaman Glass -->
    <section class="container mx-auto mt-10 mb-10">
        <div class="backdrop-blur bg-white/30 border border-white/30 shadow-2xl rounded-2xl p-8">
            <div class="font-bold text-xl flex items-center gap-2 mb-6 text-blue-800 drop-shadow"><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Peminjaman Saya</div>
            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full bg-white/30 backdrop-blur border border-white/30 rounded-lg shadow-2xl text-sm">
                    <thead class="bg-white/50 sticky-header">
                        <tr>
                            <th class="px-3 py-2 border-b">ID</th>
                            <th class="px-3 py-2 border-b">Nama Alat</th>
                            <th class="px-3 py-2 border-b">Tanggal Pinjam</th>
                            <th class="px-3 py-2 border-b">Tanggal Kembali</th>
                            <th class="px-3 py-2 border-b">Status</th>
                            <th class="px-3 py-2 border-b">Keperluan</th>
                            <th class="px-3 py-2 border-b">Persetujuan</th>
                            <th class="px-3 py-2 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peminjamanList as $p): ?>
                        <tr class="border-b hover:bg-blue-100/40 even:bg-white/20">
                            <td class="px-3 py-2"> <?= $p['id'] ?> </td>
                            <td class="px-3 py-2"> <?= htmlspecialchars($p['nama_alat'] ?? '-') ?> </td>
                            <td class="px-3 py-2"> <?= htmlspecialchars($p['tanggal_pinjam'] ?? '-') ?> </td>
                            <td class="px-3 py-2"> <?= htmlspecialchars($p['tanggal_kembali'] ?? '-') ?> </td>
                            <td class="px-3 py-2">
                                <?php if($p['status']==='dipinjam'): ?>
                                    <span class="inline-flex items-center gap-1 bg-yellow-100/80 text-yellow-700 px-2 py-1 rounded text-xs font-semibold" title="Alat sedang dipinjam"><i class="fa-solid fa-clock"></i> Dipinjam</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 bg-green-100/80 text-green-700 px-2 py-1 rounded text-xs font-semibold" title="Alat tersedia"><i class="fa-solid fa-circle-check"></i> <?= htmlspecialchars($p['status']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-3 py-2"> <?= htmlspecialchars($p['keperluan'] ?? '-') ?> </td>
                            <td class="px-3 py-2">
                                <?php if($p['status_persetujuan']==='pending'): ?>
                                    <span class="inline-flex items-center gap-1 bg-blue-100/80 text-blue-700 px-2 py-1 rounded text-xs font-semibold" title="Menunggu persetujuan admin"><i class="fa-solid fa-hourglass-half"></i> Menunggu</span>
                                <?php elseif($p['status_persetujuan']==='disetujui'): ?>
                                    <span class="inline-flex items-center gap-1 bg-green-100/80 text-green-700 px-2 py-1 rounded text-xs font-semibold" title="Disetujui admin"><i class="fa-solid fa-circle-check"></i> Disetujui</span>
                                <?php elseif($p['status_persetujuan']==='ditolak'): ?>
                                    <span class="inline-flex items-center gap-1 bg-red-100/80 text-red-700 px-2 py-1 rounded text-xs font-semibold" title="Ditolak admin"><i class="fa-solid fa-circle-xmark"></i> Ditolak</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-semibold">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-3 py-2">
                                <?php if($p['status']==='dipinjam' && $p['status_persetujuan']==='disetujui'): ?>
                                    <form method="post" class="inline">
                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                        <button type="submit" name="kembalikan" class="bg-gradient-to-r from-green-500 to-cyan-500 text-white px-4 py-1 rounded shadow hover:scale-105 transition flex items-center gap-2"><i class="fa-solid fa-rotate-left"></i> Kembalikan</button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-gray-400 italic">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <footer class="backdrop-blur bg-white/30 border-t border-white/30 text-blue-900 py-6 w-full text-center shadow-inner mt-auto sticky bottom-0 z-20 font-semibold">
        &copy; <?= date('Y') ?> Peminjaman Alat Elektronik UNU. All rights reserved.
    </footer>
</body>
</html> 