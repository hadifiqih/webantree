<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

include('connection.php');

if (isset($_POST['daftar'])) {
    $noAntrian = $_POST['noAntrian'];
    $sales = $_POST['isSales'];
    $keyword = $_POST['keywordStamp'];
    $pekerjaan = $_POST['whatJob'];
    $desainer = $_POST['isDesainer'];
    $operator = $_POST['isOperator'];
    $finishing = implode(",", $_POST['isFinishing']);
    $workshop = $_POST['whereWorkshop'];
    $qc = $_POST['isQC'];
    $buktiBayar = $_POST['buktiBayar'];
    $omset = $_POST['omset'];
    $keterangan = $_POST['keterangan'];
    $stsAntrian = 1;

    //Tanggal dan No. Antrian
    $mulai = $_POST['startJob'];

    $selesai = $_POST['finishJob'];

    $tanggal = $_POST['tanggal'];

    //File Upload
    $namafile = $_FILES['uFile']['name'];
    $namaBuktibayar = rand(1, 999).'-'.$_FILES['buktiBayar']['name'];
    $ukuranfile = $_FILES['uFile']['size'];

    if ($namafile != "") {
        $izinEkstensi = array('cdr', 'pdf', 'ai');
        $pisahEkstensi = explode('.', $namafile);
        $ekstensi = strtolower(end($pisahEkstensi));

        $file_tmp = $_FILES['uFile']['tmp_name'];
        $tmp_buktiBayar = $_FILES['buktiBayar']['tmp_name'];
        $namaEnc = rand(1, 999);

        $namaFileBaru = $namaEnc . '-' . $namafile;

        if (in_array($ekstensi, $izinEkstensi) === true) {
            move_uploaded_file($file_tmp, 'file/' . $namaFileBaru);
            move_uploaded_file($tmp_buktiBayar, 'bukti/' . $namaBuktibayar);

            $sql = "INSERT INTO data_antrian (tanggal_antrian, no_antrian, nama_sales, keyword_stempel, nama_pekerjaan, mulai_kerja, selesai_kerja, tempat_workshop, nama_desainer, nama_operator, nama_finishing, nama_qc, file_desain, omset, bukti_bayar, keterangan) VALUES ('$tanggal', '$noAntrian', '$sales', '$keyword', '$pekerjaan', '$mulai', '$selesai', '$workshop', '$desainer', '$operator', '$finishing', '$qc', '$namaFileBaru', '$omset', '$namaBuktibayar', '$keterangan');";

            $query = mysqli_query($connect, $sql);

            if (!$query) {
                die("Query gagal dijalankan: ".mysqli_errno($connect).
                       " - ".mysqli_error($connect));
            } else {
                $_SESSION['successAntrian'];
                header('location: list-antrian.php');
            }
        } else {
            $_SESSION['salah_ekstensi'] = 'Upload file sesuai ekstensi!';
            header('location: list-antrian.php');
        }
    } else {
        // $_SESSION['kosong'] = 'Mohon maaf, file tidak boleh kosong!';

        $sql = "INSERT INTO data_antrian (tanggal_antrian, no_antrian, nama_sales, keyword_stempel, nama_pekerjaan, mulai_kerja, selesai_kerja, tempat_workshop, nama_desainer, nama_operator, nama_finishing, nama_qc) VALUES ('$tanggal', '$noAntrian', '$sales', '$keyword', '$pekerjaan', '$mulai', '$selesai', '$workshop', '$desainer', '$operator', '$finishing', '$qc');";

        $query = mysqli_query($connect, $sql);

        header('location: list-antrian.php?desainkosong');
    }
}