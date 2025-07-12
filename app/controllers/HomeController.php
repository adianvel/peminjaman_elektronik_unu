<?php
class HomeController {
    public function index() {
        $alat = Alat::getAll();
        $peminjaman = Peminjaman::getAll();
        include __DIR__ . '/../views/home.php';
    }
} 