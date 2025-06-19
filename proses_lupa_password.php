<?php
require 'config.php'; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil input dari form lupa_password.php
    $identifier = $_POST['identifier'];

    // Cek apakah yang lupa adalah admin atau pengguna biasa
    // Asumsikan tabel `admin` dan `users` memiliki kolom `email`, `username`, `no_hp`, dan `nama` yang bisa digunakan sebagai identifier

    // Cek di tabel admin dulu
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = :identifier OR username = :identifier OR phone = :identifier OR name = :identifier");
    $stmt->execute(['identifier' => $identifier]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        // Jika akun admin ditemukan, arahkan ke form ubah data admin
        header("Location: ubah_admin.php?identifier=" . urlencode($identifier));
        exit();
    }

    // Cek di tabel pengguna jika tidak ditemukan di admin
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :identifier OR username = :identifier OR no_hp = :identifier OR nama = :identifier");
    $stmt->execute(['identifier' => $identifier]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Jika akun pengguna ditemukan, arahkan ke register.php dengan data pengguna yang sudah diisi
        header("Location: ubah_user.php?identifier=" . urlencode($identifier));
        exit();
    } else {
        // Jika tidak ditemukan, kembalikan pesan error
        header("Location: lupa_password.php?error=Data tidak ditemukan");
        exit();
    }
} else {
    // Jika bukan metode POST, redirect ke halaman form
    header("Location: lupa_password.php");
    exit();
}
?>
