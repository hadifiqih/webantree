<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

include('connection.php');

$sql = query("SELECT * FROM data_produk");
$sqlAntrian = query("SELECT * FROM data_antrian");

if (isset($_POST['cariDokumentasi'])) {
    $cari = $_POST['kategori'];
    $sqlAntrian = query("SELECT * FROM data_antrian WHERE nama_pekerjaan = '$cari'");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi - Antree</title>
    <script src="js/jquery-3.6.0.min.js"></script>
    <link href="http://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a49a4a7eca.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <nav class="nav nav-pills nav-fill">
                <a href="#"><img src="logo/antree-brand.png" alt="logo-antree" height="32px" class="pt-1 me-4 ms-3"></a>
                <a class="nav-link text-warning" aria-current="page" href="#">Dashboard</a>
                <a class="nav-link text-warning" href="list-antrian.php">Antrian</a>
                <a class="nav-link text-warning" href="#">Data Customer</a>
                <a class="nav-link text-dark bg-warning active" href="#" tabindex="-1"
                    aria-disabled="false">Dokumentasi</a>
            </nav>
        </div>
    </nav>
    <div class="container-fluid bg-white py-2 px-3 rounded mx-auto" style="margin-top: 4.5rem ;">
        <div class="row mx-auto">
            <div class="col-md-3">
                <form action="" method="POST">
                    <label class="mb-1">
                        <h6>Kategori :</h6>
                    </label>
                    <select name="kategori" id="kategori" class="form-control mb-2">
                        <option value="">- Pilih Kategori -</option>
                        <?php foreach ($sql as $row) : ?>
                            <option value="<?= $row['nama_produk'] ?>"><?= $row['nama_produk'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-warning mb-2 float-start" name="cariDokumentasi">Cari</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-3">
        <div class="row mx-1 mb-3 justify-content-center">
            <?php foreach ($sqlAntrian as $row) : ?>
            <div class="col-md-2 p-2 bg-white rounded me-4 mb-4 dokum">
                <img src="dokumentasi/<?= $row['file_dokumentasi'] ?>" alt="" class="img-fluid"
                    style="width: 100%; height:100%; object-fit:cover;">
            </div>
            <?php endforeach; ?>

        </div>
    </div>

</body>

</html>