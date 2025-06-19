<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../Admin/login_admin.php");
    exit();
}

// Muat konfigurasi database
require '../Admin/config.php';

// Ambil username dari parameter GET jika ada
$username = isset($_GET['username']) ? $_GET['username'] : '';

if ($username && $username !== 'All') {
    $query = "SELECT * FROM riwayat WHERE nama_pengguna = :username";
} else {
    $query = "SELECT * FROM riwayat";
}

// Eksekusi query
try {
    
    $stmt = $pdo->prepare($query);

    // Bind parameter jika diperlukan
    if ($username && $username !== 'All') {
        $stmt->bindParam(':username', $username);
    }

    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat User</title>
    <link rel="icon" href="../Gambar/gambar/dashboard.png" type="image/png">
    <link rel="stylesheet" href="../Admin/styles.css">
    <style>
          #detailModal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
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
    <header>
        <h1>Riwayat User</h1>
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
        <form method="get" action="">
            <label for="username">Filter:</label>
            <select name="username" id="username" onchange="this.form.submit()">
                <option value="">-- Pilih --</option>
                <option value="All" <?php echo $username === 'All' ? 'selected' : ''; ?>>All</option>
                <?php
                // Menampilkan daftar username untuk filter
                try {
                    $stmt = $pdo->query("SELECT DISTINCT nama_pengguna FROM riwayat");
                    $users = $stmt->fetchAll(PDO::FETCH_COLUMN);
                    
                    foreach ($users as $user) {
                        echo '<option value="' . htmlspecialchars($user) . '" ' . ($username === $user ? 'selected' : '') . '>' . htmlspecialchars($user) . '</option>';
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </select>
        </form>

        <table>
            <thead>
                <tr>
                    <?php if ($username === '' || $username === 'All'): ?>
                        <th>Nama Pengguna</th>
                    <?php endif; ?>
                    <th>Jenis Bibit</th>
                    <th>Ciri Daun</th>
                    <th>Ciri Batang</th>
                    <th>Tinggi Bibit</th>
                    <th>Umur Bibit</th>
                    <th>Ciri Akar</th>
                    <th>Kualitas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="<?php echo ($username === '' || $username === 'All') ? '10' : '9'; ?>">Tidak ada data yang ditemukan.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <?php if ($username === '' || $username === 'All'): ?>
                                <td><?php echo htmlspecialchars($row['nama_pengguna']); ?></td>
                            <?php endif; ?>
                            <td><?php echo htmlspecialchars($row['jenis_bibit']); ?></td>
                            <td><?php echo htmlspecialchars($row['ciri_daun']); ?></td>
                            <td><?php echo htmlspecialchars($row['ciri_batang']); ?></td>
                            <td><?php echo htmlspecialchars($row['tinggi_bibit']); ?></td>
                            <td><?php echo htmlspecialchars($row['umur_bibit']); ?></td>
                            <td><?php echo htmlspecialchars($row['ciri_akar']); ?></td>
                            <td><?php echo htmlspecialchars($row['kualitas']); ?></td>
                            
                            <td>
                                <button onclick="showDetails('<?php echo htmlspecialchars($row['jenis_bibit']); ?>', 
                                                             '<?php echo htmlspecialchars($row['ciri_daun']); ?>', 
                                                             '<?php echo htmlspecialchars($row['ciri_batang']); ?>', 
                                                             '<?php echo htmlspecialchars($row['tinggi_bibit']); ?>', 
                                                             '<?php echo htmlspecialchars($row['umur_bibit']); ?>', 
                                                             '<?php echo htmlspecialchars($row['ciri_akar']); ?>', 
                                                             '<?php echo htmlspecialchars($row['kualitas']); ?>')">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Rincian Penilaian Bibit</h2>
            <table id="detailTable">
                <!-- Detail content will be inserted here -->
            </table>
            <div id="probabilityResult">
                <!-- Probability results will be inserted here -->
            </div>
            <button onclick="window.print()" style="margin-top: 20px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Cetak
        </button>
        </div>
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
    <script src="js/jquery.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    // Get the modal
    var modal = document.getElementById("detailModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function showDetails(jenis_bibit, ciri_daun, ciri_batang, tinggi_bibit, umur_bibit, ciri_akar, kualitas) {
        const detailTable = document.getElementById('detailTable');
        const probabilityResult = document.getElementById('probabilityResult');

        // Populate the detail table
        detailTable.innerHTML = `
            <tr><th>Jenis Bibit</th><td>${jenis_bibit}</td></tr>
            <tr><th>Ciri Daun</th><td>${ciri_daun}</td></tr>
            <tr><th>Ciri Batang</th><td>${ciri_batang}</td></tr>
            <tr><th>Tinggi Bibit</th><td>${tinggi_bibit}</td></tr>
            <tr><th>Umur Bibit</th><td>${umur_bibit}</td></tr>
            <tr><th>Ciri Akar</th><td>${ciri_akar}</td></tr>
            <tr><th>Kualitas</th><td>${kualitas}</td></tr>
        `;

        // Fetch probability details from the server
        fetch('../User/bayes_detail.php', {
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
            // Display probability results
            probabilityResult.innerHTML = `
                <h3>Perbandingan Kualitas Bibit</h3>
                <p><strong>Berkualitas:</strong> ${data.probabilitas['Berkualitas']}</p>
                <p><strong>Tidak Berkualitas:</strong> ${data.probabilitas['Tidak Berkualitas']}</p>
                <p><strong>Kesimpulan:</strong> Berdasarkan hasil probabilitas perhitungan metode Naive Bayes, bibit cengkeh ini dinyatakan <strong>${data.kualitas}</strong>.</p>
            `;

            // Show the modal
            modal.style.display = "block";
        })
        .catch(error => console.error('Error:', error));
    }
    </script>
</body>
</html>