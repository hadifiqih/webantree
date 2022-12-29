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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .swiper{
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="swiper">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    <div class="swiper-slide text-center">
    <div class="m-3">
      <img src="dokumentasi/Wga.jpg" alt="Gambar 2" class="img-fluid rounded">
      <a href="dokumentasi/Wga.jpg" download="Wga.jpg" class="btn btn-sm btn-warning mt-3">Download Gambar</a>
    </div>
    </div>
    <div class="swiper-slide text-center">
        <div class="m-3">
        <img src="dokumentasi/1679091c5a880faf6fb5e6087eb1b2dc-stempel spunbound.jpeg" alt="Gambar 2" class="img-fluid rounded">
        <a href="dokumentasi/1679091c5a880faf6fb5e6087eb1b2dc-stempel spunbound.jpeg" download="1679091c5a880faf6fb5e6087eb1b2dc-stempel spunbound.jpeg" class="btn btn-sm btn-warning mt-3">Download Gambar</a>
        </div>
    </div>
    <div class="swiper-slide text-center">
    <div class="m-3">
      <img src="dokumentasi/Wga.jpg" alt="Gambar 2" class="img-fluid rounded">
      <a href="dokumentasi/Wga.jpg" download="Wga.jpg" class="btn btn-sm btn-warning mt-3">Download Gambar</a>
    </div>
    </div>
  </div>

  <!-- If we need navigation buttons -->
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
<script>
    const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});
</script>
</body>
</html>