<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include '../User/config.php';
$db = new Koneksi();
$conn = $db->kondb();

// Set default timezone to WITA (Central Indonesia Time)
date_default_timezone_set('Asia/Makassar');

// Cek dan ambil data dari POST
$timestamp = isset($_POST['timestamp']) ? $_POST['timestamp'] : '';

// Pastikan timestamp ada dan valid
if ($timestamp) {
    // Hapus data berdasarkan timestamp
    $sql = "DELETE FROM riwayat WHERE time = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $timestamp);
    if ($stmt->execute()) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();

// Redirect kembali ke riwayat.php
header("Location: riwayat.php");
exit();
