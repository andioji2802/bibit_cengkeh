<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../Admin/login_admin.php");
    exit();
}

if (!isset($_POST['report_type'])) {
    die("No report type selected");
}

$report_type = $_POST['report_type'];

switch ($report_type) {
    case 'manajemen_pengguna':
        $file = 'dashboard.php';
        break;
    case 'dataset':
        $file = 'dataset.php';
        break;
    case 'riwayat':
        $file = 'riwayat_user.php';
        break;
    default:
        die("Invalid report type");
}

ob_start();
include $file;
$content = ob_get_clean();

// Hapus pesan error atau notice
$content = preg_replace('/<b>Notice<\/b>:.*?<br \/>/s', '', $content);
$content = preg_replace('/<b>Warning<\/b>:.*?<br \/>/s', '', $content);

// Hapus elemen yang tidak perlu dicetak (kalau perlu, sesuaikan ini)
$content = preg_replace('/<nav.*?<\/nav>/s', '', $content);
$content = preg_replace('/<div class="footer">.*?<\/div>/s', '', $content);

// Tampilkan konten yang sudah dimodifikasi
echo $content;
?>
