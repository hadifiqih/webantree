<?php

session_start();

if(!isset($_SESSION['login'])){
    header('location:login.php');
    exit;
}

include('connection.php');

$sqlSales = 'SELECT * FROM data_sales';
$sqlOperator = 'SELECT * FROM data_operator';
$sqlDesainer = 'SELECT * FROM data_desainer';
$sqlProduk = 'SELECT * FROM data_produk';

$querySales = mysqli_query($connect, $sqlSales);
$queryOperator = mysqli_query($connect, $sqlOperator);
$queryDesainer = mysqli_query($connect, $sqlDesainer);
$queryFinishing = mysqli_query($connect, $sqlOperator);
$queryProduk = mysqli_query($connect, $sqlProduk);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">
    <title>Tambah Antrian</title>
</head>

<body>
    <div class="container-fluid bg-warning py-5">
        <div class="card mx-auto px-3" style="width: 60rem;">
            <div class="card-body">
        <h1 class="card-title">Tambah Antrian Workshop</h1>
        <br>
        <form action="proses-antrian.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <?php
                $queryAntrian = mysqli_query($connect, 'SELECT max(no_antrian) as noTerbesar FROM data_antrian');
                $dataAntrian = mysqli_fetch_array($queryAntrian);
                $noTerbesar = $dataAntrian['noTerbesar'];

                $noAntrian = $noTerbesar + 1;

                $tanggalSekarang = date("Ymd");
                $tanggalStrip = date("Y-m-d");
                $noAntrianGabung = $tanggalSekarang . "-" . $noAntrian;

                echo "<label for='antrian'>Kode Antrian</label>";
                echo "<input class='form-control' type='text' name='antrian' value=" . $noAntrianGabung . " readonly>";
                echo "<input class='form-control' type='hidden' name='noAntrian' value=" . $noAntrian . ">";
                echo "<input class='form-control' type='hidden' name='tanggal' value=" . $tanggalStrip . ">";

                echo "<br>";
                ?>

                <label for="isSales">Sales</label>
                <select class="form-control" id="whoSales" name="isSales">
                    <option value="nol" selected>- Pilih Sales -</option>
                    <?php
                    while ($resultSales = mysqli_fetch_array($querySales)) {
                        echo "<option value='" . $resultSales['salesName'] . "'>" . $resultSales['salesName'] . "</option>";
                    }
                    ?>
                </select>
                <br>

                <label for="keywordStamp">Nama Stempel / Kata Kunci</label>
                <input class="form-control" type="text" placeholder="Contoh : Stempel Es Madura" name="keywordStamp">
                <br>

                <label for="whatJob">Jenis Pekerjaan</label>
                <select class="form-control" id="whatJob" name="whatJob">
                    <option value="nol" selected>- Pilih Pekerjaan -</option>
                    <?php
                    while ($resultProduk = mysqli_fetch_array($queryProduk)) {
                        echo "<option>" . $resultProduk['nama_produk'] . "</option>";
                    }
                    ?>
                </select>
                <br>

                <label for="startJob">Mulai</label>
                <input class="form-control" type="datetime-local" name="startJob">
                <br>

                <label for="finishJob">Selesai</label>
                <input class="form-control" type="datetime-local" name="finishJob">
                <br>

                <div class="radio">
                    <p>Tempat Workshop</p>
                    <label class="mx-2" for="whereWorkshop"><input class='mx-1' type="radio" name="whereWorkshop"
                            value="Surabaya">Surabaya</label>
                    <label class="mx-2" for="whereWorkshop"><input class='mx-1' type="radio" name="whereWorkshop"
                            value="Malang">Malang</label>
                    <label class="mx-2" for="whereWorkshop"><input class='mx-1' type="radio" name="whereWorkshop"
                            value="Kediri">Kediri</label>
                </div>
                <br>

                <div class="radio">
                    <p>Desainer</p>
                    <?php while ($resultDesainer = mysqli_fetch_array($queryDesainer)) {
                        echo "<label class='mx-2' for='isDesainer'><input type='radio' class='mx-1' name='isDesainer' value='" . $resultDesainer['desainerName'] . "'>" . $resultDesainer['desainerName'] . "</label>";
                    }
                    ?>
                </div>
                <br>

                <div class="radio">
                    <p>Operator</p>
                    <?php while ($resultOperator = mysqli_fetch_array($queryOperator)) {
                        echo "<label class='mx-2' for='isOperator'><input type='radio' class='mx-2' name='isOperator' value='" . $resultOperator['operatorName'] . "'>" . $resultOperator['operatorName'] . "</label>";
                    }
                    ?>
                </div>
                <br>

                <div class="radio">
                    <p>Finishing</p>
                    <?php while ($resultFinishing = mysqli_fetch_array($queryFinishing)) {
                        echo "<label class='mx-2' for='isFinishing'><input type='checkbox' class='mx-2' name='isFinishing[]' value='" . $resultFinishing['operatorName'] . "'>" . $resultFinishing['operatorName'] . "</label>";
                    }
                    ?>
                </div>
                <br>

                <p>Quality Control</p>
                <div class="radio">
                    <label class="mx-2" for="isQC">
                        <input class="mx-2" type="radio" name="isQC" value="Ghofar">Ghofar
                        <input class="mx-2" type="radio" name="isQC" value="Arvidi">Arvidi
                    </label>
                </div>
                <br>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload File Desain <span class="text-danger fst-italic">(Maks. 20MB)</span></label>
                    <input class="form-control" type="file" id="uFile" name="uFile">
                    <p class="text-danger fst-italic">*Pastikan mengunggah file desain yang sudah <strong> cetak dan tidak ada revisi.</strong></p>
                </div>

                <input type="submit" value="Tambah Antrian" name="daftar" class="btn btn-warning btn-block">
                <br><br>
            </div>
        </form>
    </div>
    </div>
    </div>
</body>

</html>