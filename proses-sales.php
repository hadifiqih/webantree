<?php

session_start();

if(!isset($_SESSION['login'])){
    header('location:login.php');
    exit;
}

include('connection.php');

if (isset($_POST['daftar'])) {
    $noAntrian = $_POST['noAntrian'];
    $sales = $_POST['isSales'];
    $keyword = $_POST['keywordStamp'];
    $pekerjaan = $_POST['whatJob'];
    $omset = $_POST['omset'];
    $namaCS = $_POST['namaPelanggan'];
    $noTelepon = $_POST['noPelanggan'];
    $alamat = $_POST['alamatPelanggan'];
    $info = $_POST['iklanPelanggan']; 
    $stsAntrian = 1;

    //Tanggal Antrian
    $tanggal = $_POST['tanggal'];    
            
    $sql = "INSERT INTO data_antrian (tanggal_antrian, no_antrian, nama_sales, keyword_stempel, nama_pekerjaan, omset) VALUES ('$tanggal', '$noAntrian', '$sales', '$keyword', '$pekerjaan', '$omset')";
    $sqlPelanggan = "INSERT INTO data_pelanggan (id, nama_cs, no_telepon, alamat_cs, info_iklan) VALUES ('$noAntrian', '$namaCS', '$noTelepon', '$alamat', '$info')";

    $query = mysqli_query($connect, $sql);
    $queryPelanggan = mysqli_query($connect,$sqlPelanggan);

    if($query && $queryPelanggan){
        echo "<script>alert('Antrian Sukses Dimasukkan')</script>";
        header('location:sales.php?antrian=sukses');
    }else{
        echo "<script>alert('Antrian Gagal Dimasukkan')</script>";
    }
}