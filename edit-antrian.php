<?php

session_start();

if(!isset($_SESSION['login'])){
    header('location:login.php');
    exit;
}

include("connection.php");

//ambil id dari query string
$id = $_GET['no_antrian'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM data_antrian WHERE no_antrian=$id";
$query = mysqli_query($connect, $sql);
$dataEdit = mysqli_fetch_array($query);

$sqlSales = 'SELECT * FROM data_sales';
$sqlOperator = 'SELECT * FROM data_operator';
$sqlDesainer = 'SELECT * FROM data_desainer';
$sqlProduk = 'SELECT * FROM data_produk';

$querySales = mysqli_query($connect, $sqlSales);
$queryOperator = mysqli_query($connect, $sqlOperator);
$queryDesainer = mysqli_query($connect, $sqlDesainer);
$queryFinishing = mysqli_query($connect, $sqlOperator);
$queryProduk = mysqli_query($connect, $sqlProduk);


// jika data yang di-edit tidak ditemukan
if (mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan...");
}

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
    <script src="https://kit.fontawesome.com/a49a4a7eca.js" crossorigin="anonymous"></script>
    <title>Edit Antrian</title>
</head>

<body>
    <div class="container-fluid bg-warning py-5">
    <div class="card mx-auto px-3" style="width: 60rem;">
            <div class="card-body">
        <h1 class="card-title">Edit Antrian Workshop</h1>
        <br>
        <form action="proses-edit.php" method="POST">
            <div class="form-group">
                <?php

                $noAntrianGabung = preg_replace("/[^a-zA-Z0-9]/", "", $dataEdit['tanggal_antrian']) . "-" . $dataEdit['no_antrian'];

                echo "<label for='antrian'>Kode Antrian</label>";
                echo "<input class='form-control' type='text' name='antrian' value=" . $noAntrianGabung . " readonly>";
                echo "<input class='form-control' type='hidden' name='noAntrian' value=" . $dataEdit['no_antrian'] . ">";
                echo "<input class='form-control' type='hidden' name='tanggal' value=" . $dataEdit['tanggal_antrian'] . ">";

                echo "<br>";
                ?>

                <label for="isSales">Sales</label>
                <select class="form-control" name="isSales">
                    <?php
                    while ($resultSales = mysqli_fetch_array($querySales)) {
                        if ($resultSales['salesName'] == $dataEdit['nama_sales']) {
                            echo "<option value='" . $resultSales['salesName'] . "' selected>" . $resultSales['salesName'] . "</option>";
                        } else {
                            echo "<option value='" . $resultSales['salesName'] . "'>" . $resultSales['salesName'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <br>

                <label for="keywordStamp">Nama Stempel / Kata Kunci</label>
                <input class="form-control" type="text" placeholder="Contoh : Stempel Es Madura" name="keywordStamp"
                    value="<?php echo $dataEdit['keyword_stempel']; ?>">
                <br>

                <label for="whatJob">Jenis Pekerjaan</label>
                <select class="form-control" id="whatJob" name="whatJob">
                    <?php
                    while ($resultProduk = mysqli_fetch_array($queryProduk)) {
                        if ($resultProduk['nama_produk'] == $dataEdit['nama_pekerjaan']) {
                            echo "<option selected>" . $resultProduk['nama_produk'] . "</option>";
                        } else {
                            echo "<option>" . $resultProduk['nama_produk'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <br>

                <label for="startJob">Mulai</label>
                <input class="form-control" type="datetime" name="startJob"
                    value="<?php echo $dataEdit['mulai_kerja']; ?>">
                <br>

                <label for="finishJob">Selesai</label>
                <input class="form-control" type="datetime" name="finishJob"
                    value="<?php echo $dataEdit['selesai_kerja']; ?>">
                <br>

                <div class="radio">
                    <p>Tempat Workshop</p>
                    <?php $tw = $dataEdit['tempat_workshop']; ?>
                    <label class="mx-2" for="whereWorkshop"><input class='mx-1' type="radio" name="whereWorkshop"
                            value="Surabaya" <?php echo ($tw == 'Surabaya') ? "checked" : "" ?>>Surabaya</label>
                    <label class="mx-2" for="whereWorkshop"><input class='mx-1' type="radio" name="whereWorkshop"
                            value="Malang" <?php echo ($tw == 'Malang') ? "checked" : "" ?>>Malang</label>
                    <label class="mx-2" for="whereWorkshop"><input class='mx-1' type="radio" name="whereWorkshop"
                            value="Kediri" <?php echo ($tw == 'Kediri') ? "checked" : "" ?>>Kediri</label>
                </div>
                <br>

                <div class="radio">
                    <p>Desainer</p>
                    <?php
                    while ($resultDesainer = mysqli_fetch_array($queryDesainer)) {
                        if ($dataEdit['nama_desainer'] == $resultDesainer['desainerName']) {
                            echo "<label class='mx-2' for='isDesainer'><input type='radio' class='mx-1' name='isDesainer' value='" . $resultDesainer['desainerName'] . "' checked>" . $resultDesainer['desainerName'] . "</label>";
                        } else {
                            echo "<label class='mx-2' for='isDesainer'><input type='radio' class='mx-1' name='isDesainer' value='" . $resultDesainer['desainerName'] . "'>" . $resultDesainer['desainerName'] . "</label>";
                        }
                    }
                    ?>
                </div>
                <br>

                <div class="radio">
                    <p>Operator</p>
                    <?php while ($resultOperator = mysqli_fetch_array($queryOperator)) {
                        if ($dataEdit['nama_operator'] == $resultOperator['operatorName']) {
                            echo "<label class='mx-2' for='isOperator'><input type='radio' class='mx-2' name='isOperator' value='" . $resultOperator['operatorName'] . "' checked>" . $resultOperator['operatorName'] . "</label>";
                        } else {
                            echo "<label class='mx-2' for='isOperator'><input type='radio' class='mx-2' name='isOperator' value='" . $resultOperator['operatorName'] . "'>" . $resultOperator['operatorName'] . "</label>";
                        }
                    }
                    ?>
                </div>
                <br>

                <div class="radio">
                    <p>Finishing</p>
                    <?php
                    $checkedFinishing = explode(",", $dataEdit['nama_finishing']);
                    while ($resultFinishing = mysqli_fetch_array($queryFinishing)) {
                        if (in_array($resultFinishing['operatorName'], $checkedFinishing)) {
                            echo "<label class='mx-2' for='isFinishing'><input type='checkbox' class='mx-2' name='isFinishing[]' value='" . $resultFinishing['operatorName'] . "' checked>" . $resultFinishing['operatorName'] . "</label>";
                        } else {
                            echo "<label class='mx-2' for='isFinishing'><input type='checkbox' class='mx-2' name='isFinishing[]' value='" . $resultFinishing['operatorName'] . "'>" . $resultFinishing['operatorName'] . "</label>";
                        }
                    }
                    ?>
                </div>
                <br>

                <p>Quality Control</p>
                <div class="radio">
                    <label class="mx-2" for="isQC">
                        <?php ?>
                        <input class="mx-2" type="radio" name="isQC" value="Ghofar"
                            <?php echo ($dataEdit['nama_qc']) ? "checked" : "" ?>>Ghofar
                        <input class="mx-2" type="radio" name="isQC" value="Arvidi"
                            <?php echo ($dataEdit['nama_qc']) ? "checked" : "" ?>>Arvidi
                    </label>
                </div>
                <br>

                <input type="hidden" name="statusAntrian" value="<?php echo $dataEdit['status_antrian'] ?>">

                <input type="submit" value="Ubah" name="ubah" class="btn btn-warning btn-block">
                <br><br>
            </div>
        </form>
    </div>
    </div>
    </div>
</body>

</html>