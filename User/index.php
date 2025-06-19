<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/fontawesome.css" />
  <link rel="stylesheet" href="css/brands.css" />
  <link rel="stylesheet" href="css/solid.css" />
  <link rel="stylesheet" href="css/gaya.css">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet">
  <title>Bibit Cengkeh AI</title>
  <style>
    .ciri-bibit .form-group {
      margin-bottom: 0; /* Remove bottom margin for better alignment */
    }
    .ciri-bibit label {
      font-weight: bold;
      margin-bottom: 0; /* Remove bottom margin for better alignment */
    }
    .ciri-bibit .form-group select {
      width: 100%; /* Ensure select fields take full width */
    }
    .ciri-bibit .form-row {
      margin-bottom: 15px; /* Add space between rows */
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

    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Bibit AI
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="riwayat.php">Riwayat</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : $_SESSION['nama']; ?>
            <?php
$profile_photo = "profile_photos/" . $_SESSION['username'] . ".jpg";
if (file_exists($profile_photo)):
?>
    <img src="<?php echo $profile_photo; ?>" alt="Profile Photo" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
<?php endif; ?>
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
    <div class="col-12 mt-4">
      <h3 class="tebal">Pemilihan Bibit Cengkeh Berkualitas AI</h3>
    </div>

    <div class="col-12">
      <form method="POST" class="mt-3">
        <div class="jenis-cengkeh">
          <h4>Jenis Cengkeh</h4>
          <div class="form-group">
            <label for="namaBibit">Nama Bibit Cengkeh</label>
            <select id="namaBibit" name="nama" class="form-control selBox" required disabled>
              <option value="Cengkeh Zanzibar">Cengkeh Zanzibar</option>
            </select>
          </div>
        </div>

        <div class="ciri-bibit">
          <h4 class="tebal">Ciri Bibit</h4>
          <div class="form-row">
            <div class="form-group col-md-2">
              <label for="ciriDaun">Ciri Daun</label>
              <select id="ciriDaun" name="ciri_daun" class="form-control selBox" required>
                <option value="" disabled selected>Pilih Ciri Daun</option>
                <option value="Lebar & Hijau">Lebar & Hijau</option>
                <option value="tegak & tidak layu">Tegak & Tidak layu</option>
                <option value="halus tanpa bercak">Halus tanpa bercak</option>
                <option value="mengkilap & sehat">Mengkilap & Sehat</option>
                <option value="hijau tapi bercak">Hijau tapi bercak</option>
                <option value="lebar tapi kuning">lebar tapi kuning</option>
                <option value="Sempit & Kuning">Sempit & Kuning</option>
                <option value="layu">layu</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="ciriBatang">Ciri Batang</label>
              <select id="ciriBatang" name="batang" class="form-control selBox" required>
                <option value="" disabled selected>Pilih Ciri Batang</option>
                <option value="besar & lurus">Besar & Lurus</option>
                <option value="kulit batang mulus tanpa luka">Kulit batang mulus tanpa luka</option>
                <option value="kuat & tidak rapuh">Kuat & Tidak rapuh</option>
                <option value="berwarna coklat tua">Berwarna coklat tua</option>
                <option value="lurus tapi kecil">Lurus tapi kecil</option>
                <option value="besar tapi bengkok">Besar tapi bengkok</option>
                <option value="retak atau patah">Retak atau patah</option>
                <option value="rapuh & kering">Rapuh & kering</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="tinggiBibit">Tinggi Bibit (cm)</label>
              <select id="tinggiBibit" name="tinggi" class="form-control selBox" required>
                <option value="" disabled selected>Pilih Tinggi Bibit</option>
                <option value="90cm">90 cm</option>
                <option value="80cm">80 cm</option>
                <option value="70cm">70 cm</option>
                <option value="60cm">60 cm</option>
                <option value="50cm">50 cm</option>
                <option value="40cm">40 cm</option>
                <option value="30cm">30 cm</option>
                <option value="20cm">20 cm</option>
                <option value="10cm">10 cm</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="umurBibit">Umur Bibit (bulan)</label>
              <select id="umurBibit" name="umur" class="form-control selBox" required>
                <option value="" disabled selected>Pilih Umur Bibit</option>
                <option value="24 Bulan">24 bulan</option>
                <option value="18 Bulan">18 bulan</option>
                <option value="12 Bulan">12 bulan</option>
                <option value="11 Bulan">11 bulan</option>
                <option value="10 Bulan">10 bulan</option>
                <option value="9 Bulan">9 bulan</option>
                <option value="8 Bulan">8 bulan</option>
                <option value="7 Bulan">7 bulan</option>
                <option value="6 Bulan">6 bulan</option>
                <option value="5 Bulan">5 bulan</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="ciriAkar">Ciri Akar</label>
              <select id="ciriAkar" name="akar" class="form-control selBox" required>
                <option value="" disabled selected>Pilih Ciri Akar</option>
                <option value="banyak & bercabang">Banyak & Bercabang</option>
                <option value="kuat & sehat">Kuat & Sehat</option>
                <option value="tidak busuk">Tidak busuk</option>
                <option value="tumbuh merata">Tumbuh merata</option>
                <option value="sedikit bercabang">Sedikit bercabang</option>
                <option value="tidak bercabang">Tidak bercabang</option>
                <option value="akar busuk">Akar busuk</option>
                <option value="akar tipis atau pendek">Akar tipis atau pendek</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary mt-3" onclick="return simulasi()">Submit</button>
          <button type="button" class="btn btn-secondary mt-3" onclick="window.location.href='index.php';">Back</button>
        </div>
      </form>
    </div>
        
    <div class="row">
      <div class="col-12 mt-5 mb-5">
          <div id="hasilSIM" style="margin-bottom:30px;">

          </div>
      </div>
    </div>

    </div>

          
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


<script>
        document.querySelector('.btn-secondary').addEventListener('click', function() {
            window.location.href = 'logout.php';
        });
</script>

<!-- validasi -->
<script>
  $(document).ready(function(){
    $('.toggle').click(function(){
      $('ul').toggleClass('active');
    });
  });
</script>

<script>
  function simulasi() {
    var jenis = $("#namaBibit").val();
    var ciri_daun = $("#ciriDaun").val();
    var ciri_batang = $("#ciriBatang").val();
    var tinggi_bibit = $("#tinggiBibit").val();
    var umur_bibit = $("#umurBibit").val();
    var ciri_akar = $("#ciriAkar").val();

    // Validasi
    if (!jenis || !ciri_daun || !ciri_batang || !tinggi_bibit || !umur_bibit || !ciri_akar) {
      alert("Mohon lengkapi semua field");
      return false;
    }

    $.ajax({
      url: 'simulasi.php',
      type: 'POST',
      dataType: 'html',
      data: {
        jenis: jenis,
        ciri_daun: ciri_daun,
        ciri_batang: ciri_batang,
        tinggi_bibit: tinggi_bibit,
        umur_bibit: umur_bibit,
        ciri_akar: ciri_akar
      },
      success: function(data) {
        $("#hasilSIM").html(data);
      },
    });

    return false;
  }
</script>


<script>
$(document).ready(function() {
    $('#simulasiForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'simulasi.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                $('#hasilSIM').html(data);
                $('html, body').animate({
                    scrollTop: $("#hasilSIM").offset().top
                }, 500);
            }
        });
    });
});
</script>
</body>
</html>
