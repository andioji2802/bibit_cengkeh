<?php
session_start();
include '../Admin/config.php';

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login_admin.php");
    exit();
}

// Ambil admin_id dari session
$admin_id = $_SESSION['admin_id'];

// Ambil data dari form edit
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Query untuk mengupdate data admin
$sql = "UPDATE admin SET name = ?, email = ?, phone = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $name, $email, $phone, $admin_id);

if ($stmt->execute()) {
    // Redirect kembali ke halaman profil setelah update berhasil
    header("Location: profil.php");
    exit();
} else {
    echo "Gagal mengupdate profil.";
}

$stmt->close();
$conn->close();
?>
