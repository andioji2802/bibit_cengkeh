<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
require_once 'autoload.php';
require_once 'bayes.php'; 

// Mengambil data dari form
$namaBibit = $_POST['jenis'] ?? '';
$ciriDaun = $_POST['ciri_daun'] ?? '';
$ciriBatang = $_POST['ciri_batang'] ?? '';
$tinggiBibit = $_POST['tinggi_bibit'] ?? '';
$umurBibit = $_POST['umur_bibit'] ?? '';
$ciriAkar = $_POST['ciri_akar'] ?? '';

// Load data latih dari file JSON
$data = 'cengkeh.json';
$json = file_get_contents($data);
$data_latih = json_decode($json, true);

// Menggunakan Naive Bayes untuk klasifikasi
$bayes = new NaiveBayes();
$bayes->train($data_latih);

$input_data = [
    'daun' => $ciriDaun,
    'batang' => $ciriBatang,
    'tinggi' => $tinggiBibit,
    'umur' => $umurBibit,
    'akar' => $ciriAkar
];

$hasil = $bayes->predict($input_data);
$proses_detail = $bayes->predictDetail($input_data);

// Data riwayat
$log_entry = [
  'nama_pengguna' => $_SESSION['username'], // Nama pengguna
  'jenis_bibit' => $namaBibit,
  'ciri_daun' => $ciriDaun,
  'ciri_batang' => $ciriBatang,
  'tinggi_bibit' => $tinggiBibit,
  'umur_bibit' => $umurBibit,
  'ciri_akar' => $ciriAkar,
  'kualitas' => $hasil,
  'time' => date('Y-m-d H:i:s'), // Waktu saat pencarian
  'proses_detail' => json_encode($proses_detail)
];

// Simpan data riwayat ke database
include '../User/config.php';
$db = new Koneksi();
$conn = $db->kondb();

$stmt = $conn->prepare("INSERT INTO riwayat (nama_pengguna, jenis_bibit, ciri_daun, ciri_batang, tinggi_bibit, umur_bibit, ciri_akar, kualitas, time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $log_entry['nama_pengguna'], $log_entry['jenis_bibit'], $log_entry['ciri_daun'], $log_entry['ciri_batang'], $log_entry['tinggi_bibit'], $log_entry['umur_bibit'], $log_entry['ciri_akar'], $log_entry['kualitas'], $log_entry['time']);
$stmt->execute();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="img/cengkeh.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/fontawesome.css" />
    <link rel="stylesheet" href="css/brands.css" />
    <link rel="stylesheet" href="css/solid.css" />

    <link rel="stylesheet" href="css/gaya.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet">

    <title>Bibit Cengkeh AI</title>
    <style>
        .hasil-klasifikasi {
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .hasil-klasifikasi.berkualitas {
            background-color: #d0e9ff;
            border: 1px solid #b0c4de;
        }

        .hasil-klasifikasi.tidak-berkualitas {
            background-color: #fddfdf;
            border: 1px solid #fbb1b1;
        }

        .hasil-klasifikasi h2 {
            color: #363732;
        }

        .hasil-klasifikasi p {
            font-size: 18px;
        }

        .detail-perhitungan {
            margin-top: 20px;
        }

        .detail-perhitungan table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-perhitungan th, .detail-perhitungan td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .detail-perhitungan th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="img/cengkeh.png" alt="" width=50 height=50>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Bibit AI
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="riwayat.php">Riwayat</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : $_SESSION['nama']; ?>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profil.php">Profil</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
  
<div class="container">
    <div class="hasil-klasifikasi <?php echo ($hasil === 'Berkualitas') ? 'berkualitas' : 'tidak-berkualitas'; ?>">
        <h2>Kesimpulan</h2>
        <p>
            Berdasarkan perhitungan menggunakan metode Naive Bayes, bibit cengkeh ini dikategorikan sebagai 
            <strong><?php echo $hasil; ?></strong>, Berikut adalah hasil probabilitas dari klasifikasi yang dilakukan:
        </p>
        <p><strong>Berkualitas:</strong> <?php echo number_format($proses_detail['Berkualitas'], 12); ?></p>
        <p><strong>Tidak Berkualitas:</strong> <?php echo number_format($proses_detail['Tidak Berkualitas'], 12); ?></p>
    </div>
</div>


</body>
</html>
