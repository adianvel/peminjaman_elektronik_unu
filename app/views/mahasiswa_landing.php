<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
        .sticky-header th { position: sticky; top: 0; background: #f3f4f6; z-index: 2; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header Sticky -->
    <header class="bg-blue-600 shadow text-white sticky top-0 z-30">
        <div class="container mx-auto flex justify-between items-center py-3 px-6">
            <div class="flex items-center gap-2 text-xl font-bold">
                <i class="fa-solid fa-user-graduate"></i>
                Dashboard Mahasiswa
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 font-semibold">
                    <i class="fa-solid fa-user-circle text-2xl"></i>
                    <span class="hidden md:inline"><?= htmlspecialchars($user['nama']) ?></span>
                </div>
                <a href="index.php?controller=auth&action=logout" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-lg shadow hover:scale-105 transition flex items-center gap-2"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </div>
    </header>
    <main class="container mx-auto px-4 flex-1">
        <div class="grid md:grid-cols-3 gap-4 mt-8 mb-8">
            <div class="bg-blue-500 text-white rounded-lg shadow flex flex-col items-center py-6 hover:scale-105 transition cursor-pointer">
                <i class="fa-solid fa-laptop text-4xl mb-2"></i>
                <div class="text-2xl font-bold animate-pulse">
                    <?php $totalAlat = isset($alatList) ? count($alatList) : 0; echo $totalAlat; ?>
                </div>
                <div class="text-lg">Total Alat</div>
            </div>
            <div class="bg-green-600 text-white rounded-lg shadow flex flex-col items-center py-6 hover:scale-105 transition cursor-pointer">
                <i class="fa-solid fa-circle-check text-4xl mb-2"></i>
                <div class="text-2xl font-bold animate-pulse">
                    <?php $tersedia = isset($alatList) ? count(array_filter($alatList, function($a){return $a['status']==='tersedia';})) : 0; echo $tersedia; ?>
                </div>
                <div class="text-lg">Tersedia</div>
            </div>
            <div class="bg-yellow-400 text-white rounded-lg shadow flex flex-col items-center py-6 hover:scale-105 transition cursor-pointer">
                <i class="fa-solid fa-clock text-4xl mb-2"></i>
                <div class="text-2xl font-bold animate-pulse">
                    <?php $dipinjam = isset($alatList) ? count(array_filter($alatList, function($a){return $a['status']==='dipinjam';})) : 0; echo $dipinjam; ?>
                </div>
                <div class="text-lg">Dipinjam</div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4">
                <div>
                    <h2 class="text-2xl font-bold text-blue-700 mb-2 flex items-center gap-2"><i class="fa-solid fa-user"></i> Selamat datang, <span class="text-purple-700"><?= htmlspecialchars($user['nama']) ?> (<?= htmlspecialchars($user['username']) ?>)</span></h2>
                    <p class="mb-2">Role: <span class="font-semibold text-blue-700"><?= htmlspecialchars($user['role']) ?></span></p>
                    <?php if (!empty($user['nim'])): ?>
                        <p class="mb-4">NIM: <span class="font-semibold text-purple-700"><?= htmlspecialchars($user['nim']) ?></span></p>
                    <?php endif; ?>
                </div>
                <?php if ($tersedia > 0): ?>
                <button onclick="document.getElementById('modalPinjam').classList.remove('hidden')" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded shadow hover:scale-105 transition flex items-center gap-2 mt-4 md:mt-0"><i class="fa-solid fa-plus"></i> Ajukan Peminjaman</button>
                <?php endif; ?>
            </div>
            <h3 class="text-xl font-bold text-blue-700 mb-4 flex items-center gap-2"><i class="fa-solid fa-list"></i> Riwayat Peminjaman Saya</h3>
            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full bg-white border rounded-lg shadow text-sm">
                    <thead class="bg-gray-100 sticky-header">
                        <tr>
                            <th class="px-3 py-2 border-b">Nama Alat</th>
                            <th class="px-3 py-2 border-b">Keperluan</th>
                            <th class="px-3 py-2 border-b">Status</th>
                            <th class="px-3 py-2 border-b">Persetujuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $adaData = false; foreach ($peminjamanList as $p): ?>
                            <?php if ($p['username'] === $user['username']): $adaData = true; ?>
                                <tr class="border-b hover:bg-blue-50 even:bg-gray-50">
                                    <td class="px-3 py-2"> <?= htmlspecialchars(($p['nama_alat'] ?? '-')) ?><?php if (!empty($p['kategori_alat'])): ?> (<?= htmlspecialchars($p['kategori_alat']) ?>)<?php endif; ?> </td>
                                    <td class="px-3 py-2"> <?= htmlspecialchars($p['keperluan'] ?? '-') ?> </td>
                                    <td class="px-3 py-2">
                                        <?php if($p['status']==='dipinjam'): ?>
                                            <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-semibold" title="Sedang dipinjam"><i class="fa-solid fa-clock"></i> Dipinjam</span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold" title="Sudah dikembalikan"><i class="fa-solid fa-circle-check"></i> <?= htmlspecialchars($p['status']) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-3 py-2">
                                        <?php if($p['status_persetujuan']==='pending'): ?>
                                            <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-semibold" title="Menunggu persetujuan admin"><i class="fa-solid fa-hourglass-half"></i> Menunggu</span>
                                        <?php elseif($p['status_persetujuan']==='disetujui'): ?>
                                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold" title="Disetujui admin"><i class="fa-solid fa-circle-check"></i> Disetujui</span>
                                        <?php elseif($p['status_persetujuan']==='ditolak'): ?>
                                            <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-semibold" title="Ditolak admin"><i class="fa-solid fa-circle-xmark"></i> Ditolak</span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-semibold">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if (!$adaData): ?>
                            <tr><td colspan="4" class="text-center text-gray-400 py-6">Belum ada riwayat peminjaman.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Pinjam Alat -->
        <div id="modalPinjam" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md relative animate-fadeIn">
                <button onclick="document.getElementById('modalPinjam').classList.add('hidden')" class="absolute top-2 right-2 text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark text-2xl"></i></button>
                <h2 class="text-xl font-bold text-blue-700 mb-4 flex items-center gap-2"><i class="fa-solid fa-pen-to-square"></i> Form Peminjaman Alat</h2>
                <form method="post" action="index.php?controller=mahasiswa&action=pinjam" class="flex flex-col gap-4">
                    <label class="flex flex-col text-gray-700 font-semibold">Pilih Alat:
                        <select name="id_alat" required class="border rounded px-3 py-2 mt-1">
                            <option value="">-- Pilih Alat --</option>
                            <?php foreach ($alatList as $a): ?>
                                <?php if ($a['status'] === 'tersedia'): ?>
                                    <option value="<?= $a['id'] ?>"> <?= htmlspecialchars($a['nama']) ?> (<?= htmlspecialchars($a['kategori']) ?>) - Status: <?= htmlspecialchars($a['status']) ?> </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label class="flex flex-col text-gray-700 font-semibold">Keperluan:
                        <input type="text" name="keperluan" required class="border rounded px-3 py-2 mt-1" placeholder="Contoh: Untuk seminar, belajar, dsb">
                    </label>
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded shadow hover:scale-105 transition flex items-center gap-2 justify-center"><i class="fa-solid fa-paper-plane"></i> Pinjam</button>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-blue-600 text-white py-6 w-full text-center shadow-inner mt-auto sticky bottom-0 z-20">
        &copy; <?= date('Y') ?> Peminjaman Alat Elektronik UNU. All rights reserved.
    </footer>
    <script>
        // Modal close on ESC
        document.addEventListener('keydown', function(e) {
            if(e.key === 'Escape') document.getElementById('modalPinjam').classList.add('hidden');
        });
    </script>
</body>
</html> 