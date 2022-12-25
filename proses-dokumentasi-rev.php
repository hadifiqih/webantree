<?php

// Check if file was uploaded
if (isset($_FILES['file'])) {
  // File details
  $file_name = $_FILES['file']['name'];
  $file_tmp = $_FILES['file']['tmp_name'];
  $file_size = $_FILES['file']['size'];
  $file_error = $_FILES['file']['error'];

  

  // File extension
  $file_ext = explode('.', $file_name);
  $file_ext = strtolower(end($file_ext));

  // Allowed file types
  $allowed = array('png', 'jpg', 'jpeg', 'pdf');

  // Max file size (in bytes)
  $max_size = 20480000;

  // Check if file is allowed
  if (in_array($file_ext, $allowed) && $file_error === 0 && $file_size <= $max_size) {
    // Generate new file name
    $new_file_name = uniqid('', true) . '.' . $file_ext;

    // Destination folder
    $destination = 'dokumentasi/' . $new_file_name;

    // Cek Folder ada / tidak
    if(!is_dir($destination)){
      mkdir($destination,0755);
    }else{
      echo "Folder sudah terbuat";
    }

    // Move file to destination
    if (move_uploaded_file($file_tmp, $destination)) {
      $sql = "UPDATE data_antrian SET file_dokumentasi='$new_file_name' WHERE no_antrian='$id'";
      $query = mysqli_query($connect, $sql);

      if($query){
        echo "File uploaded successfully.";
      }
    } else {
      echo "Failed to move file.";
    }
  } else {
    echo "Invalid file.";
  }
}

?>
