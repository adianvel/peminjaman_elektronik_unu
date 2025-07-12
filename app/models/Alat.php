<?php
require_once __DIR__ . '/../config/Database.php';

class Alat {
    private $id;
    private $nama;
    private $kategori;
    private $status;
    private $kondisi;
    private $db;

    public function __construct($id = null, $nama = null, $kategori = null, $status = 'tersedia', $kondisi = 'baik') {
        $this->db = new Database();
        $this->id = $id;
        $this->nama = $nama;
        $this->kategori = $kategori;
        $this->status = $status;
        $this->kondisi = $kondisi;
    }

    public function getId() { return $this->id; }
    public function getNama() { return $this->nama; }
    public function getKategori() { return $this->kategori; }
    public function getStatus() { return $this->status; }
    public function getKondisi() { return $this->kondisi; }

    public static function getAll() {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query('SELECT * FROM alat');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 