<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../Admin/login_admin.php");
    exit();
}

// Mengambil data JSON
$data = '../User/cengkeh.json';
$json = file_get_contents($data);
$hasil = json_decode($json, true);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dataset</title>
    <link rel="icon" href="../Gambar/gambar/dashboard.png" type="image/png">
    <link rel="stylesheet" href="../Admin/styles.css">
    <link rel="stylesheet" href="css/datatables.css">
</head>
<body>
    <header>
        <h1>Dataset</h1>
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
        <div class="container">
            <div class="row">
                <div class="col-12 mt-5">
                    <table id="dataLatih" class="display pt-3 mb-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jenis</th>
                                <th>Ciri Daun</th>
                                <th>Ciri Batang</th>
                                <th>Tinggi Bibit</th>
                                <th>Umur Bibit</th>
                                <th>Ciri Akar</th>
                                <th>Kualitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($hasil as $item) {
                                $kualitas = $item['kualitas'] == "Berkualitas" ? "Berkualitas" : "Tidak Berkualitas";
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($item['jenis']); ?></td>
                                    <td><?php echo htmlspecialchars($item['daun']); ?></td>
                                    <td><?php echo htmlspecialchars($item['batang']); ?></td>
                                    <td><?php echo htmlspecialchars($item['tinggi']); ?></td>
                                    <td><?php echo htmlspecialchars($item['umur']); ?></td>
                                    <td><?php echo htmlspecialchars($item['akar']); ?></td>
                                    <td>
                                        <?php echo $kualitas == "Berkualitas" ? "<span class='badge badge-success' style='padding:10px'>Berkualitas</span>" : "<span class='badge badge-danger' style='padding:10px'>Tidak Berkualitas</span>"; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
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

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="js/jquery.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/datatables.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataLatih').dataTable({
                "pageLength": 50
            });
        });
    </script>
</body>
</html>
