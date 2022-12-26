<?php

include("connection.php");

$files = $_FILES;

$id = $_POST['antrian'];

$folderUpload = "./dokumentasi/{$id}";

# periksa apakah folder tersedia
if (!is_dir($folderUpload)) {
    # jika tidak maka folder harus dibuat terlebih dahulu
    mkdir($folderUpload, 0777, $rekursif = true);
}

$jumlahFile = count($files['listGambar']['name']);

$namaToDB = array();

for ($i = 0; $i < $jumlahFile; $i++) {
    $namaFile = $files['listGambar']['name'][$i];
    $lokasiTmp = $files['listGambar']['tmp_name'][$i];

    # kita tambahkan uniqid() agar nama gambar bersifat unik
    $namaBaru = uniqid() . '-' . $namaFile;

    $namaToDB[] = $namaBaru;

    $lokasiBaru = "{$folderUpload}/{$namaBaru}";

    $prosesUpload = move_uploaded_file($lokasiTmp, $lokasiBaru);

    # jika proses berhasil
    if ($prosesUpload) {
      echo "Upload file <a href='{$lokasiBaru}' target='_blank'>{$namaBaru}</a> berhasil. <br>";
      header('location: list-antrian.php?pesan=fileberhasil');

  } else {
      echo "<span style='color: red'>Upload file {$namaFile} gagal</span> <br>";
  }

}
    $namaToString = implode(', ', $namaToDB[]);
    
    $sql = "UPDATE data_antrian SET file_dokumentasi='$namaToString' WHERE no_antrian='$id'";
    mysqli_query($connect,$sql);

?>
