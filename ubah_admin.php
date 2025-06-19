<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="icon" href="static/gambar/icon-cengkeh.png" type="image/png">
    <!-- Bootstrap 4 CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
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
            height: auto;
            width: 400px;
            background-color: rgba(0, 0, 0, 0.5) !important;
            border: none;
        }

        .card-header h5 {
            text-align: center;
            color: white;
        }

        .card-header h6 {
            text-align: center;
            color: #FFC312;
        }

        .card-body {
            padding: 30px;
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
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <h5>Reset Password</h5>
            </div>
            <div class="card-body">
                <!-- Form reset password -->
                <form id="reset-password-form" action="proses_lp_admin.php" method="POST">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username/Email/Nama/No HP" name="identifier" required>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Password Baru" name="new_password" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="toggle-new-password"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <button type="button" class="btn back_btn" onclick="goBack()">KEMBALI</button>
                        <button type="button" class="btn clear_btn" onclick="document.querySelector('#reset-password-form').reset(); document.getElementById('error-message').style.display = 'none';">BERSIH</button>
                        <button type="submit" class="btn reset_btn">RESET</button>
                    </div>
                </form>
                <div id="error-message" class="error-message">Username atau Password salah</div>
            </div>
        </div>
    </div>
</div>

<script>
        function goBack() {
    window.location.href = 'login.php';
}

    document.getElementById('toggle-new-password').addEventListener('click', function () {
        const passwordField = document.querySelector('input[name="new_password"]');
        const fieldType = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', fieldType);
        
        const eyeIcon = this.querySelector('i');
        eyeIcon.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>
