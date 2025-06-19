<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemilihan Bibit Cengkeh</title>
    <link rel="icon" href="Gambar/gambar/icon-home.png" type="image/png">
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: Arial, Helvetica, sans-serif;
        }

        .bg {
            background-image: url('Gambar/gambar/cengkeh.jpg');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: #8FBC8F;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar ul {
            list-style: none;
            display: flex;
        }

        .navbar ul li {
            margin: 0 1rem;
        }

        .navbar ul li a {
            color: #fff;
            text-decoration: none;
            padding: 0.5rem 1rem;
            transition: background-color 0.3s ease;
        }

        .navbar ul li a:hover {
            background-color: #555;
        }

        .hero {
            text-align: center;
            color: white;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .hero img {
            max-width: 100%;
            height: auto;
            margin-bottom: 2rem;
        }

        .hero-content h1 {
            font-size: 3rem;
            color: #FFC312;
            margin-bottom: 1rem;
        }

        .hero-content h2 {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 1rem;
        }

        .hero-content p {
            font-size: 1.2rem;
            color: #fff;
            line-height: 1.0;
            max-width: 800px;
        }

        .footer {
            background-color: #8FBC8F;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        .footer ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .footer ul li {
            margin: 0 1rem;
        }

        .footer ul li img {
            width: 20px;
            height: 20px;
            margin-right: 0.5rem;
            vertical-align: middle;
        }

        .footer ul li a {
            color: #fff;
            text-decoration: none;
        }
        .navbar ul li.dropdown {
            position: relative;
        }

        .navbar ul li.dropdown > a {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }

        .navbar ul li.dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: black;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border: 1px solid #ddd;
            border-radius: 5px;
            left: 10%;
            transform: translateX(-50%);
            top: 100%;
            margin-top: 5px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
<div class="bg">
        <div class="navbar">
            <div class="logo">
                <img src="Gambar/gambar/icon-cengkeh.png" alt="Logo" style="height: 40px;">
            </div>
            <ul>
                <li class="dropdown">
                    <a href="login.php">Login</a>
                </li>
            </ul>
        </div>
        <main class="hero">
            <img src="Gambar/gambar/iconcengkeh.png" alt="Gambar Cengkeh">
            <div class="hero-content">
                <h1>Aplikasi Pemilihan Bibit Cengkeh</h1>
                <h2>Berkualitas dan Tidak Berkualitas</h2>
                <p>
                    Aplikasi Pemilihan Bibit Cengkeh Berkualitas adalah 
                    aplikasi yang membantu petani untuk mengetahui mana bibit cengkeh yang berkualitas dan tidak berkualitas.
                    Dibuat oleh mahasiswa Teknik Informatika Universitas Handayani Makassar dengan NIM 2020020007, Andi Khozin Mubarak.
                </p>
            </div>
        </main>
        <div class="footer">
            <footer>
                <ul>
                    <li>
                        <a href="https://www.instagram.com/andioji_28"><img src="Gambar/gambar/instagram.png" alt="Instagram"></a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/andioji.imf"><img src="Gambar/gambar/facebook.png" alt="Facebook"></a>
                    </li>
                    <li>
                        <a href="https://twitter.com/andi_khozin"><img src="Gambar/gambar/twitter.png" alt="Twitter"></a>
                    </li>
                    <li>
                        <a href="https://wa.me/6285399833542?text=Assalamu'alaikum"><img src="Gambar/gambar/whatsapp.png" alt="Whatsapp"></a>
                    </li>
                </ul>
            </footer>
        </div>
    </div>
</body>
</html>
