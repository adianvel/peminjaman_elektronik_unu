<?php
class AuthController {
    public function login() {
        session_start();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = User::login($username, $password);
            if ($user) {
                $_SESSION['user'] = [
                    'username' => $user->getUsername(),
                    'nama' => $user->getNama(),
                    'role' => $user->getRole(),
                    'nim' => method_exists($user, 'getNim') ? $user->getNim() : null
                ];
                if ($user->getRole() === 'admin') {
                    header('Location: index.php?controller=admin&action=dashboard');
                } else {
                    header('Location: index.php?controller=mahasiswa&action=landing');
                }
                exit;
            } else {
                $error = 'Username atau password salah!';
            }
        }
        include __DIR__ . '/../views/login.php';
    }
    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
    }
} 