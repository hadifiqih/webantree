<?php
  session_start();

  include('connection.php');

  $divisi = $_SESSION['divisi'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antree - Dokumentasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- file Font Awesome -->
    <script src="https://kit.fontawesome.com/a49a4a7eca.js" crossorigin="anonymous"></script>
    <style>
        .swiper{
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body>
<!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="login.php">
        <img src="logo/antree-brand.png" alt="Antree Logo" width="100">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <?php if($divisi == "sales"){
            echo '<a class="nav-link active" href="sales.php">Antrian</a>';
          }elseif($divisi == "desopr"){
            echo '<a class="nav-link active" href="desopr.php">Antrian</a>';
          }elseif($divisi == "admwrk"){
            echo '<a class="nav-link active" href="admwrk.php">Antrian</a>';
          }
          ?>
          <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
        </div>
      </div>
    </div>
  </nav>
<!-- End Navbar -->
<div class="swiper">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    <?php
    $id = $_GET['no_antrian'];
    $query = mysqli_query($connect, "SELECT * FROM data_antrian WHERE no_antrian=$id");
    $row = mysqli_fetch_assoc($query);
    $arrayFile = explode(',', $row['file_dokumentasi']);

  foreach($arrayFile as $file) {
    // jika file tersebut ada di direktori dokumentasi
    $direktori = $id."/".$file;
    echo '<div class="swiper-slide text-center">';
    echo '<div class="m-3">';
    if (file_exists("dokumentasi/$direktori")) {
      // tampilkan file tersebut
      echo '<img src="dokumentasi/'. $direktori . '" alt="Gambar" class="img-fluid rounded">';
      echo '<br>';
      // tambahkan tombol download
      echo '<a href="dokumentasi/'. $direktori . '" download="' . $file . '" class="btn btn-sm btn-warning mt-3">Download Gambar</a>';
    }
    echo '</div>';
    echo '</div>';
  }
  echo '</div>';
?>
  <!-- If we need navigation buttons -->
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
<script>
    const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,

  effect: 'flip',
  flipEffect: {
    slideShadows: false
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>
</html>