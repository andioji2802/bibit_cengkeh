<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../Admin/login_admin.php");
    exit();
}

// Koneksi ke database
require '../Admin/config.php';

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Admin</title>
    <link rel="icon" href="../Gambar/gambar/dashboard.png" type="image/png">
    <link rel="stylesheet" href="../Admin/styles.css">
    <style>
        .report-selection {
            margin: 20px 0;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }
        select, button {
            padding: 10px;
            margin-right: 10px;
            font-size: 16px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Laporan</h1>
    </header>   

    <nav>
        <ul>
            <li style="display: flex; align-items: center; padding: 20px;">
                <img src="../Admin/img/admin.png" alt="Logo" style="width: 40px; height: auto; margin-right: 10px;">
                <span><a href="../Admin/dashboard.php">Administrator</a></span>
            </li>
            <li><a href="../Admin/dashboard.php">Dashboard</a></li>
            <li><a href="../Admin/dataset.php">Dataset</a></li>
            <li><a href="../Admin/riwayat_user.php">Riwayat User</a></li>
            <li><a href="../Admin/laporan.php">Laporan</a></li>
            <li><a href="../Admin/Profil.php">Profil</a></li>
            <li><a href="../Admin/logout.php">Logout</a></li>
        </ul>
    </nav>

    <div id="main-content">
        <div class="report-selection">
            <h2>Pilih Laporan untuk Dicetak</h2>
            <form id="reportForm" method="POST">
                <select name="report_type" id="reportType" required>
                    <option value="">-- Pilih Jenis Laporan --</option>
                    <option value="manajemen_pengguna">Cetak Manajemen Pengguna</option>
                    <option value="dataset">Cetak Dataset</option>
                    <option value="riwayat">Cetak Riwayat</option>
                </select>
                <button type="button" onclick="printReport()">Cetak</button>
            </form>
        </div>

        <div id="printArea" style="display: none;"></div> <!-- Area untuk menampilkan laporan yang akan dicetak -->
    </div>

    <div class="footer">
        <footer>
            <ul>
                <li><a href="https://www.instagram.com/andioji_28"><img src="../Gambar/gambar/instagram.png" alt="Instagram"></a></li>
                <li><a href="https://www.facebook.com/andioji.imf"><img src="../Gambar/gambar/facebook.png" alt="Facebook"></a></li>
                <li><a href="https://twitter.com/andi_khozin"><img src="../Gambar/gambar/twitter.png" alt="Twitter"></a></li>
                <li><a href="https://wa.me/6285399833542?text=Assalamu'alaikum"><img src="../Gambar/gambar/whatsapp.png" alt="Whatsapp"></a></li>
            </ul>
        </footer>
    </div>

    <script>
    function printReport() {
        var reportType = document.getElementById('reportType').value;
        if (reportType) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.kualitas == 200) {
                    document.getElementById('printArea').innerHTML = this.responseText;
                    var printContents = document.getElementById('printArea').innerHTML;
                    var originalContents = document.body.innerHTML;

                    document.body.innerHTML = printContents;

                    window.print();

                    document.body.innerHTML = originalContents;
                    location.reload(); // Reload halaman agar kembali ke tampilan awal setelah cetak
                }
            };
            xhr.open("POST", "print_report.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("report_type=" + reportType);
        }
    }
    </script>
</body>
</html>
