<?php
class AdminController {
    public function dashboard() {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login'); exit;
        }
        $user = $_SESSION['user'];
        $msg = '';
        // Proses approval
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Approval peminjaman
            if (isset($_POST['id']) && isset($_POST['aksi'])) {
                $id = $_POST['id'];
                $aksi = $_POST['aksi'];
                $db = new Database();
                $conn = $db->getConnection();
                if ($aksi === 'approve') {
                    $stmt = $conn->prepare('UPDATE peminjaman SET status = ?, status_persetujuan = ?, admin_persetujuan = ? WHERE id = ?');
                    $stmt->execute(['dipinjam', 'disetujui', $user['username'], $id]);
                } elseif ($aksi === 'reject') {
                    $stmt = $conn->prepare('UPDATE peminjaman SET status = ?, status_persetujuan = ?, admin_persetujuan = ? WHERE id = ?');
                    $stmt->execute(['ditolak', 'ditolak', $user['username'], $id]);
                }
                header('Location: index.php?controller=admin&action=dashboard'); exit;
            }
            // Tambah alat
            if (isset($_POST['tambah_alat'])) {
                $nama = $_POST['nama'] ?? '';
                $kategori = $_POST['kategori'] ?? '';
                $kondisi = $_POST['kondisi'] ?? 'baik';
                if ($nama && $kategori) {
                    $db = new Database();
                    $conn = $db->getConnection();
                    $stmt = $conn->prepare('INSERT INTO alat (nama, kategori, status, kondisi) VALUES (?, ?, ?, ?)');
                    $stmt->execute([$nama, $kategori, 'tersedia', $kondisi]);
                    $msg = 'Alat berhasil ditambahkan!';
                } else {
                    $msg = 'Nama dan kategori alat wajib diisi!';
                }
            }
            // Edit alat
            if (isset($_POST['edit_alat'])) {
                $id = $_POST['id'] ?? '';
                $nama = $_POST['nama'] ?? '';
                $kategori = $_POST['kategori'] ?? '';
                $kondisi = $_POST['kondisi'] ?? '';
                $status = $_POST['status'] ?? '';
                if ($id && $nama && $kategori && $kondisi && $status) {
                    $db = new Database();
                    $conn = $db->getConnection();
                    $stmt = $conn->prepare('UPDATE alat SET nama=?, kategori=?, kondisi=?, status=? WHERE id=?');
                    $stmt->execute([$nama, $kategori, $kondisi, $status, $id]);
                    $msg = 'Alat berhasil diupdate!';
                } else {
                    $msg = 'Semua field alat wajib diisi!';
                }
            }
            // Hapus alat
            if (isset($_POST['hapus_alat'])) {
                $id = $_POST['id'] ?? '';
                if ($id) {
                    $db = new Database();
                    $conn = $db->getConnection();
                    $stmt = $conn->prepare('DELETE FROM alat WHERE id=?');
                    $stmt->execute([$id]);
                    $msg = 'Alat berhasil dihapus!';
                }
            }
            // Tambah user
            if (isset($_POST['tambah_user'])) {
                $username = $_POST['username'] ?? '';
                $nama = $_POST['nama'] ?? '';
                $role = $_POST['role'] ?? '';
                $password = $_POST['password'] ?? '';
                $nim = $_POST['nim'] ?? null;
                if ($username && $nama && $role && $password) {
                    $db = new Database();
                    $conn = $db->getConnection();
                    $stmt = $conn->prepare('INSERT INTO users (username, nama, role, password, nim) VALUES (?, ?, ?, ?, ?)');
                    $stmt->execute([$username, $nama, $role, $password, $nim]);
                    $msg = 'User berhasil ditambahkan!';
                } else {
                    $msg = 'Semua field user wajib diisi!';
                }
            }
            // Edit user
            if (isset($_POST['edit_user'])) {
                $username = $_POST['username'] ?? '';
                $nama = $_POST['nama'] ?? '';
                $role = $_POST['role'] ?? '';
                $password = $_POST['password'] ?? '';
                $nim = $_POST['nim'] ?? null;
                if ($username && $nama && $role) {
                    $db = new Database();
                    $conn = $db->getConnection();
                    if ($password) {
                        $stmt = $conn->prepare('UPDATE users SET nama=?, role=?, password=?, nim=? WHERE username=?');
                        $stmt->execute([$nama, $role, $password, $nim, $username]);
                    } else {
                        $stmt = $conn->prepare('UPDATE users SET nama=?, role=?, nim=? WHERE username=?');
                        $stmt->execute([$nama, $role, $nim, $username]);
                    }
                    $msg = 'User berhasil diupdate!';
                } else {
                    $msg = 'Semua field user wajib diisi!';
                }
            }
            // Hapus user
            if (isset($_POST['hapus_user'])) {
                $username = $_POST['username'] ?? '';
                if ($username) {
                    $db = new Database();
                    $conn = $db->getConnection();
                    $stmt = $conn->prepare('DELETE FROM users WHERE username=?');
                    $stmt->execute([$username]);
                    $msg = 'User berhasil dihapus!';
                }
            }
        }
        // Statistik alat
        $alatList = Alat::getAll();
        $totalAlat = count($alatList);
        $tersedia = count(array_filter($alatList, function($a) { return $a['status'] === 'tersedia'; }));
        $dipinjam = count(array_filter($alatList, function($a) { return $a['status'] === 'dipinjam'; }));
        // Statistik peminjaman
        $peminjamanList = Peminjaman::getAll();
        $totalPeminjaman = count($peminjamanList);
        $pendingApproval = array_filter($peminjamanList, function($p) { return $p['status_persetujuan'] === 'pending'; });
        $jumlahPending = count($pendingApproval);
        // Daftar user
        $db = new Database();
        $conn = $db->getConnection();
        $userList = $conn->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
        include __DIR__ . '/../views/admin_dashboard.php';
    }
} 