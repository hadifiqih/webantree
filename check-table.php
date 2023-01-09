<?php

// Terhubung ke database
include('connection.php');

// Ambil timestamp terakhir saat tabel diperbarui
$result = mysqli_query($connect, 'SELECT updated_at FROM data_antrian ORDER BY updated_at DESC LIMIT 1');
$row = mysqli_fetch_assoc($result);
$last_updated_at = $row['updated_at'];

// Periksa apakah ada perubahan data setelah timestamp terakhir
$result = mysqli_query($connect, "SELECT COUNT(*) FROM data_antrian WHERE updated_at > '$last_updated_at'");
$row = mysqli_fetch_assoc($result);
$count = $row['COUNT(*)'];

if ($count > 0) {
    // Jika ada perubahan data, kirim "update" ke client
    echo 'update';
} else {
    // Jika tidak ada perubahan data, kirim "no update" ke client
    echo 'no update';
}