<?php

session_start();

include('connection.php');

if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}


$jumlahDataPerHalaman = 30;
$jumlahData = count(query("SELECT * FROM data_antrian"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


//Query Antrian Utama
$sql = query("SELECT * FROM data_antrian ORDER BY no_antrian DESC LIMIT $awalData,$jumlahDataPerHalaman");

$datasql = mysqli_query($connect, "SELECT * FROM data_antrian");
$jumlahAntrian = mysqli_num_rows($datasql);

//Query Kategori
if (isset($_POST['cari'])) {
    $keyword = $_POST['kategori'];

    $jumlahDataPerHalaman = 30;
    $jumlahData = count(query("SELECT * FROM data_antrian WHERE nama_pekerjaan LIKE '%$keyword%'"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $sql = query("SELECT * FROM data_antrian WHERE nama_pekerjaan='$keyword' ORDER BY no_antrian DESC LIMIT $awalData,$jumlahDataPerHalaman");

    $datasql = mysqli_query($connect, "SELECT * FROM data_antrian WHERE nama_pekerjaan LIKE '%$keyword%'");
    $jumlahAntrian = mysqli_num_rows($datasql);
}
//Query Keyword
if (isset($_POST['cariKeyword'])) {
    $keyword = $_POST['lacakKeyword'];

    $jumlahDataPerHalaman = 30;
    $jumlahData = count(query("SELECT * FROM data_antrian WHERE keyword_stempel LIKE '%$keyword%'"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $sql = query("SELECT * FROM data_antrian WHERE keyword_stempel LIKE '%$keyword%' ORDER BY no_antrian DESC LIMIT $awalData,$jumlahDataPerHalaman");

    $datasql = mysqli_query($connect, "SELECT * FROM data_antrian WHERE keyword_stempel LIKE '%$keyword%'");
    $jumlahAntrian = mysqli_num_rows($datasql);
}
//Query Workshop
if (isset($_POST['cariWorkshop'])) {
    $keyword = $_POST['workshop'];

    $jumlahDataPerHalaman = 30;
    $jumlahData = count(query("SELECT * FROM data_antrian WHERE tempat_workshop LIKE '%$keyword%'"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $jumlahData = count(query("SELECT * FROM data_antrian WHERE tempat_workshop='$keyword'"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['workshop'])) ? $_GET['workshop'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $sql = query("SELECT * FROM data_antrian WHERE tempat_workshop='$keyword' ORDER BY no_antrian DESC LIMIT $awalData,$jumlahDataPerHalaman");

    $datasql = mysqli_query($connect, "SELECT * FROM data_antrian WHERE tempat_workshop='$keyword'");
    $jumlahAntrian = mysqli_num_rows($datasql);
}

if (isset($_POST['hapusFilter'])) {
    unset($_POST);
    $sql = query("SELECT * FROM data_antrian ORDER BY no_antrian DESC");
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

    <!-- Content -->
    <div class="container-fluid" style="margin-top: 4rem;">
        <div class="row mx-auto mt-3 bg-warning p-2 rounded">
            <h2 class="text-center" style="font-weight: bold;">Daftar Antrian</h2>
        </div>
        <div class="row mx-auto mt-3 bg-light p-2 rounded mb-3">
            <div class="row">
                <h4 class="text-center">Filter Pencarian</h4>
            </div>
            <hr>
            <!-- Cari berdasarkan kategori -->
            <form action="" method="POST" class="row mx-auto filterCari">
                <!-- Cari berdasarkan keyword stempel -->
                <div class="col">
                    <label for="kategori">
                        <h5 class="text-center">Keyword Stempel</h5>
                    </label>
                    <input type="text" class="form-control" id="keyword" name="lacakKeyword"
                        placeholder="Contoh : Bakso Aci">
                </div>
                <div class="col">
                    <label for="kategori">
                        <h5 class="text-center">Kategori</h5>
                    </label>
                    <select class="form-control" id="kategori" name="kategori">
                        <option value="">- Pilih Kategori -</option>
                        <?php
                        $pilihan = query("SELECT * FROM data_produk");

                        foreach ($pilihan as $pil) {
                            echo '<option value="' . $pil['nama_produk'] . '">' . $pil['nama_produk'] . '</option>';
                        }
                        ?>
                    </select>
                    <div class="col-auto my-2">
                        <input type="submit" class="btn btn-warning btn-sm cariKategori" name="cari"
                            value="Cari kategori"></input>
                        <button type="submit" class="btn btn-outline-danger btn-sm" name="hapusFilter">Atur
                            ulang</button>
                    </div>
                </div>
                <!-- Cari berdasarkan tempat workshop -->
                <div class="col">
                    <label for="kategori">
                        <h5 class="text-center">Tempat Workshop</h5>
                    </label>
                    <select class="form-control selectWorkshop" id="kategori" name="workshop">
                        <option value="">- Pilih Tempat Workshop -</option>
                        <option value="Surabaya">Surabaya</option>
                        <option value="Malang">Malang</option>
                        <option value="Kediri">Kediri</option>
                    </select>
                    <div class="col-auto my-2 align-content-center">
                        <input type="submit" class="btn btn-warning btn-sm cariWorkshop" name="cariWorkshop"
                            value="Cari workshop"></input>
                        <button type="submit" class="btn btn-outline-danger btn-sm" name="hapusFilter">Atur
                            ulang</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row mx-auto">
            <div class="col-md-10">
                <div>
                    <h5 class="m-0"><?= $jumlahAntrian; ?> Antrian</h5>
                    <p style="font-size: 12px ;" class="m-0">Total Antrian Ditampilkan</p>
                </div>
            </div>
            <div class="col-md-2 text-end">
                <a class="btn btn-warning btn-sm" href="form-daftar.php"><i class="fa-solid fa-plus"></i><span
                        class="px-2">Tambah
                        Antrian</span></a>
            </div>
        </div>

        <div class="table-responsive my-3 mx-auto mt-3 bg-light rounded mb-3" id="tabel-utama">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sales</th>
                        <th scope="col">Keyword</th>
                        <th scope="col">Pekerjaan</th>
                        <!-- <th scope="col">Start</th> -->
                        <th scope="col">Deadline</th>
                        <th scope="col">Workshop</th>
                        <th scope="col" class="text-center">File Desain</th>
                        <th scope="col" class="text-center">File Dokumentasi</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($sql as $result) {
                        echo '<tr>';

                        // $kodeAntrian = preg_replace("/[^a-zA-Z0-9]/", "", $result['tanggal_antrian']);
                        // $kodeAntrian = $kodeAntrian . "-" . $result['no_antrian'];

                        echo '<td>' . $result['no_antrian'] . '</td>';
                        echo '<td>' . $result['nama_sales'] . '</td>';
                        echo '<td>' . $result['keyword_stempel'] . '</td>';
                        echo '<td>' . $result['nama_pekerjaan'] . '</td>';
                        // echo '<td>' . $result['mulai_kerja'] . '</td>';
                        echo '<td>' . $result['selesai_kerja'] . '</td>';
                        echo '<td>' . $result['tempat_workshop'] . '</td>';

                        echo '<td class="text-center">';
                        if ($result['file_desain'] == "") {
                            echo "<a href='edit-file.php?no_antrian=" . $result['no_antrian'] . "' type='button' class='btn btn-primary btn-sm'><i class='fa-solid fa-circle-arrow-up'></i><span class='mx-2'>Desain</span></a>";
                        } elseif ($result['file_desain'] != "") {
                            echo "<a href='edit-file.php?no_antrian=" . $result['no_antrian'] . "' type='button' class='btn btn-success btn-sm'><i class='fa-solid fa-circle-arrow-down'></i><span class='mx-2'>Download</span></a>";
                        }
                        echo '</td>';

                        echo '<td class="text-center">';
                        if ($result['file_dokumentasi'] == "") {
                            echo "<a href='upload-dokumentasi.php?no_antrian=" . $result['no_antrian'] . "' type='button' class='btn btn-primary btn-sm'><i class='fa-solid fa-circle-arrow-up'></i><span class='mx-2'>Dokumentasi</span></a>";
                        } else if ($result['file_dokumentasi'] != "") {
                            echo "<a href='upload-dokumentasi.php?no_antrian=" . $result['no_antrian'] . "' type='button' class='btn btn-success btn-sm'><i class='fa-solid fa-circle-check'></i><span class='mx-2'>Selesai</span></a>";
                        }
                        echo '</td>';

                        echo '<td>';
                        if ($result['file_desain'] == "" && $result['file_dokumentasi'] == "") {
                            echo '<span class="badge bg-danger text-light">Belum</span>';
                        } else if ($result['file_desain'] != "" && $result['file_dokumentasi'] == "") {
                            echo '<span class="badge bg-warning text-dark">Proses</span>';
                        } else if ($result['file_desain'] != "" && $result['file_dokumentasi'] != "") {
                            echo '<span class="badge bg-success text-light">Selesai</span>';
                        }
                        echo '</td>';

                        echo '<td class="text-center">';
                        echo '  <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Edit
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <a class="dropdown-item" href="edit-antrian.php?no_antrian=' . $result['no_antrian'] . '">Edit Antrian</a>
                                    <a class="dropdown-item deleteAntrian" href="delete-antrian.php?no_antrian=' . $result['no_antrian'] . '">Hapus Antrian</a>
                                ';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($halamanAktif > 1) : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;/a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                <li class="page-item active"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                <?php else : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                <?php endif; ?>
                <?php endfor; ?>

                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
                </li>
                <?php endif; ?>

            </ul>
        </nav>

        <script>
        $(document).ready(function() {
            $('.deleteAntrian').click(function() {
                var getLink = $(this).attr('href');
                Swal.fire({
                    title: "Yakin hapus antrian?",
                    icon: 'warning',
                    html: "<p style='color:red;'><strong>Perhatian</strong> : Antrian tidak dapat dipulihkan kembali!</p>",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonColor: '#3085d6',
                    cancelButtonText: "Batal"

                }).then(result => {
                    //jika klik ya maka arahkan ke proses.php
                    if (result.isConfirmed) {
                        window.location.href = getLink;
                    }
                })
                return false;
            });
        });
        </script>
    </div>
    <!-- End Content -->

    <script src="js/script.js"></script>
</body>

</html>