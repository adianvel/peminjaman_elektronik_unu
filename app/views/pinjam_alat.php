<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Peminjaman Alat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-blue-600 shadow text-white">
        <div class="container mx-auto flex justify-between items-center py-3 px-6">
            <div class="flex items-center gap-2 text-xl font-bold">
                <i class="fa-solid fa-pen-to-square"></i>
                Form Peminjaman Alat
            </div>
        </div>
    </header>
    <main class="flex-1 flex flex-col justify-center items-center py-8">
        <div class="w-full max-w-lg bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-blue-700 mb-6 text-center flex items-center gap-2"><i class="fa-solid fa-pen-to-square"></i> Form Peminjaman Alat</h2>
            <?php if (!empty($error)): ?>
                <div class="mb-4 p-2 bg-red-100 text-red-700 rounded flex items-center gap-2"><i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($error) ?> </div>
            <?php endif; ?>
            <form method="post" class="flex flex-col gap-4">
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
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded shadow hover:scale-105 transition flex items-center gap-2 justify-center"><i class="fa-solid fa-paper-plane"></i> Pinjam</button>
            </form>
            <a href="index.php?controller=mahasiswa&action=landing" class="block mt-6 text-blue-600 hover:underline text-center"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
        </div>
    </main>
    <footer class="bg-blue-600 text-white py-4 w-full mt-10 text-center shadow-inner">
        &copy; <?= date('Y') ?> Peminjaman Alat Elektronik UNU. All rights reserved.
    </footer>
</body>
</html> 