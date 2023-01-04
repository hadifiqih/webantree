<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

include('connection.php');
if (isset($_POST['submitFile'])) {
    $id = $_POST['antrian'];
    $namaKecil = $_POST['namaKecil'];

    $namafile = $_FILES['uFile']['name'];
    $ukuranfile = $_FILES['uFile']['size'];

    print_r($namafile);

    if ($ukuranfile > 20971520) {
        header('location: list-antrian.php?pesan=size');
    }
    if ($namafile != "") {
        $izinEkstensi = array('cdr', 'pdf', 'ai');
        $pisahEkstensi = explode('.', $namafile);
        $ekstensi = strtolower(end($pisahEkstensi));

        $file_tmp = $_FILES['uFile']['tmp_name'];
        $namaEnc = md5(random_int(5, 11));

        $namaFileBaru = $namaEnc . '-' . $namafile;

        if (in_array($ekstensi, $izinEkstensi) === true) {
            //----------------------------------------
            move_uploaded_file($file_tmp, 'file/'.$namaFileBaru);

            $sql = "UPDATE data_antrian SET file_desain='$namaFileBaru', nama_desainer='$namaKecil' WHERE no_antrian='$id'";
            $query = mysqli_query($connect, $sql);

            if ($query) {
                header('location: index.php');
            } else {
                print_r(mysqli_error($connect));
            }
        } else {
            echo "Ekstensi Salah";
        }
    } else {
        echo "File Kosong";
    }
}
