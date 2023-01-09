<?php

session_start();

if (!isset($_SESSION['login'])) {
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
                <form action="proses-sales.php" method="POST" enctype="multipart/form-data">
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
                        <input class="form-control" type="text" placeholder="Contoh : Mami Juice" name="keywordStamp">
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

                        <label for="keterangan">Keterangan / Spesifikasi </label>
                        <input class="form-control" type="text"
                            placeholder="Contoh : Trodat 4913, Flash 2255, dan keterangan lainnya" name="keterangan">
                        <br>

                        <label for="omset">Omset / Harga Jual</label>
                        <input class="form-control" type="text"
                            placeholder="Contoh : 300000 (tanpa tanda titik atau Rp)" name="omset">
                        <br>

                        <label for="buktiBayar">Bukti Pembayaran</label>
                        <input type="file" class="form-control" name="buktiBayar">
                        <br>

                        <label for="namaPelanggan">Nama Customer</label>
                        <input class="form-control" type="text" placeholder="Contoh : Purnomo" name="namaPelanggan">
                        <br>

                        <label for="noPelanggan">No. Telepon / WhatsApp</label>
                        <input class="form-control" type="text" placeholder="Contoh : 089XXXXXXXXX" name="noPelanggan">
                        <br>

                        <label for="alamatPelanggan">Alamat Customer</label>
                        <input class="form-control" type="text" placeholder="Contoh : Jl. Pahlawan ..."
                            name="alamatPelanggan">
                        <br>

                        <label for="iklanPelanggan">Info Iklan</label>
                        <input class="form-control" type="text" placeholder="Contoh : Purnomo" name="iklanPelanggan">
                        <br>

                        <input type="submit" value="Tambah Antrian" name="daftar" class="btn btn-warning btn-block">
                        <br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>