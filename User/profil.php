<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

require 'config.php';

$conn = (new Koneksi())->kondb();
$id = $_SESSION['username'];

$profile_photo = ""; // Default empty
if (file_exists("profile_photos/" . $id . ".jpg")) {
    $profile_photo = "profile_photos/" . $id . ".jpg";
}

$sql = "SELECT nama, username, email, no_hp FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
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

  <!-- font awsome -->
  <link rel="stylesheet" href="css/fontawesome.css" />
  <link rel="stylesheet" href="css/brands.css" />
  <link rel="stylesheet" href="css/solid.css" />

  <link rel="stylesheet" href="css/gaya.css">

  <!-- google font -->
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet">
  <title>Profil</title>
  <style>
        .profile-container {
            display: flex;
            justify-content: space-between;
        }
        .profile-form {
            width: 60%;
        }
        .profile-photo {
            width: 35%;
            text-align: center;
        }
        .photo-frame {
            width: 240px;
            height: 320px;
            border: 1px solid #ccc;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .photo-frame img {
            max-width: 100%;
            max-height: 100%;
        }
        .photo-actions {
            margin-top: 10px;
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
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control">
          <div class="input-group-append">
              <span class="input-group-text" id="toggle-password"><i class="fas fa-eye"></i></span>
            </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary mt-3">Save</button>
          <button type="button" class="btn btn-secondary mt-3" onclick="window.location.href='index.php';">Back</button>
        </div>
      </form>
    </div>
    <div class="profile-photo">
                    <div class="photo-frame">
                        <?php if ($profile_photo): ?>
                            <img src="<?php echo $profile_photo; ?>" alt="Profile Photo">
                        <?php else: ?>
                            <p>No Photo</p>
                        <?php endif; ?>
                    </div>
                    <div class="photo-actions">
                        <?php if ($profile_photo): ?>
                            <button class="btn btn-danger" onclick="deletePhoto()">Delete Photo</button>
                            <label class="btn btn-primary">
                                Change Photo
                                <input type="file" name="profile_photo" style="display: none;" onchange="uploadPhoto(this)">
                            </label>
                        <?php else: ?>
                            <label class="btn btn-primary">
                                Upload Photo
                                <input type="file" name="profile_photo" style="display: none;" onchange="uploadPhoto(this)">
                            </label>
                        <?php endif; ?>
                    </div>
                </div>
  </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/fontawesome.js"></script>
<script>
    function uploadPhoto(input) {
        if (input.files && input.files[0]) {
            var formData = new FormData();
            formData.append('profile_photo', input.files[0]);
            
            fetch('upload_photo.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        }
    }

    function deletePhoto() {
        if (confirm('Are you sure you want to delete your profile photo?')) {
            fetch('delete_photo.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        }
    }
    </script>
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
