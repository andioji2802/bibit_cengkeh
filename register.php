<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="icon" href="../Gambar/gambar/users.png" type="image/png">
    <link rel="icon" href="Gambar/gambar/users.png" type="image/png">
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

        .signup_btn, .back_btnn, .clear_btnn {
            color: black;
            background-color: #FFC312;
            width: 100px;
        }

        .signup_btn:hover, .back_btnn:hover, .clear_btnn:hover {
            color: white;
            background-color: blue;
        }

        .toggle-link {
            text-align: center;
            margin-top: 10px;
        }

        .language-toggle {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: blue;
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
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <h6 id="ucapan">SELAMAT DATANG</h6>
                <h6 id="judul">BIBIT CENGKEH NAIVE BAYES AI</h6>
                <h5 id="form-title">DAFTAR</h5>
                <a href="#" class="language-toggle" id="language-toggle">
                    <img src="User/img/indonesia-flag.png" alt="Indonesian Flag">
                </a>
            </div>
            <div class="card-body" id="form-container">

                <!-- Registration form -->
                <form id="signup-form" action="proses_register.php" method="POST">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Nama" name="nama" id="signup-nama" required>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" name="username" id="signup-username" required>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" placeholder="Email" name="email" id="signup-email" required>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="No HP" name="no_hp" id="signup-no_hp" required>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Kata Sandi" name="password" id="login-password" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="toggle-password"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <button type="button" class="btn back_btnn" onclick="window.location.href='login.php';">KEMBALI</button>
                        <button type="button" class="btn clear_btnn" onclick="document.querySelector('#signup-form').reset();">BERSIH</button>
                        <button type="submit" class="btn signup_btn">DAFTAR</button>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <a href="login.php" id="lupa-pass">Masuk jika kamu sudah punya akun!</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('language-toggle').addEventListener('click', function () {
    var currentLanguage = document.documentElement.lang;
    var newLanguage = currentLanguage === 'id' ? 'en' : 'id';
    var flagSrc = newLanguage === 'id' ? 'User/img/indonesia-flag.png' : 'User/img/english-flag.png';
    document.documentElement.lang = newLanguage;
    document.getElementById('language-toggle').querySelector('img').setAttribute('src', flagSrc);

    var elements = document.querySelectorAll('[data-lang-id]');
    elements.forEach(function (element) {
        var langId = element.getAttribute('data-lang-id');
        element.innerText = translations[newLanguage][langId];
    });

    // Menggunakan fungsi toggleLanguage untuk mengubah teks dan placeholder
    toggleLanguage();
});

    // Fungsi untuk mengubah bahasa
// Fungsi untuk mengubah bahasa
function toggleLanguage() {
    const currentLang = document.documentElement.lang;
    if (currentLang === 'id') {
            // Setel teks dan placeholder untuk bahasa Indonesia
            document.documentElement.lang = 'id';
            document.getElementById('ucapan').textContent = 'Selamat Datang di Sistem';
            document.getElementById('judul').textContent = 'Pemilihan Bibit Cengkeh Berkualitas';
            document.getElementById('form-title').textContent = 'Silakan masuk untuk mulai menggunakan aplikasi';
            document.getElementById('login-identifier').placeholder = 'Username/Email/Nama/No HP';
            document.getElementById('login-password').placeholder = 'Kata Sandi';
            document.querySelector('.login_btn').textContent = 'MASUK';
            document.getElementById('lupa-pass').textContent = 'Lupa Password?';
            document.querySelector('.back_btn').textContent = 'KEMBALI';
            document.querySelector('.clear_btn').textContent = 'BERSIH';
            document.getElementById('admin_login_label').textContent = 'Masuk sebagai Admin';
            document.getElementById('user_login_label').textContent = 'Masuk sebagai Pengguna';
            document.getElementById('language-toggle').querySelector('img').setAttribute('src', 'User/img/indonesia-flag.png');
        } else {
            // Setel teks dan placeholder untuk bahasa Inggris
            document.documentElement.lang = 'en';
            document.getElementById('ucapan').textContent = 'Welcome to the System';
            document.getElementById('judul').textContent = 'Clove Seed Selection AI';
            document.getElementById('form-title').textContent = 'Please log in to start using the application';
            document.getElementById('login-identifier').placeholder = 'Username/Email/Name/Phone Number';
            document.getElementById('login-password').placeholder = 'Password';
            document.querySelector('.login_btn').textContent = 'LOGIN';
            document.getElementById('lupa-pass').textContent = 'Forgot Password?';
            document.querySelector('.back_btn').textContent = 'BACK';
            document.querySelector('.clear_btn').textContent = 'CLEAR';
            document.getElementById('admin_login_label').textContent = 'Login as Admin';
            document.getElementById('user_login_label').textContent = 'Login as User';
            document.getElementById('language-toggle').querySelector('img').setAttribute('src', 'User/img/english-flag.png');
        }
}


    document.getElementById('language-toggle').addEventListener('click', toggleLanguage);

// Fungsi untuk toggle visibilitas password
document.getElementById('toggle-password').addEventListener('click', function () {
    const passwordField = document.getElementById('login-password'); // Ubah sesuai dengan ID input password Anda
    const fieldType = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', fieldType);
    
    // Toggle ikon mata (eye)
    const eyeIcon = document.querySelector('#toggle-password i');
    eyeIcon.classList.toggle('fa-eye-slash');
});

document.getElementById('togglepassword').addEventListener('click', function () {
    const passwordField = document.getElementById('signup-password'); // Ubah sesuai dengan ID input password Anda
    const fieldType = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', fieldType);
    
    // Toggle ikon mata (eye)
    const eyeIcon = document.querySelector('#toggle-password i');
    eyeIcon.classList.toggle('fa-eye-slash');
});
    function goBack() {
    window.location.href = '../index.php';
}
</script>

</body>
</html>
