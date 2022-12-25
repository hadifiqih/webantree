<?php

<?php

$files = $_FILES;

$id = $_POST['antrian'];

$folderUpload = "dokumentasi/{$id}";

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

// // Check if file was uploaded
// if (isset($_FILES['file'])) {
//   // File details
//   $file_name = $_FILES['file']['name'];
//   $file_tmp = $_FILES['file']['tmp_name'];
//   $file_size = $_FILES['file']['size'];
//   $file_error = $_FILES['file']['error'];

//   // File extension
//   $file_ext = explode('.', $file_name);
//   $file_ext = strtolower(end($file_ext));

//   // Allowed file types
//   $allowed = array('png', 'jpg', 'jpeg', 'pdf');

//   // Max file size (in bytes)
//   $max_size = 20480000;

//   // Check if file is allowed
//   if (in_array($file_ext, $allowed) && $file_error === 0 && $file_size <= $max_size) {
//     // Generate new file name
//     $new_file_name = uniqid('', true) . '.' . $file_ext;

//     // Destination folder
//     $destination = 'dokumentasi/' . $new_file_name;

//     // Move file to destination
//     if (move_uploaded_file($file_tmp, $destination)) {
//       $sql = "INSERT INTO data_antrian (file_dokumentasi) VALUES ('$new_file_name')";
//       $query = mysqli_query($connect, $sql);
//       if($query){
//         echo "File uploaded successfully.";
//       }
//     } else {
//       echo "Failed to move file.";
//     }
//   } else {
//     echo "Invalid file.";
//   }
// }

?>

// // Check if file was uploaded
// if (isset($_FILES['file'])) {
//   // File details
//   $file_name = $_FILES['file']['name'];
//   $file_tmp = $_FILES['file']['tmp_name'];
//   $file_size = $_FILES['file']['size'];
//   $file_error = $_FILES['file']['error'];

//   $id = $_POST['antrian'];

//   // File extension
//   $file_ext = explode('.', $file_name);
//   $file_ext = strtolower(end($file_ext));

//   // Allowed file types
//   $allowed = array('png', 'jpg', 'jpeg', 'pdf');

//   // Max file size (in bytes)
//   $max_size = 20480000;

//   // Check if file is allowed
//   if (in_array($file_ext, $allowed) && $file_error === 0 && $file_size <= $max_size) {
//     // Generate new file name
//     $new_file_name = uniqid('', true) . '.' . $file_ext;

//     // Destination folder
//     $destination = 'dokumentasi/' . $new_file_name;

//     // Cek Folder ada / tidak
//     if(!is_dir($destination)){
//       mkdir($destination,0755);
//     }else{
//       echo "Folder sudah terbuat";
//     }

//     // Move file to destination
//     if (move_uploaded_file($file_tmp, $destination)) {
//       $sql = "UPDATE data_antrian SET file_dokumentasi='$new_file_name' WHERE no_antrian='$id'";
//       $query = mysqli_query($connect, $sql);

//       if($query){
//         echo "File uploaded successfully.";
//       }
//     } else {
//       echo "Failed to move file.";
//     }
//   } else {
//     echo "Invalid file.";
//   }
// }

?>
