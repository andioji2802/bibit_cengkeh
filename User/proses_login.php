<?php
session_start();
include 'config.php';

date_default_timezone_set('Asia/Makassar');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['identifier']) && isset($_POST['password'])) {
        $identifier = $_POST['identifier']; // Bisa username, email, nama, atau no_hp
        $password = $_POST['password'];

        // Establish database connection
        $koneksi = new Koneksi();
        $conn = $koneksi->kondb();

        // Check database connection
        if (!$conn) {
            echo "<script>alert('Koneksi ke database gagal.');</script>";
            exit();
        }

        // Query to check if identifier exists in the database
        $query = "SELECT * FROM users WHERE username = ? OR email = ? OR nama = ? OR no_hp = ?";
        $stmt = $conn->prepare($query);

        // Check if prepare statement was successful
        if ($stmt) {
            $stmt->bind_param("ssss", $identifier, $identifier, $identifier, $identifier);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if identifier exists
            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                // Verify password
                if (password_verify($password, $user['password'])) {
                    // Password matched, set session variables
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email']; // Optionally set email if needed

                    // Update waktu login
                    $now = date('Y-m-d H:i:s');
                    $stmt = $conn->prepare("UPDATE users SET login_time = ? WHERE id = ?");
                    $stmt->bind_param("si", $now, $user['id']);
                    $stmt->execute();

                    // Redirect to index page
                    header("Location: index.php");
                    exit();
                } else {
                    // Incorrect password
                    echo "<script>alert('Password salah.');</script>";
                    header("Location: login.php?login=failed");
                    exit();
                }
            } else {
                // Identifier not found
                echo "<script>alert('Pengguna tidak ditemukan.');</script>";
                header("Location: login.php?login=failed");
                exit();
            }
        } else {
            // Display error if prepare statement failed
            echo "<script>alert('Error: " . $conn->error . "');</script>";
            header("Location: login.php");
            exit();
        }
    } else {
        // If identifier or password not provided
        echo "<script>alert('Silakan isi form login dengan benar.');</script>";
        header("Location: login.php");
        exit();
    }
} else {
    // If request method is not POST
    echo "<script>alert('Metode request tidak valid.');</script>";
    header("Location: login.php");
    exit();
}
?>
