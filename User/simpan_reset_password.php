<?php
include 'User/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn = (new Koneksi())->kondb();

    $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
    $stmt->bind_param("si", $password, $id);

    if ($stmt->execute()) {
        echo "Password updated successfully.";
        header('Location: login.php?reset=success');
        exit();
    } else {
        echo "Error updating password: " . $stmt->error;
        header('Location: ubah_user.php?error=Gagal memperbarui kata sandi. Silakan coba lagi.');
        exit();
    }
}
?>
