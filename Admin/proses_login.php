<?php
session_start();
include '../Admin/config.php';

// Mengambil input dari form
$identifier = $_POST['identifier'];
$password = $_POST['password'];

// Query untuk memeriksa kredensial login
$sql = "SELECT * FROM admin WHERE (username = ? OR email = ? OR name = ? OR phone = ?) AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $identifier, $identifier, $identifier, $identifier, $password);
$stmt->execute();
$result = $stmt->get_result();

// Memeriksa apakah login berhasil
if ($result->num_rows > 0) {
    $_SESSION['admin_logged_in'] = true;
    $admin = $result->fetch_assoc();
        // Set session admin_id
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
    header("Location: ../Admin/dashboard.php"); // Mengarahkan ke halaman dashboard setelah login sukses
    exit();
} else {
    echo "<script>alert('Username atau Password salah.'); window.location.href='login_admin.php?login=failed';</script>";
    exit();
}

$stmt->close();
$conn->close();
?>
