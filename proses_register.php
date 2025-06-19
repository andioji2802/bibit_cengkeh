<?php
// Include koneksi database
require_once 'configg.php';

$koneksi = new Koneksi();
$conn = $koneksi->kondb();

// Ambil data dari form registrasi
$nama = $_POST['nama'];
$username = $_POST['username'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$password = $_POST['password'];

// Enkripsi password sebelum disimpan
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Query untuk menyimpan data pengguna ke database
$sql = "INSERT INTO users (nama, username, email, no_hp, password) 
        VALUES ('$nama', '$username', '$email', '$no_hp', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    // Jika registrasi sukses, redirect ke halaman login
    header("Location: login.php");
    exit();
} else {
    // Jika terjadi kesalahan saat menyimpan data
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
