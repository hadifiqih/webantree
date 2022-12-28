<?php

session_start();

include('connection.php');

if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

//Session
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
} elseif (isset($_SESSION['salah_ekstensi'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['salah_ekstensi'] . '</div>';
    unset($_SESSION['salah_ekstensi']);
} elseif (isset($_SESSION['successUploadYes'])) {
    echo '<div class="alert alert-success">' . $_SESSION['successUploadYes'] . '</div>';
    unset($_SESSION['successUploadYes']);
} elseif (isset($_SESSION['successUploadNo'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['successUploadNo'] . '</div>';
    unset($_SESSION['successUploadNo']);
} elseif (isset($_SESSION['successEditYes'])) {
    echo '<div class="alert alert-success">' . $_SESSION['successEditYes'] . '</div>';
    unset($_SESSION['successEditYes']);
} elseif (isset($_SESSION['successEditNo'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['successEditNo'] . '</div>';
    unset($_SESSION['successEditNo']);
} elseif (isset($_SESSION['kosong'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['kosong'] . '</div>';
    unset($_SESSION['kosong']);
} elseif (isset($_SESSION['berhasilDownload'])) {
    echo "<script>";
    echo '<div class="alert alert-success">' . $_SESSION['berhasilDownload'] . '</div>';
    echo "</script>";
    unset($_SESSION['berhasilDownload']);
}
?>
<?php if (isset($_SESSION['suksesHapus'])) { ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Sukses',
    text: 'Antrian berhasil dihapus',
    timer: 2000,
    showConfirmButton: false
})
</script>

<?php unset($_SESSION['suksesHapus']);
} ?>

<?php if (isset($_SESSION['successAntrian'])) { ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Sukses',
    text: 'Antrian berhasil ditambah',
    timer: 2000,
    showConfirmButton: false
})
</script>

<?php unset($_SESSION['successAntrian']);
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antree - Daftar Antrian</title>
    <link href="style.css" rel="stylesheet">
    <script src="js/jquery-3.6.0.min.js"></script>
    <link href="http://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a49a4a7eca.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container-fluid position-relative">
            <nav class="nav nav-pills nav-fill">
                <a href="list-antrian.php"><img src="logo/antree-brand.png" alt="logo-antree" height="32px" class="pt-1 me-4 ms-3"></a>
                <a class="nav-link text-warning" aria-current="page" href="#">Dashboard</a>
                <a class="nav-link active bg-warning text-dark" href="list-antrian.php">Antrian</a>
                <a class="nav-link text-warning" href="#">Data Customer</a>
                <a class="nav-link text-warning" href="dokumentasi-page.php" tabindex="-1"
                    aria-disabled="true">Dokumentasi</a>
                <div class="position-absolute top-50 end-0 translate-middle-y">
                    <a href="logout.php" class="nav-link float-end text-warning"><i
                            class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                </div>
            </nav>
        </div>

    </nav>

    <!-- End Navbar -->
    <!-- Start Content -->
    <div class="table-responsive my-3 mx-auto mt-5 bg-light rounded mb-3" id="tabel-utama">

    <table id="myTable">
    <?php
        $sql = query("SELECT * FROM data_antrian");

    ?>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Sales</th>
            <th scope="col">Keyword</th>
            <th scope="col">Pekerjaan</th>
            <!-- <th scope="col">Start</th> -->
            <th scope="col">Deadline</th>
            <th scope="col">Workshop</th>
            <!-- <th scope="col" class="text-center">File Desain</th> -->
            <th scope="col" class="text-center">File Dokumentasi</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tr>
        <?php
        foreach($sql as $data):
        ?>
            <td scope="col"><?php $data['no_antrian'] ?></td>
            <td scope="col"><?php $data['nama_sales'] ?></td>
            <td scope="col"><?php $data['keyword_stempel'] ?></td>
            <td scope="col"><?php $data['nama_pekerjaan'] ?></td>
            <!-- <td scope="col">Start</td> -->
            <td scope="col"><?php $data['selesai_kerja'] ?></td>
            <td scope="col"><?php $data['tempat_workshop'] ?></td>
            <!-- <td scope="col" class="text-center">File Desain</td> -->
            <?php
            echo '<td class="text-center">';
                        if ($result['file_dokumentasi'] == "") {
                            echo "<a href='upload-dokumentasi.php?no_antrian=" . $result['no_antrian'] . "' type='button' class='btn btn-primary btn-sm'><i class='fa-solid fa-circle-arrow-up'></i><span class='mx-2'>Dokumentasi</span></a>";
                        } else {
                            echo "<a href='upload-dokumentasi.php?no_antrian=" . $result['no_antrian'] . "' type='button' class='btn btn-success btn-sm'><i class='fa-solid fa-circle-check'></i><span class='mx-2'>Selesai</span></a>";
                        }
                        echo '</td>';
            ?>
            <td scope="col">Status</td>
        <?php endforeach; ?>
    </tr>
    </table>
    </div>
    <!-- End Content -->

    <script src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>
