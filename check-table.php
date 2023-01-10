<?php

// koneksi ke database
include('connection.php');

// mengecek apakah terdapat perubahan data
$result = mysqli_query($connect, 'SELECT * FROM data_antrian WHERE updated_at > NOW() - INTERVAL 5 SECOND');
if (mysqli_num_rows($result) > 0) {
    // jika ada perubahan data, kirim respon berupa JSON dengan indikator perubahan data
    $response = ['hasChanged' => true];
} else {
    // jika tidak ada perubahan data, kirim respon berupa JSON dengan indikator tidak adanya perubahan data
    $response = ['hasChanged' => false];
}

print_r($response);
// mengirim respon
header('Content-Type: application/json');
echo json_encode($response);