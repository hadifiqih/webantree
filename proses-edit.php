<?php

session_start();

if(!isset($_SESSION['login'])){
    header('location:login.php');
    exit;
}

include('connection.php');

$id = $_POST['noAntrian'];
$sales = $_POST['isSales'];
$keyword = $_POST['keywordStamp'];
$pekerjaan = $_POST['whatJob'];
$desainer = $_POST['isDesainer'];
$operator = $_POST['isOperator'];
$finishing = implode(",", $_POST['isFinishing']);
$workshop = $_POST['whereWorkshop'];
$qc = $_POST['isQC'];

//Tanggal dan No. Antrian
$mulai = $_POST['startJob'];

$selesai = $_POST['finishJob'];

$tanggal = $_POST['tanggal'];

$query = mysqli_query($connect, "UPDATE data_antrian SET tanggal_antrian='$tanggal', nama_sales='$sales', keyword_stempel='$keyword', nama_pekerjaan='$pekerjaan', mulai_kerja='$mulai', selesai_kerja='$selesai', tempat_workshop='$workshop', nama_desainer='$desainer', nama_operator='$operator', nama_finishing='$finishing', nama_qc='$qc' WHERE no_antrian='$id'");

if ($query) {
    header('location:list-antrian.php?pesan=edited');
} else {
    header('location:list-antrian.php?pesan=notedited');
}