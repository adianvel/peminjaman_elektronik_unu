<?php
require_once __DIR__ . '/../config/Database.php';

// 1. Abstract class User (Abstract, Property, Method, Access Modifier)
abstract class User {
    protected $username;
    protected $nama;
    protected $role;
    protected $db;

    public function __construct($username, $nama, $role) {
        $this->db = new Database();
        $this->username = $username;
        $this->nama = $nama;
        $this->role = $role;
    }

    public function getUsername() { return $this->username; }
    public function getNama() { return $this->nama; }
    public function getRole() { return $this->role; }

    // 2. Abstract method (Polymorphism)
    abstract public function getDashboardUrl();

    // 3. Static method login (Magic method, OOP)
    public static function login($username, $password) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            if ($user['role'] === 'admin') {
                return new Admin($user['username'], $user['nama']);
            } else {
                return new Mahasiswa($user['username'], $user['nama'], $user['nim']);
            }
        }
        return false;
    }
}

// 4. Inheritance & Polymorphism
class Admin extends User {
    public function __construct($username, $nama) {
        parent::__construct($username, $nama, 'admin');
    }
    public function getDashboardUrl() {
        return 'index.php?controller=admin&action=dashboard';
    }
}

class Mahasiswa extends User {
    private $nim;
    public function __construct($username, $nama, $nim) {
        parent::__construct($username, $nama, 'mahasiswa');
        $this->nim = $nim;
    }
    public function getDashboardUrl() {
        return 'index.php?controller=user&action=dashboard';
    }
    public function getNim() { return $this->nim; }
} 