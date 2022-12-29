<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .download-button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin-top: 20px;
}

    </style>
    <!-- Include CSS and JS for Slick -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</head>
<body>
    

<!-- Carousel Container -->
<div class="your-class">
  <!-- Slides -->
  <div>
    <img src="dokumentasi/1679091c5a880faf6fb5e6087eb1b2dc-stempel spunbound.jpeg" alt="Gambar 1">
    <a href="dokumentasi/1679091c5a880faf6fb5e6087eb1b2dc-stempel spunbound.jpeg" download="1679091c5a880faf6fb5e6087eb1b2dc-stempel spunbound.jpeg" class="download-button">Download Gambar 1</a>
  </div>
  <div>
    <img src="dokumentasi/6512bd43d9caa6e02c990b0a82652dca-karnopel kotak regular.jpg" alt="Gambar 2">
    <a href="dokumentasi/6512bd43d9caa6e02c990b0a82652dca-karnopel kotak regular.jpg" download="6512bd43d9caa6e02c990b0a82652dca-karnopel kotak regular.jpg" class="download-button">Download Gambar 2</a>
  </div>
  <div>
    <img src="dokumentasi/Wga.jpg" alt="Gambar 3">
    <a href="dokumentasi/Wga.jpg" download="Wga.jpg" class="download-button">Download Gambar 3</a>
  </div>
</div>

<!-- Initialize Slick -->
<script type="text/javascript">
  $(document).ready(function() {
    $('.your-class').slick({
      // options
    });
  });
</script>
</body>
</html>
