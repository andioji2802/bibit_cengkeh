<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../Admin/login_admin.php");
    exit();
}

$host = 'localhost';
$dbname = 'cengkeh_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query untuk mengambil data admin
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE id = ?");
    $stmt->execute([$_SESSION['admin_id']]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// Menangani form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form edit
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Query untuk mengupdate data admin
    $sql = "UPDATE admin SET name = ?, email = ?, phone = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $phone, $_SESSION['admin_id']]);

    // Redirect kembali ke halaman profil setelah update berhasil
    header("Location: profil.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
    <link rel="icon" href="../Gambar/gambar/dashboard.png" type="image/png">
    <link rel="stylesheet" href="../Admin/styles.css">
</head>
<body>
    <header>
        <h1>Profil Admin</h1>
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
            <li><a href="../Admin/profil.php">Profil</a></li>
            <li><a href="../Admin/logout.php">Logout</a></li>
        </ul>
    </nav>

    <div id="main-content">
        <div class="section">
            <h2>Profil Admin</h2>
            <form action="profil.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($admin['username']); ?>" disabled><br><br>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($admin['password']); ?>" disabled><br><br>
                
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($admin['name']); ?>"><br><br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>"><br><br>
                
                <label for="phone">Nomor Telepon:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($admin['phone']); ?>"><br><br>
                
                <button type="button" id="edit-button">Edit</button>
                <input type="submit" value="Simpan Profil" id="save-button" style="display:none;">
            </form>
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
    <script>
        document.getElementById('edit-button').addEventListener('click', function() {
            var inputs = document.querySelectorAll('form input');
            inputs.forEach(function(input) {
                input.removeAttribute('disabled');
            });
            document.getElementById('edit-button').style.display = 'none';
            document.getElementById('save-button').style.display = 'inline-block';
        });
    </script>
</body>
</html>
