<?php
session_start();
require_once 'bayes.php';

// Ambil data dari POST request
$jenis_bibit = $_POST['jenis_bibit'] ?? '';
$ciri_daun = $_POST['ciri_daun'] ?? '';
$ciri_batang = $_POST['ciri_batang'] ?? '';
$tinggi_bibit = $_POST['tinggi_bibit'] ?? '';
$umur_bibit = $_POST['umur_bibit'] ?? '';
$ciri_akar = $_POST['ciri_akar'] ?? '';
$kualitas = $_POST['kualitas'] ?? ''; // Default to Unknown if not set

// Debug: periksa data yang diterima
error_log("jenis_bibit: $jenis_bibit");
error_log("ciri_daun: $ciri_daun");
error_log("ciri_batang: $ciri_batang");
error_log("tinggi_bibit: $tinggi_bibit");
error_log("umur_bibit: $umur_bibit");
error_log("ciri_akar: $ciri_akar");
error_log("kualitas: $kualitas");

// Load data latih dari file JSON
$data = 'cengkeh.json';
$json = file_get_contents($data);
$data_latih = json_decode($json, true);

// Menggunakan Naive Bayes untuk klasifikasi
$bayes = new NaiveBayes();
$bayes->train($data_latih);

// Ambil detail probabilitas
$proses_detail = $bayes->predictDetail([
  'daun' => $ciri_daun,
  'batang' => $ciri_batang,
  'tinggi' => $tinggi_bibit,
  'umur' => $umur_bibit,
  'akar' => $ciri_akar,
  'kualitas' => $kualitas
]);

// Format hasil untuk ditampilkan
$result = [
  'kualitas' => $kualitas, // Pastikan status dikembalikan dengan benar
  'probabilitas' => $proses_detail
];

// Kembalikan hasil dalam format JSON
header('Content-Type: application/json');
echo json_encode($result);
?>
