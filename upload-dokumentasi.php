<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

if (!isset($_GET['no_antrian'])) {
    header('location:list-antrian.php');
    exit;
}

include('connection.php');

$id = $_GET['no_antrian'];
$sql = "SELECT file_dokumentasi FROM data_antrian WHERE no_antrian='$id'";
$query = mysqli_query($connect, $sql);

if (mysqli_num_rows($query) < 0) {
    header('location: list-antrian.php?pesan=tidakada');
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
    <title>Upload Dokumentasi</title>
</head>

<body style="background-image : linear-gradient(to bottom right, #ffbb00, #ffdd1a);">
    <div class="position-relative" style=" height:100vh;">
        <div class="position-absolute top-50 start-50 translate-middle container">
            <div class="card text-center">
                <div class="card-header">
                    <h3 class="card-title">Upload File Dokumentasi</h3>
                </div>
                <div class="card-body">
                    <form action="proses-dokumentasi.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="antrian">Kode Antrian</label>
                            <input class="form-control" type="text" name="antrian" value="<?php echo $id; ?>" readonly>
                        </div>
                        <br>
                        <p class="text-muted">Browse file dokumentasi :</p>
                        <input name="uDocs" type="file" class="form-control">
                        <p class="text-muted fst-italic">*File yang diupload harus berupa file .jpg / .png -
                            (Maks.
                            50Mb)</p>
                        <br>
                        <input name="submitDocs" type="submit" class="btn btn-warning" value="Unggah Dokumentasi">
                        <p></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>