<?php
session_start();
include 'Admin/config.php';

// Cek apakah form sudah diisi
if (isset($_POST['identifier']) && isset($_POST['new_password'])) {
    $identifier = $_POST['identifier'];
    $new_password = $_POST['new_password'];

    // Hash password baru
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Buat koneksi ke database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("<script>alert('Koneksi gagal: " . $conn->connect_error . "'); window.location.href='login.php';</script>");
    }

    // Query untuk memeriksa apakah identifier (username/email/name/phone) ada di database
    $sql = "SELECT * FROM admin WHERE username = ? OR email = ? OR name = ? OR phone = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("<script>alert('Gagal mempersiapkan query: " . $conn->error . "'); window.location.href='login.php';</script>");
    }

    $stmt->bind_param("ssss", $identifier, $identifier, $identifier, $identifier);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("<script>alert('Error saat eksekusi query: " . $stmt->error . "'); window.location.href='login.php';</script>");
    }

    // Jika data ditemukan
    if ($result->num_rows > 0) {
        // Update password di database
        $sql_update = "UPDATE admin SET password = ? WHERE username = ? OR email = ? OR name = ? OR phone = ?";
        $stmt_update = $conn->prepare($sql_update);

        if (!$stmt_update) {
            die("<script>alert('Gagal mempersiapkan query update: " . $conn->error . "'); window.location.href='login.php';</script>");
        }

        $stmt_update->bind_param("sssss", $hashed_password, $identifier, $identifier, $identifier, $identifier);

        if ($stmt_update->execute()) {
            echo "<script>alert('Password berhasil direset. Silakan login dengan password baru.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat mereset password: " . $stmt_update->error . "'); window.location.href='login.php';</script>";
        }
        $stmt_update->close();
    } else {
        // Jika identifier tidak ditemukan
        echo "<script>alert('Data tidak ditemukan.'); window.location.href='login.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    // Jika form tidak lengkap
    echo "<script>alert('Form tidak lengkap!'); window.location.href='login.php';</script>";
}
?>
