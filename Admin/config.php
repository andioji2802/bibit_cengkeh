<?php
// Koneksi menggunakan MySQLi (untuk proses_login.php)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cengkeh_db";

// Membuat koneksi MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi MySQLi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Koneksi menggunakan PDO (untuk riwayat_user.php)
try {
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    // Mengatur mode error PDO untuk menampilkan exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
