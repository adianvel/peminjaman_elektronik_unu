<?php
class MahasiswaController {
    public function landing() {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'mahasiswa') {
            header('Location: index.php?controller=auth&action=login'); exit;
        }
        $user = $_SESSION['user'];
        $alatList = Alat::getAll();
        $peminjamanList = Peminjaman::getAll();
        include __DIR__ . '/../views/mahasiswa_landing.php';
    }

    public function pinjam() {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'mahasiswa') {
            header('Location: index.php?controller=auth&action=login'); exit;
        }
        $user = $_SESSION['user'];
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idAlat = $_POST['id_alat'] ?? '';
            if ($idAlat) {
                $db = new Database();
                $conn = $db->getConnection();
                $stmt = $conn->prepare('INSERT INTO peminjaman (id_alat, username, status, status_persetujuan) VALUES (?, ?, ?, ?)');
                $stmt->execute([$idAlat, $user['username'], 'menunggu_persetujuan', 'pending']);
                header('Location: index.php?controller=mahasiswa&action=landing'); exit;
            } else {
                $error = 'Pilih alat yang ingin dipinjam!';
            }
        }
        $alatList = Alat::getAll();
        include __DIR__ . '/../views/pinjam_alat.php';
    }

    public function kembalikan() {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'mahasiswa') {
            header('Location: index.php?controller=auth&action=login'); exit;
        }
        $user = $_SESSION['user'];
        $idPeminjaman = $_GET['id'] ?? '';
        if ($idPeminjaman) {
            $db = new Database();
            $conn = $db->getConnection();
            $stmt = $conn->prepare('UPDATE peminjaman SET status = ? WHERE id = ? AND username = ?');
            $stmt->execute(['dikembalikan', $idPeminjaman, $user['username']]);
        }
        header('Location: index.php?controller=mahasiswa&action=landing'); exit;
    }
} 