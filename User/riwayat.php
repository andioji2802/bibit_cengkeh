<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

include '../User/config.php';
$db = new Koneksi();
$conn = $db->kondb();

// Set default timezone to WITA (Asia/Makassar)
date_default_timezone_set('Asia/Makassar');

// Query untuk mengambil data dari tabel riwayat sesuai dengan pengguna yang sedang login
$sql = "SELECT * FROM riwayat WHERE nama_pengguna = ? AND is_deleted = FALSE ORDER BY time DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']); // Pastikan 'username' disimpan di session saat login
$stmt->execute();
$result = $stmt->get_result();

// Inisialisasi array untuk menyimpan hasil query
$logs = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Format waktu dari UTC ke WITA (Asia/Makassar)
        $datetime = new DateTime($row['time'], new DateTimeZone('Asia/Makassar'));
        $row['local_time'] = $datetime->format('d/m/Y H:i:s');
        $logs[] = $row;
    }
}


// Pagination
$entries_per_page_options = [10, 50, 100, 200];
$entries_per_page = isset($_GET['entries']) && in_array((int)$_GET['entries'], $entries_per_page_options) ? (int)$_GET['entries'] : 10;
$total_logs = count($logs);
$total_pages = ceil($total_logs / $entries_per_page);
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_page = max(1, min($total_pages, $current_page));
$start_index = ($current_page - 1) * $entries_per_page;
$logs = array_slice($logs, $start_index, $entries_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/x-icon" href="img/cengkeh.png" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/fontawesome.css" />
  <link rel="stylesheet" href="css/brands.css" />
  <link rel="stylesheet" href="css/solid.css" />
  <link rel="stylesheet" href="css/gaya.css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet">
  <title>Riwayat Aktivitas Pengguna</title>
  <style>
    .table-container {
      margin-top: 30px;
    }
    .table-container th, .table-container td {
      text-align: center;
      border: 2px solid black !important;
    }
    .table-container thead th {
      background-color: #1E90FF;
      color: white;
    }
    .table-container tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    .table-container tbody tr:hover {
      background-color: #ddd;
    }
    .user-select {
      margin: 20px 0;
    }
    .page-link {
      color: #4CAF50;
    }
    .page-link:hover {
      color: #3e8e41;
    }
    .page-item.active .page-link {
      background-color: #1E90FF;
      border-color: #4CAF50;
    }
    /* Tambahkan gaya untuk kotak detail */
.detail-box {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 20px;
    background-color: #fafafa;
}

.detail-box h3 {
    margin-bottom: 10px;
    color: #333;
}

.detail-box p {
    font-size: 16px;
    color: #666;
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
        <li class="nav-item">
          <a class="nav-link" href="index.php">Bibit AI</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="riwayat.php">Riwayat</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : $_SESSION['nama']; ?>
            <?php
$profile_photo = "profile_photos/" . $_SESSION['username'] . ".jpg";
if (file_exists($profile_photo)):
?>
    <img src="<?php echo $profile_photo; ?>" alt="Profile Photo" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
<?php endif; ?>
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
<br>
<br>
<br>
<br>
<div class="container">
  <h3 class="tebal">Riwayat</h3>
  <div class="user-select">
    <form method="GET">
      <label for="entriesSelect">Entries</label>
      <select id="entriesSelect" name="entries" class="form-control" onchange="this.form.submit()">
        <?php foreach ($entries_per_page_options as $option): ?>
          <option value="<?php echo $option; ?>" <?php echo $entries_per_page == $option ? 'selected' : ''; ?>><?php echo $option; ?></option>
        <?php endforeach; ?>
      </select>
    </form>
  </div>

  <div class="table-container">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Jenis Bibit</th>
          <th>Daun</th>
          <th>Batang</th>
          <th>Tinggi</th>
          <th>Umur</th>
          <th>Akar</th>
          <th>Kualitas</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
  <?php foreach ($logs as $log): ?>
    <tr>
      <td><?php echo htmlspecialchars($log['jenis_bibit']); ?></td>
      <td><?php echo htmlspecialchars($log['ciri_daun']); ?></td>
      <td><?php echo htmlspecialchars($log['ciri_batang']); ?></td>
      <td><?php echo htmlspecialchars($log['tinggi_bibit']); ?></td>
      <td><?php echo htmlspecialchars($log['umur_bibit']); ?></td>
      <td><?php echo htmlspecialchars($log['ciri_akar']); ?></td>
      <td><?php echo htmlspecialchars($log['kualitas']); ?></td>
      <td>
        <form method="POST" action="hapus_riwayat.php" style="display:inline;">
          <input type="hidden" name="timestamp" value="<?php echo htmlspecialchars($log['time']); ?>">
          <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
        </form>
        <button class="btn btn-info btn-sm" onclick="showDetails(
        '<?php echo htmlspecialchars($log['jenis_bibit']); ?>', '<?php echo htmlspecialchars($log['ciri_daun']); ?>',
         '<?php echo htmlspecialchars($log['ciri_batang']); ?>', '<?php echo htmlspecialchars($log['tinggi_bibit']); ?>',
          '<?php echo htmlspecialchars($log['umur_bibit']); ?>', '<?php echo htmlspecialchars($log['ciri_akar']); ?>', 
          '<?php echo htmlspecialchars($log['kualitas']); ?>')">Detail</button>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>
    </table>
    <div id="detailContainer" style="display:none;">
  <h4>Rincian Penilaian Bibit</h4>
  <table class="table table-bordered detail-box">
    <thead>
      <tr>
        <th>Jenis Bibit</th>
        <th>Ciri Daun</th>
        <th>Ciri Batang</th>
        <th>Tinggi Bibit</th>
        <th>Umur Bibit</th>
        <th>Ciri Akar</th>
        <th>Kualitas</th>
      </tr>
    </thead>
    <tbody id="detailContent">
      <!-- Detail akan diisi di sini melalui JavaScript -->
    </tbody>
  </table>
  <div class="detail-box mt-3">
    <h5>Perbandingan Kualitas Bibit</h5>
    <p id="probabilityResult"></p>
  </div>
</div>

</div>

  </div>

  <!-- Pagination -->
  <nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
      <li class="page-item <?php if($current_page == 1) echo 'disabled'; ?>">
        <a class="page-link" href="?page=<?php echo $current_page - 1; ?>&user=<?php echo $selected_user; ?>&entries=<?php echo $entries_per_page; ?>">Previous</a>
      </li>
      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?php if ($current_page == $i) echo 'active'; ?>">
          <a class="page-link" href="?page=<?php echo $i; ?>&user=<?php echo $selected_user; ?>&entries=<?php echo $entries_per_page; ?>"><?php echo $i; ?></a>
        </li>
      <?php endfor; ?>
      <li class="page-item <?php if($current_page == $total_pages) echo 'disabled'; ?>">
        <a class="page-link" href="?page=<?php echo $current_page + 1; ?>&user=<?php echo $selected_user; ?>&entries=<?php echo $entries_per_page; ?>">Next</a>
      </li>
    </ul>
  </nav>
</div>

<footer class="page-footer font-small abu1 mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12 py-5">
        <div class="mb-5 d-flex justify-content-center">
          <a class="icn" href="https://www.instagram.com/andioji_28/" target="_blank">
            <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
          <a class="icn" href="https://github.com/andioji2802" target="_blank">
            <i class="fab fa-github fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
          <a class="icn" href="https://twitter.com/andi_khozin" target="_blank">
            <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"></i>
          </a>
          <a class="icn" href="https://www.facebook.com/andioji.imf" target="_blank">
            <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"></i>
          </a>
          <a class="icn" href="https://wa.me/6285399833542?text=Assalamu'alaikum" target="_blank">
            <i class="fab fa-whatsapp fa-lg white-text mr-md-5 mr-3 fa-2x"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-copyright text-center py-3 abu2">© <?php echo date('Y'); ?> Copyright
    <a href="https://github.com/andioji2802">@akmaznur2802</a>
  </div>
</footer>

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
  function showDetails(jenis_bibit, ciri_daun, ciri_batang, tinggi_bibit, umur_bibit, ciri_akar, kualitas) {
    const detailContainer = document.getElementById('detailContainer');
    const detailContent = document.getElementById('detailContent');

    // Kirim data ke server untuk mendapatkan detail Naive Bayes
    fetch('bayes_detail.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams({
        jenis_bibit: jenis_bibit,
        ciri_daun: ciri_daun,
        ciri_batang: ciri_batang,
        tinggi_bibit: tinggi_bibit,
        umur_bibit: umur_bibit,
        ciri_akar: ciri_akar,
        kualitas: kualitas
      })
    })
    .then(response => response.json())
    .then(data => {
      // Tampilkan hasil detail di area detailContent
      detailContent.innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
      detailContainer.style.display = 'block';
    })
    .catch(error => console.error('Error:', error));
  }

  function showDetails(jenis_bibit, ciri_daun, ciri_batang, tinggi_bibit, umur_bibit, ciri_akar, kualitas) {
  const detailContainer = document.getElementById('detailContainer');
  const detailContent = document.getElementById('detailContent');
  const probabilityResult = document.getElementById('probabilityResult');

  // Kirim data ke server untuk mendapatkan detail Naive Bayes
  fetch('bayes_detail.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: new URLSearchParams({
      jenis_bibit: jenis_bibit,
      ciri_daun: ciri_daun,
      ciri_batang: ciri_batang,
      tinggi_bibit: tinggi_bibit,
      umur_bibit: umur_bibit,
      ciri_akar: ciri_akar,
      kualitas: kualitas
    })
  })
  .then(response => response.json())
  .then(data => {
    // Tampilkan detail di area detailContent
    detailContent.innerHTML = `
      <tr>
        <td>${jenis_bibit}</td>
        <td>${ciri_daun}</td>
        <td>${ciri_batang}</td>
        <td>${tinggi_bibit}</td>
        <td>${umur_bibit}</td>
        <td>${ciri_akar}</td>
        <td>${data.kualitas}</td>
      </tr>
    `;
      // Tampilkan hasil probabilitas dan kesimpulan
      const berkualitas = data.berkualitas;
      const tidakBerkualitas = data.tidak_berkualitas;
      const kesimpulan = berkualitas > tidakBerkualitas ? "Berkualitas" : "Tidak Berkualitas";

    // Tampilkan hasil Naive Bayes
    probabilityResult.innerHTML = `
  <strong>Berkualitas:</strong> ${data.probabilitas['Berkualitas']}<br>
  <strong>Tidak Berkualitas:</strong> ${data.probabilitas['Tidak Berkualitas']}<br>
  <strong>Kesimpulan:</strong> Berdasarkan hasil probabilitas perhitungan metode naive bayes, bahwa bibit cengkeh ini <strong>${data.kualitas}</strong>.
`;
    detailContainer.style.display = 'block';
  })
  .catch(error => console.error('Error:', error));
}
</script>
</body>
</html>
