<?php

session_start();

if(!isset($_SESSION['login'])){
    header('location:login.php');
    exit;
}

include("connection.php");

if( isset($_GET['no_antrian']) ){

    // ambil id dari query string
    $id = $_GET['no_antrian'];

    // buat query hapus
    $sql = "DELETE FROM data_antrian WHERE no_antrian=$id";
    $query = mysqli_query($connect, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        header('Location: list-antrian.php');
    } else {
        die("gagal menghapus...");
    }

} else {
    die("akses dilarang...");
}

?>