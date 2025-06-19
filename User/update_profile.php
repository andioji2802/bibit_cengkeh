<?php
session_start();
require 'config.php';

$conn = (new Koneksi())->kondb();

$id = $_SESSION['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$password = $_POST['password'];

if (!empty($password)) {
  $password = password_hash($password, PASSWORD_DEFAULT);
  $sql = "UPDATE users SET nama=?, username=?, email=?, no_hp=?, password=? WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssi", $nama, $username, $email, $no_hp, $password, $id);
} else {
  $sql = "UPDATE users SET nama=?, username=?, email=?, no_hp=? WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssi", $nama, $username, $email, $no_hp, $id);
}


if ($stmt->execute()) {
    $_SESSION['username'] = $username; // Perbarui sesi username
    $_SESSION['nama'] = $nama; // Perbarui sesi nama
    header("Location: profil.php?update=success");
} else {
    echo "Error updating record: " . $conn->error;
}

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

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet">
  <title>Profil</title>
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
          <a class="nav-link" href="index.php">Naive Bayes
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="data_simulasi.php">Data Latih</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : $_SESSION['nama']; ?>
  </a>
  <div class="dropdown-menu" aria-labelledby="navbardrop">
    <a class="dropdown-item active" href="profil.php">Profil</a>
    <a class="dropdown-item" href="logout.php">Logout</a>
  </div>
</li>

      </ul>
    </div>
  </div>
</nav>

<div class="container" style='margin-top:90px'>
  <div class="row">
    <div class="col-12 mt-4">
      <h3 class="tebal">My Profile</h3>
    </div>

    <div class="col-6">
      <form action="update_profile.php" method="POST" class="mt-3">
        <div class="form-group">
          <label for="nama">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" class="form-control" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
        </div>

        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <div class="form-group">
          <label for="no_hp">No HP</label>
          <input type="text" id="no_hp" name="no_hp" class="form-control" value="<?php echo htmlspecialchars($user['no_hp']); ?>" required>
        </div>

        <div class="form-group">
          <label for="password">Password (biarkan kosong jika tidak ingin mengganti)</label>
          <input type="password" id="password" name="password" class="form-control">
          <button type="button" id="toggle-password" class="btn btn-secondary mt-2"><i class="fa fa-eye"></i></button>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary mt-3">Save</button>
          <button type="button" class="btn btn-secondary mt-3" onclick="window.location.href='index.php';">Back</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/fontawesome.js"></script>

<script>
document.getElementById('toggle-password').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const fieldType = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', fieldType);

    const eyeIcon = document.querySelector('#toggle-password i');
    eyeIcon.classList.toggle('fa-eye-slash');
});
</script>

</body>
</html>
