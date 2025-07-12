<?php
require_once __DIR__ . '/../config/Database.php';

class Peminjaman {
    private $id;
    private $idAlat;
    private $username;
    private $status;
    private $statusPersetujuan;
    private $db;

    public function __construct($id = null, $idAlat = null, $username = null, $status = 'menunggu_persetujuan', $statusPersetujuan = 'pending') {
        $this->db = new Database();
        $this->id = $id;
        $this->idAlat = $idAlat;
        $this->username = $username;
        $this->status = $status;
        $this->statusPersetujuan = $statusPersetujuan;
    }

    public function getId() { return $this->id; }
    public function getIdAlat() { return $this->idAlat; }
    public function getUsername() { return $this->username; }
    public function getStatus() { return $this->status; }
    public function getStatusPersetujuan() { return $this->statusPersetujuan; }

    public static function getAll() {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query('SELECT p.*, a.nama AS nama_alat, a.kategori AS kategori_alat, a.kondisi AS kondisi_alat FROM peminjaman p LEFT JOIN alat a ON p.id_alat = a.id');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 