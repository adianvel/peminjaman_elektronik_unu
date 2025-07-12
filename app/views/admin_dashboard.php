<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - UNU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
        .sticky-header th { position: sticky; top: 0; background: rgba(255,255,255,0.5); backdrop-filter: blur(8px); z-index: 2; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-200/60 via-purple-200/60 to-white min-h-screen flex flex-col">
    <!-- Header Glass -->
    <header class="backdrop-blur bg-white/30 border-b border-white/30 shadow-2xl sticky top-0 z-30">
        <div class="container mx-auto flex justify-between items-center py-3 px-6">
            <div class="flex items-center gap-2 text-xl font-bold text-blue-800 drop-shadow"><i class="fa-solid fa-gear"></i> Admin Dashboard - UNU</div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 font-semibold text-blue-900">
                    <i class="fa-solid fa-user-circle text-2xl"></i>
                    <span class="hidden md:inline">Administrator</span>
                </div>
                <a href="index.php?controller=auth&action=logout" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-lg shadow hover:scale-105 transition flex items-center gap-2"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </div>
    </header>
    <!-- Statistik Card Glass -->
    <section class="container mx-auto mt-8 grid grid-cols-1 md:grid-cols-4 gap-6">
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
        <div class="backdrop-blur bg-white/30 border border-white/30 shadow-2xl rounded-2xl flex flex-col items-center py-8 hover:scale-105 transition cursor-pointer">
            <i class="fa-solid fa-rotate-right text-4xl mb-2 text-cyan-500 drop-shadow"></i>
            <div class="text-4xl font-bold animate-pulse text-cyan-600 drop-shadow"><?= $totalPeminjaman ?></div>
            <div class="text-lg font-semibold text-cyan-600">Total Peminjaman</div>
        </div>
    </section>
    <!-- Daftar Alat Elektronik Glass -->
    <section class="container mx-auto mt-10">
        <div class="backdrop-blur bg-white/30 border border-white/30 shadow-2xl rounded-2xl p-8">
            <div class="flex justify-between items-center mb-6">
                <div class="font-bold text-xl flex items-center gap-2 text-blue-800 drop-shadow"><i class="fa-solid fa-list"></i> Daftar Alat Elektronik</div>
                <button onclick="document.getElementById('formTambahAlat').classList.toggle('hidden')" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-5 py-2 rounded-lg shadow hover:scale-105 transition flex items-center gap-2"><i class="fa-solid fa-plus"></i> Tambah Alat</button>
            </div>
            <form id="formTambahAlat" method="post" class="mb-4 hidden bg-white/40 backdrop-blur border border-white/30 p-4 rounded-lg">
                <div class="flex flex-wrap gap-2 items-end">
                    <input type="text" name="nama" placeholder="Nama Alat" required class="border border-white/30 bg-white/30 backdrop-blur rounded px-3 py-2">
                    <input type="text" name="kategori" placeholder="Kategori" required class="border border-white/30 bg-white/30 backdrop-blur rounded px-3 py-2">
                    <input type="text" name="kondisi" placeholder="Kondisi" value="baik" required class="border border-white/30 bg-white/30 backdrop-blur rounded px-3 py-2">
                    <button type="submit" name="tambah_alat" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded shadow hover:scale-105 transition">Tambah</button>
                </div>
            </form>
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
                            <form method="post" class="contents">
                                <td class="px-3 py-2"> <?= $a['id'] ?> <input type="hidden" name="id" value="<?= $a['id'] ?>"> </td>
                                <td class="px-3 py-2"> <input type="text" name="nama" value="<?= htmlspecialchars($a['nama']) ?>" class="border border-white/30 bg-white/30 backdrop-blur rounded px-2 py-1 w-full"> </td>
                                <td class="px-3 py-2"> <input type="text" name="kategori" value="<?= htmlspecialchars($a['kategori']) ?>" class="border border-white/30 bg-white/30 backdrop-blur rounded px-2 py-1 w-full"> </td>
                                <td class="px-3 py-2">
                                    <?php if($a['status']==='tersedia'): ?>
                                        <span class="inline-flex items-center gap-1 bg-green-100/80 text-green-700 px-2 py-1 rounded text-xs font-semibold" title="Alat tersedia"><i class="fa-solid fa-circle-check"></i> Tersedia</span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1 bg-yellow-100/80 text-yellow-700 px-2 py-1 rounded text-xs font-semibold" title="Alat sedang dipinjam"><i class="fa-solid fa-clock"></i> Dipinjam</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-3 py-2"> <input type="text" name="kondisi" value="<?= htmlspecialchars($a['kondisi']) ?>" class="border border-white/30 bg-white/30 backdrop-blur rounded px-2 py-1 w-full"> </td>
                                <td class="px-3 py-2 flex gap-1">
                                    <button type="submit" name="edit_alat" class="bg-green-500/80 text-white px-2 py-1 rounded hover:bg-green-600/90" title="Edit"><i class="fa-solid fa-pen"></i></button>
                                    <button type="submit" name="hapus_alat" onclick="return confirm('Yakin hapus alat ini?')" class="bg-red-500/80 text-white px-2 py-1 rounded hover:bg-red-600/90" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </form>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Approval Peminjaman Glass -->
    <section class="container mx-auto mt-10">
        <div class="backdrop-blur bg-white/30 border border-white/30 shadow-2xl rounded-2xl p-8">
            <div class="font-bold text-xl flex items-center gap-2 mb-6 text-blue-800 drop-shadow"><i class="fa-solid fa-gavel"></i> Approval Peminjaman</div>
            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full bg-white/30 backdrop-blur border border-white/30 rounded-lg shadow-2xl text-sm">
                    <thead class="bg-white/50 sticky-header">
                        <tr>
                            <th class="px-3 py-2 border-b">ID</th>
                            <th class="px-3 py-2 border-b">Nama Alat</th>
                            <th class="px-3 py-2 border-b">Peminjam</th>
                            <th class="px-3 py-2 border-b">Keperluan</th>
                            <th class="px-3 py-2 border-b">Status</th>
                            <th class="px-3 py-2 border-b">Persetujuan</th>
                            <th class="px-3 py-2 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peminjamanList as $p): ?>
                            <?php if ($p['status_persetujuan'] === 'pending'): ?>
                                <tr class="border-b hover:bg-blue-100/40 even:bg-white/20">
                                    <td class="px-3 py-2"> <?= $p['id'] ?> </td>
                                    <td class="px-3 py-2"> <?= htmlspecialchars($p['nama_alat'] ?? '-') ?> </td>
                                    <td class="px-3 py-2"> <?= htmlspecialchars($p['username']) ?> </td>
                                    <td class="px-3 py-2"> <?= htmlspecialchars($p['keperluan'] ?? '-') ?> </td>
                                    <td class="px-3 py-2">
                                        <?php if($p['status']==='dipinjam'): ?>
                                            <span class="inline-flex items-center gap-1 bg-yellow-100/80 text-yellow-700 px-2 py-1 rounded text-xs font-semibold" title="Alat sedang dipinjam"><i class="fa-solid fa-clock"></i> Dipinjam</span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 bg-green-100/80 text-green-700 px-2 py-1 rounded text-xs font-semibold" title="Alat tersedia"><i class="fa-solid fa-circle-check"></i> <?= htmlspecialchars($p['status']) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-3 py-2">
                                        <span class="inline-flex items-center gap-1 bg-blue-100/80 text-blue-700 px-2 py-1 rounded text-xs font-semibold"><i class="fa-solid fa-hourglass-half"></i> Menunggu</span>
                                    </td>
                                    <td class="px-3 py-2 flex gap-1">
                                        <form method="post" class="inline">
                                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                            <button type="submit" name="aksi" value="approve" class="bg-green-500/80 text-white px-2 py-1 rounded hover:bg-green-600/90" title="Approve"><i class="fa-solid fa-check"></i></button>
                                            <button type="submit" name="aksi" value="reject" class="bg-red-500/80 text-white px-2 py-1 rounded hover:bg-red-600/90" title="Tolak"><i class="fa-solid fa-xmark"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Riwayat Semua Peminjaman Glass -->
    <section class="container mx-auto mt-10">
        <div class="backdrop-blur bg-white/30 border border-white/30 shadow-2xl rounded-2xl p-8">
            <div class="font-bold text-xl flex items-center gap-2 mb-6 text-blue-800 drop-shadow"><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Semua Peminjaman</div>
            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full bg-white/30 backdrop-blur border border-white/30 rounded-lg shadow-2xl text-sm">
                    <thead class="bg-white/50 sticky-header">
                        <tr>
                            <th class="px-3 py-2 border-b">ID</th>
                            <th class="px-3 py-2 border-b">Nama Alat</th>
                            <th class="px-3 py-2 border-b">Peminjam</th>
                            <th class="px-3 py-2 border-b">NIM</th>
                            <th class="px-3 py-2 border-b">Tanggal Pinjam</th>
                            <th class="px-3 py-2 border-b">Tanggal Kembali</th>
                            <th class="px-3 py-2 border-b">Status</th>
                            <th class="px-3 py-2 border-b">Keperluan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peminjamanList as $h): ?>
                        <tr class="border-b hover:bg-blue-100/40 even:bg-white/20">
                            <td class="px-3 py-2"> <?= $h['id'] ?> </td>
                            <td class="px-3 py-2"> <?= htmlspecialchars($h['nama_alat'] ?? '-') ?> </td>
                            <td class="px-3 py-2"> <?= htmlspecialchars($h['username']) ?> </td>
                            <td class="px-3 py-2"> <?= htmlspecialchars($h['nim'] ?? '-') ?> </td>
                            <td class="px-3 py-2"> <?= htmlspecialchars($h['tanggal_pinjam'] ?? '-') ?> </td>
                            <td class="px-3 py-2"> <?= htmlspecialchars($h['tanggal_kembali'] ?? '-') ?> </td>
                            <td class="px-3 py-2">
                                <?php if($h['status_persetujuan']==='pending'): ?>
                                    <span class="inline-flex items-center gap-1 bg-blue-100/80 text-blue-700 px-2 py-1 rounded text-xs font-semibold" title="Menunggu persetujuan admin"><i class="fa-solid fa-hourglass-half"></i> Menunggu_persetujuan</span>
                                <?php elseif($h['status_persetujuan']==='disetujui'): ?>
                                    <span class="inline-flex items-center gap-1 bg-green-100/80 text-green-700 px-2 py-1 rounded text-xs font-semibold" title="Disetujui admin"><i class="fa-solid fa-circle-check"></i> Disetujui</span>
                                <?php elseif($h['status_persetujuan']==='ditolak'): ?>
                                    <span class="inline-flex items-center gap-1 bg-red-100/80 text-red-700 px-2 py-1 rounded text-xs font-semibold" title="Ditolak admin"><i class="fa-solid fa-circle-xmark"></i> Ditolak</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-semibold">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-3 py-2"> <?= htmlspecialchars($h['keperluan'] ?? '-') ?> </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Daftar User Glass -->
    <section class="container mx-auto mt-10 mb-10">
        <div class="backdrop-blur bg-white/30 border border-white/30 shadow-2xl rounded-2xl p-8">
            <div class="font-bold text-xl flex items-center gap-2 mb-6 text-blue-800 drop-shadow"><i class="fa-solid fa-users"></i> Daftar User</div>
            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full bg-white/30 backdrop-blur border border-white/30 rounded-lg shadow-2xl text-sm">
                    <thead class="bg-white/50 sticky-header">
                        <tr>
                            <th class="px-3 py-2 border-b">Username</th>
                            <th class="px-3 py-2 border-b">Nama</th>
                            <th class="px-3 py-2 border-b">Role</th>
                            <th class="px-3 py-2 border-b">Password</th>
                            <th class="px-3 py-2 border-b">NIM</th>
                            <th class="px-3 py-2 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($userList as $u): ?>
                        <tr class="border-b hover:bg-blue-100/40 even:bg-white/20">
                            <form method="post" class="contents">
                                <td class="px-3 py-2"><input type="text" name="username" value="<?= htmlspecialchars($u['username']) ?>" readonly class="border border-white/30 bg-white/30 backdrop-blur rounded px-2 py-1 w-full"></td>
                                <td class="px-3 py-2"><input type="text" name="nama" value="<?= htmlspecialchars($u['nama']) ?>" required class="border border-white/30 bg-white/30 backdrop-blur rounded px-2 py-1 w-full"></td>
                                <td class="px-3 py-2"><input type="text" name="role" value="<?= htmlspecialchars($u['role']) ?>" required class="border border-white/30 bg-white/30 backdrop-blur rounded px-2 py-1 w-full"></td>
                                <td class="px-3 py-2"><input type="text" name="password" placeholder="(isi untuk ganti password)" class="border border-white/30 bg-white/30 backdrop-blur rounded px-2 py-1 w-full"></td>
                                <td class="px-3 py-2"><input type="text" name="nim" value="<?= htmlspecialchars($u['nim'] ?? '') ?>" class="border border-white/30 bg-white/30 backdrop-blur rounded px-2 py-1 w-full"></td>
                                <td class="px-3 py-2 flex gap-1">
                                    <button type="submit" name="edit_user" class="bg-green-500/80 text-white px-2 py-1 rounded hover:bg-green-600/90" title="Edit"><i class="fa-solid fa-pen"></i></button>
                                    <button type="submit" name="hapus_user" onclick="return confirm('Yakin hapus user ini?')" class="bg-red-500/80 text-white px-2 py-1 rounded hover:bg-red-600/90" title="Hapus"><i class="fa-solid fa-trash"></i> Hapus</button>
                                </td>
                            </form>
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
    <script>
        // Otomatis sembunyikan form tambah alat setelah submit
        document.querySelectorAll('form').forEach(f => {
            f.addEventListener('submit', function() {
                if(this.id === 'formTambahAlat') {
                    setTimeout(()=>{ this.classList.add('hidden'); }, 500);
                }
            });
        });
    </script>
</body>
</html> 