<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}


include 'config.php';
$db = new Koneksi();
$conn = $db->kondb();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timestamp'])) {
    $timestamp = $_POST['timestamp'];
    $username = $_SESSION['username'];

    // Update is_deleted menjadi TRUE alih-alih menghapus data
    $sql = "UPDATE riwayat SET is_deleted = TRUE WHERE nama_pengguna = ? AND time = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $timestamp);
    
    if ($stmt->execute()) {
        header("Location: riwayat.php?status=success");
    } else {
        header("Location: riwayat.php?status=error");
    }
} else {
    header("Location: riwayat.php");
}

$conn->close();
?>