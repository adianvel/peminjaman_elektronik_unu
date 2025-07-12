-- Script untuk menambahkan sistem persetujuan
-- Jalankan script ini di phpMyAdmin atau MySQL client

USE peminjaman_elektronik_unu;

-- Tambah kolom untuk sistem persetujuan
ALTER TABLE peminjaman 
ADD COLUMN status_persetujuan ENUM('pending', 'disetujui', 'ditolak') DEFAULT 'pending' AFTER status,
ADD COLUMN tanggal_persetujuan DATETIME NULL AFTER status_persetujuan,
ADD COLUMN admin_persetujuan VARCHAR(50) NULL AFTER tanggal_persetujuan,
ADD COLUMN catatan_admin TEXT NULL AFTER admin_persetujuan;

-- Update status peminjaman yang sudah ada menjadi 'disetujui'
UPDATE peminjaman SET status_persetujuan = 'disetujui' WHERE status = 'dipinjam' OR status = 'dikembalikan';

-- Tambah foreign key untuk admin yang menyetujui
ALTER TABLE peminjaman 
ADD CONSTRAINT fk_admin_persetujuan 
FOREIGN KEY (admin_persetujuan) REFERENCES users(username) ON DELETE SET NULL;

-- Update enum status peminjaman untuk menambah status 'menunggu_persetujuan'
ALTER TABLE peminjaman 
MODIFY COLUMN status ENUM('menunggu_persetujuan', 'dipinjam', 'dikembalikan', 'ditolak') DEFAULT 'menunggu_persetujuan';

-- Update status alat untuk tidak langsung berubah saat pengajuan
-- Alat tetap 'tersedia' sampai disetujui admin
