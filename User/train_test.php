<?php

// Membaca data dari file CSV
$csv_file = 'data_bibit_cengkeh.csv';
$data = array_map('str_getcsv', file($csv_file));
$headers = array_shift($data); // Mengambil header

// Bagi data menjadi data latih dan data uji
$data_latih = [];
$data_uji = [];
foreach ($data as $row) {
    if (rand(0, 9) < 7) { // 70% data untuk data latih
        $data_latih[] = array_combine($headers, $row);
    } else { // 30% data untuk data uji
        $data_uji[] = array_combine($headers, $row);
    }
}

echo "Jumlah data latih: " . count($data_latih) . "\n";
echo "Jumlah data uji: " . count($data_uji);

?>
