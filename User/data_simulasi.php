<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
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

  <link rel="stylesheet" href="css/datatables.css">

  <style>
    .section-title {
      font-family: 'Poppins', sans-serif;
      font-size: 2em;
      font-weight: 700;
      text-align: center;
      margin-bottom: 1em;
      color: #333;
    }

    .card-text {
      font-family: 'Lato', sans-serif;
      font-size: 1em;
      color: #555;
    }

    .card img {
      border-radius: 15px;
    }

    .card {
      border: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s;
      height: 100%;
    }

    .card:hover {
      transform: scale(1.05);
    }

    .card-body {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .equal-height {
      display: flex;
      flex-wrap: wrap;
    }

    .equal-height > div {
      display: flex;
    }
  </style>

  <title>DATA LATIH</title>
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
          <a class="nav-link" href="index.php">Naive Bayes</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="data_simulasi.php">Data Latih <span class="sr-only">(current)</span></span>
          </a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : $_SESSION['nama']; ?>
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="profil.php">Profil</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container" style='margin-top:90px'>
  <div class="row">
    <div class="col-12 mt-5">
      <h2 class="tebal">List Data Latih</h2><br>
      <p class="desc">Berikut ini adalah data latih yang saya gunakan dalam membuat sistem klasifikasi pemilihan bibit cengkeh berkualitas</p><br>

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
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $data = 'cengkeh.json';
            $json = file_get_contents($data);
            $hasil = json_decode($json,true);

            $no = 1;
            foreach ($hasil as $hasil) {

              if($hasil['kualitas'] == "Berkualitas"){
                $kualitas = "Berkualitas";
              }else{
                $kualitas = "Tidak Berkualitas";
              }
          ?>

            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $hasil['jenis']; ?></td>
              <td><?php echo $hasil['daun']; ?></td>
              <td><?php echo $hasil['batang']; ?></td>
              <td><?php echo $hasil['tinggi']; ?></td>
              <td><?php echo $hasil['umur']; ?></td>
              <td><?php echo $hasil['akar']; ?></td>
              <td><?php 
              if($kualitas == "Berkualitas"){
                echo "<span class='badge badge-success' style='padding:10px'>Berkualitas</span>";
              }else{
                echo "<span class='badge badge-danger' style='padding:10px'>Tidak Berkualitas</span>";
              }
              ?></td>
            </tr>

          <?php
          $no++;
          }
          ?>
          </tbody>
        </table>
    </div>
  </div>

</div>

<!-- Section Title -->
<div class="container" style='margin-top:90px'>
  <h2 class="section-title">Website Information</h2>
  <div class="row equal-height">
    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="img/sinjai.png" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">
            <b>Kabupaten Sinjai</b><br>
            Kabupaten Sinjai adalah salah satu Daerah Tingkat II di provinsi Sulawesi Selatan, Indonesia. Ibu kota kabupaten ini terletak di Sinjai Utara yang berjarak sekitar 220 km dari Kota Makassar.
            <br><br>
            - Lokasi Penelitian -
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="img/oji.jpg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">
            <b>Andi Khozin Mubarak</b><br>
            2020020007
            <br><br>
            - Teknik Informatika -
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="img/uhm.png" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">
            <b>Universitas Handayani Makassar</b><br>
            <a href="https://handayani.ac.id">Kunjungi Universitas Handayani Makassar</a>
            <br><br>
            - Jl. Adyaksa Baru No.1, Pandang, Kec. Panakkukang, Kota Makassar, Sulawesi Selatan 90231 -
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="page-footer font-small abu1 mt-5">

          
</div><!-- end col -->
      </div><!-- end row -->

<!-- Footer -->
<footer class="page-footer font-small abu1 mt-5">

  <!-- Footer Elements -->
  <div class="container">

    <!-- Grid row-->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-12 py-5">
        <div class="mb-5 d-flex justify-content-center">
          
          <!--Instagram-->
          <a class="icn" href="https://www.instagram.com/andioji_28/" target="_blank">
            <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>

          <!-- Github -->
          <a class="icn" href="https://github.com/andioji2802" target="_blank">
            <i class="fab fa-github fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
          
          <!-- Twitter -->
          <a class="icn" href="https://twitter.com/andi_khozin" target="_blank">
            <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"></i>
          </a>

          <!-- Facebook -->
          <a class="icn" href="https://www.facebook.com/andioji.imf" target="_blank">
            <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"></i>
          </a>

          <!-- WhatsApp -->
          <a class="icn" href="https://wa.me/6285399833542?text=Assalamu'alaikum" target="_blank">
            <i class="fab fa-whatsapp fa-lg white-text mr-md-5 mr-3 fa-2x"></i>
          </a>
          
        </div>
    </div>
  </div>
  <!-- Footer Elements -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3 abu2">© <?php echo date('Y'); ?> Copyright
    <a href="https://github.com/andioji2802">@akmaznur2802</a>
  </div>
  <!-- Copyright -->

</footer>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.js"></script>
<script src="jspopper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="js/datatables.js"></script>

<!-- validasi -->
<script>
  $(document).ready(function(){
    $('.toggle').click(function(){
      $('ul').toggleClass('active');
    });
  });
</script>

<script>
  $(document).ready(function() {
      $('#dataLatih').dataTable({
        "pageLength" : 50
      });
  });
</script>

</body>
</html>
