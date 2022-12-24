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
  $max_size = 2048000;

  // Check if file is allowed
  if (in_array($file_ext, $allowed) && $file_error === 0 && $file_size <= $max_size) {
    // Generate new file name
    $new_file_name = uniqid('', true) . '.' . $file_ext;

    // Destination folder
    $destination = 'uploads/' . $new_file_name;

    // Move file to destination
    if (move_uploaded_file($file_tmp, $destination)) {
      echo "File uploaded successfully.";
    } else {
      echo "Failed to move file.";
    }
  } else {
    echo "Invalid file.";
  }
}

?>
