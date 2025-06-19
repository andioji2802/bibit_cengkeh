<?php
include 'User/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifier = $_POST['identifier'];
    $conn = (new Koneksi())->kondb();

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? OR username=? OR nama=? OR no_hp=?");
    $stmt->bind_param("ssss", $identifier, $identifier, $identifier, $identifier);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Tampilkan form reset password dengan data user
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reset Password</title>
            <!-- Bootstrap 4 CDN -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
            <!-- Font Awesome CDN -->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
            <!-- Your custom styles -->
            <style>
                body {
                    background-image: url('Gambar/gambar/cengkeh.jpg');
                    background-size: cover;
                    background-repeat: no-repeat;
                    height: 100vh;
                    font-family: 'Numans', sans-serif;
                    margin: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                .card {
                    width: 400px;
                    background-color: rgba(0, 0, 0, 0.5) !important;
                    border: none;
                    color: white;
                }

                .card-header h5 {
                    text-align: center;
                }

                .card-body {
                    padding: 30px;
                }

                .card-footer {
                    text-align: center;
                }

                .input-group-prepend span {
                    width: 50px;
                    background-color: #FFC312;
                    color: black;
                    border: 0 !important;
                }

                input:focus {
                    outline: 0 0 0 0 !important;
                    box-shadow: 0 0 0 0 !important;
                }

                .reset_btn, .back_btn, .clear_btn {
                    color: black;
                    background-color: #FFC312;
                    width: 100px;
                }

                .reset_btn:hover, .back_btn:hover, .clear_btn:hover {
                    color: white;
                    background-color: blue;
                }

                .error-message {
                    color: red;
                    font-size: 14px;
                    text-align: center;
                    margin-bottom: 10px;
                }

                .links {
                margin-top: 20px;
                }

                .links a {
                color: #FFC312;
                margin: 0 5px;
                }

                .form-group.d-flex.justify-content-between {
                display: flex;
                justify-content: space-between;
                }

                .back_btn {
                margin-right: auto;
                }

                .reset_btn {
                margin-left: auto;
                }
            </style>
        </head>
        <body>

        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <h5>RESET AKUN</h5>
                    </div>
                    <div class="card-body">
                        <form id="reset-form" action="simpan_reset_password.php" method="POST">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Nama" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" required>
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="No HP" name="no_hp" value="<?= htmlspecialchars($user['no_hp']) ?>" required>
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Kata Sandi Baru" name="password" id="reset-password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-eye toggle-password" id="toggle-password"></i></span>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <button type="button" class="btn back_btn" onclick="window.location.href='lupa_password.php';">KEMBALI</button>
                                <button type="submit" class="btn reset_btn">SIMPAN</button>
                            </div>

                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center links">
                            Sudah Ingat?<a href="#" id="toggle-signup" onclick="window.location.href='login.php';">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('toggle-password').addEventListener('click', function () {
                var passwordField = document.getElementById('reset-password');
                var passwordFieldType = passwordField.getAttribute('type');
                if (passwordFieldType === 'password') {
                    passwordField.setAttribute('type', 'text');
                    this.classList.add('fa-eye-slash');
                } else {
                    passwordField.setAttribute('type', 'password');
                    this.classList.remove('fa-eye-slash');
                }
            });
        </script>
        </body>
        </html>
        <?php
    } else {
        header('Location: ubah_user.php?error=Data tidak ditemukan. Silakan coba lagi.');
        exit();
    }
}
?>
