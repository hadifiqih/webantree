<?php

session_start();

if(!isset($_SESSION['login'])){
    header('location:login.php');
    exit;
}

include('connection.php');
if(isset($_POST['submitFile'])){

$id = $_POST['antrian'];

$namafile = $_FILES['uFile']['name'];
$ukuranfile = $_FILES['uFile']['size'];

print_r($namafile);

if($ukuranfile > 20971520){
        header('location: list-antrian.php?pesan=size');
    }
        if ($namafile != ""){
            $izinEkstensi = array('cdr', 'pdf', 'ai');
            $pisahEkstensi = explode('.',$namafile);
            $ekstensi = strtolower(end($pisahEkstensi));

            $file_tmp = $_FILES['uFile']['tmp_name'];
            $namaEnc = md5(rand(5,11));

            $namaFileBaru = $namaEnc . '-' . $namafile;

            if(in_array($ekstensi,$izinEkstensi) === true){
                //----------------------------------------
                move_uploaded_file($file_tmp, 'file/'.$namaFileBaru);
                
                $sql = "UPDATE data_antrian SET file_desain='$namaFileBaru' WHERE no_antrian='$id'";
                $query = mysqli_query($connect, $sql);

                if ($query) {
                    header('location: list-antrian.php?pesan=fileberhasil');
                } else {
                    print_r(mysqli_error($connect));
                }
            }
            else{
                header('location: list-antrian.php?pesan=salahekstensi');
            }
        }
        else{
            header('location: list-antrian.php?pesan=filekosong');
        }

    }