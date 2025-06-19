<?php
session_start();

require_once 'config.php';
date_default_timezone_set('Asia/Makassar');

if (!isset($pdo)) {
    die("Koneksi database tidak berhasil.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['identifier']) && isset($_POST['password'])) {
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];

    try {
        // Cek di tabel admin terlebih dahulu
        $adminQuery = "SELECT * FROM admin WHERE username = :identifier OR email = :identifier OR name = :identifier OR phone = :identifier";
        $stmt = $pdo->prepare($adminQuery);
        $stmt->bindParam(':identifier', $identifier);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            // Untuk admin, kita akan menggunakan perbandingan langsung karena password tidak di-hash
            if ($password === $admin['password']) {
                // Login sebagai admin berhasil
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                header('Location: Admin/dashboard.php');
                exit();
            } else {
                // Password admin salah
                echo "<script>alert('Password salah.');</script>";
                header("Location: login.php?login=failed");
                exit();
            }
        } else {
            // Jika bukan admin, cek di tabel users
            $userQuery = "SELECT * FROM users WHERE username = :identifier OR email = :identifier OR nama = :identifier OR no_hp = :identifier";
            $stmt = $pdo->prepare($userQuery);
            $stmt->bindParam(':identifier', $identifier);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Login sebagai user berhasil
                $_SESSION['username'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = 'user';

                // Catat waktu login user
                $now = date('Y-m-d H:i:s');
                $update_time_query = "UPDATE users SET login_time = :login_time WHERE id = :id";
                $stmt = $pdo->prepare($update_time_query);
                $stmt->bindParam(':login_time', $now);
                $stmt->bindParam(':id', $user['id']);
                $stmt->execute();

                header('Location: User/index.php');
                exit();
            } else {
                // Login gagal
                echo "<script>alert('Password salah.');</script>";
                header("Location: login.php?login=failed");
                exit();
            }
        }
    } catch (PDOException $e) {
        die("Query error: " . $e->getMessage());
    }
} else {
    header('Location: login.php?error=' . urlencode('Data login tidak lengkap'));
    exit();
}
?>