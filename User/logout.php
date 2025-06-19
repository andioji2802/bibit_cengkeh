<?php
session_start();

include 'config.php';

date_default_timezone_set('Asia/Makassar');

$now = date('Y-m-d H:i:s');

// Update waktu logout
if (isset($_SESSION['username'])) { 
    // Establish database connection
    $koneksi = new Koneksi();
    $conn = $koneksi->kondb();

    // Check database connection
    if ($conn) {
        $stmt = $conn->prepare("UPDATE users SET logout_time = ? WHERE username = ?");
        $stmt->bind_param("ss", $now, $_SESSION['username']);
        $stmt->execute();
    }
}

header('Location: ../login.php');
exit;
?>
