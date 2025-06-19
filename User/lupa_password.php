<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi</title>
    <!-- Bootstrap 4 CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <!-- Your custom styles -->
    <style>
        body {
            background-image: url('img/cengkeh.jpg');
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

        .links {
            margin-top: 20px;
        }

        .links a {
            color: #FFC312;
            margin: 0 5px;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .language-toggle {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: blue; /* Warna merah untuk bendera Indonesia */
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .language-toggle img {
            width: 20px;
            height: auto;
        }

        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
            display: none; /* Sembunyikan pesan kesalahan secara default */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <h5 id="form-title">RESET AKUN</h5>
            </div>
            <div class="card-body" id="form-container">
                <!-- Password reset form -->
                <form id="reset-form" action="proses_lupa_password.php" method="POST">
                    <div class="form-group">
                        <label for="email">Masukkan nama/email/username/nomor hp yang kamu ingat:</label>
                        <input type="identifier" class="form-control" name="identifier" id="reset-identifier" required>
                    </div>
                    <div id="error-message" class="error-message">
                        <?php
                        if (isset($_GET['error'])) {
                            echo htmlspecialchars($_GET['error']);
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
                <!-- End of password reset form -->

                <!-- Links section -->
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Sudah Ingat?<a href="#" id="toggle-signup" onclick="window.location.href='login.php';">Login</a>
                    </div>
                </div>
                <!-- End of links section -->
            </div>
        </div>
    </div>
</div>
</body>
</html>
