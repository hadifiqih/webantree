<?php

$files = $_FILES;

$id = $_POST['antrian'];

$folderUpload = "./dokumentasi/{$id}";

# periksa apakah folder tersedia
if (!is_dir($folderUpload)) {
    # jika tidak maka folder harus dibuat terlebih dahulu
    mkdir($folderUpload, 0777, $rekursif = true);
}

$jumlahFile = count($files['listGambar']['name']);

for ($i = 0; $i < $jumlahFile; $i++) {
    $namaFile = $files['listGambar']['name'][$i];
    $lokasiTmp = $files['listGambar']['tmp_name'][$i];

    # kita tambahkan uniqid() agar nama gambar bersifat unik
    $namaBaru = uniqid() . '-' . $namaFile;

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

foreach ($_FILES['listGambar']['name'] as $namaGambar => $value) {
    $namaSatuan = $_FILES['listGambar']['name'][$namaGambar];

    $sql = "UPDATE data_antrian SET file_dokumentasi='$namaSatuan' WHERE no_antrian='$id'";
    mysqli_query($connect,$sql);
}

mysqli_close($connect);

?>
