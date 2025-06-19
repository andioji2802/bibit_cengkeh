<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../Admin/login_admin.php");
    exit();
}

// Koneksi ke database menggunakan PDO
$host = 'localhost';
$dbname = 'cengkeh_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query untuk mengambil data pengguna
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Query untuk mengambil data admin
    $stmt = $pdo->query("SELECT * FROM admin WHERE id = 1");
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->query("SELECT nama_pengguna, 
                     SUM(CASE WHEN kualitas = 'Berkualitas' THEN 1 ELSE 0 END) as berkualitas,
                     SUM(CASE WHEN kualitas = 'Tidak Berkualitas' THEN 1 ELSE 0 END) as tidak_berkualitas
                     FROM riwayat 
                     GROUP BY nama_pengguna");
$barChartData = $stmt->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="icon" href="../Gambar/gambar/dashboard.png" type="image/png">
    <link rel="stylesheet" href="../Admin/styles.css">
    <style>
        @media print {
  body * {
    visibility: hidden;
  }
  .print-only, .print-only * {
    visibility: visible;
  }
  .print-only {
    position: absolute;
    left: 0;
    top: 0;
  }
}
.chart-container {
  width: 100%;
}
.chart-row {
  display: flex;
  justify-content: space-between;
}
.chart {
  width: 48%;
}
@media print {
  .chart-container {
    width: 100%;
    page-break-inside: avoid;
  }
  .chart {
    width: 80%;
    margin: 0 auto;
  }
  canvas {
    max-width: 100% !important;
    height: auto !important;
  }
}
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header class="no-print">
        <h1>Selamat Datang di Dashboard Admin <?php echo htmlspecialchars($admin['name']); ?></h1>
    </header>

    <nav class="no-print">
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
        <!-- Halaman Manajemen Pengguna -->
        <div id="manage_users" class="section no-print">
            <h2>
                Manajemen Pengguna 
                <a href="#" id="refreshUsers" style="margin-left: 10px;"><img src="../Gambar/gambar/Refresh_icon.png" alt="Refresh" style="width:20px; vertical-align: middle;"></a>
            </h2>
            <table class="no-print">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nomor Handphone</th>
                    <th>Aktivitas</th>
                </tr>
                <!-- Isi tabel dengan data dari database -->
                <?php
                $no = 1;
                if (!empty($users)) {
                    foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($user['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['no_hp']) . "</td>";
                        echo "<td>";
                        date_default_timezone_set('Asia/Makassar');
                        $login_time = $user['login_time'] ? date('d/m/Y, H:i', strtotime($user['login_time'])) : 'Belum pernah login';
                        $logout_time = $user['logout_time'] ? date('d/m/Y, H:i', strtotime($user['logout_time'])) : 'Belum pernah logout';
                        echo "Waktu login: " . $login_time . "<br>";
                        echo "Waktu Logout: " . $logout_time . "<br>";                        
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Belum ada data pengguna.</td></tr>";
                }
                ?>
            </table>
        </div>
        
        <div class="chart-container print-only">
  <div class="chart-row">
    <div class="chart">
      <h2>Hasil Kualitas Bibit per Pengguna</h2>
      <canvas id="qualityChart"></canvas>
    </div>
    <div class="chart">
      <h2>Statistik Aktivitas Pengguna</h2>
      <canvas id="activityChart"></canvas>
    </div>
  </div>
</div>
    <div style="text-align: center; margin-top: 20px;" class="no-print">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">Cetak Diagram</button>
    </div>
            <script>
                // Data aktivitas aplikasi
                const data = {
                    labels: ['Pengguna Baru', 'Login', 'Logout'], // Ganti dengan data yang sesuai
                    datasets: [{
                        label: 'Aktivitas Aplikasi',
                        data: [30, 50, 20], // Ganti dengan data yang sesuai
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)', // Warna untuk Pengguna Baru
                            'rgba(153, 102, 255, 0.2)', // Warna untuk Login
                            'rgba(255, 159, 64, 0.2)'  // Warna untuk Logout
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)', // Warna garis untuk Pengguna Baru
                            'rgba(153, 102, 255, 1)', // Warna garis untuk Login
                            'rgba(255, 159, 64, 1)'  // Warna garis untuk Logout
                        ],
                        borderWidth: 1
                    }]
                };
                
                const config = {
                    type: 'pie', // Ubah ke 'doughnut' jika ingin diagram donat
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw + ' (' + (tooltipItem.raw / 100 * 100).toFixed(2) + '%)';
                                    }
                                }
                            }
                        }
                    }
                };
                
                var ctx = document.getElementById('activityChart').getContext('2d');
                new Chart(ctx, config);

                document.addEventListener('DOMContentLoaded', function() {
        // Pie chart code (unchanged)
        const ctx = document.getElementById('activityChart').getContext('2d');
        const activityChart = new Chart(ctx, {
            // ... (pie chart configuration remains the same)
        });

        // New bar chart
        const qualityCtx = document.getElementById('qualityChart').getContext('2d');
        const qualityChart = new Chart(qualityCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($barChartData, 'nama_pengguna')); ?>,
                datasets: [
                    {
                        label: 'Berkualitas',
                        data: <?php echo json_encode(array_column($barChartData, 'berkualitas')); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Tidak Berkualitas',
                        data: <?php echo json_encode(array_column($barChartData, 'tidak_berkualitas')); ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Hasil Kualitas Bibit per Pengguna'
                    }
                }
            }
        });
    });
            </script>
        </div>
    </div>
    <div class="footer">
        <footer>
            <ul>
                <li>
                    <a href="https://www.instagram.com/andioji_28"><img src="../Gambar/gambar/instagram.png" alt="Instagram"></a>
                </li>
                <li>
                    <a href="https://www.facebook.com/andioji.imf"><img src="../Gambar/gambar/facebook.png" alt="Facebook"></a>
                </li>
                <li>
                    <a href="https://twitter.com/andi_khozin"><img src="../Gambar/gambar/twitter.png" alt="Twitter"></a>
                </li>
                <li>
                    <a href="https://wa.me/6285399833542?text=Assalamu'alaikum"><img src="../Gambar/gambar/whatsapp.png" alt="Whatsapp"></a>
                </li>
            </ul>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('activityChart').getContext('2d');
    const activityChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Aktif', 'Tidak Aktif'],
            datasets: [{
                label: 'Status Aktivitas Pengguna',
                data: [<?php echo $activeUsers; ?>, <?php echo $inactiveUsers; ?>],
                backgroundColor: ['#4CAF50', '#FFC107'],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' pengguna';
                        }
                    }
                }
            }
        }
    });
});
</script>
</body>
</html>
