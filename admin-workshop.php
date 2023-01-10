<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header('location:login.php');
        exit;
    }
    // Koneksi ke database
    include('connection.php');

    ?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Antree | Daftar Antrian</title>

<!-- Menyertakan file CSS DataTables -->
<link rel="stylesheet" href="css/datatables.min.css">

<!-- file Font Awesome -->
<script src="https://kit.fontawesome.com/a49a4a7eca.js" crossorigin="anonymous"></script>

<!-- CSS Bootstrap 5 CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo/antree-brand.png" alt="Antree Logo" width="100">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active">Antrian</a>
                    <a class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Container untuk tabel -->
    <div class="container mt-5">
        <h1 class="text-center">Daftar Antrian Admin Workshop</h1>
        <br>
        <!-- Button tambah antrian -->
        <a href="tambah-antrian.php" class="btn btn-sm btn-warning float-end ms-2">+ Tambah Antrian</a>


        <table id="usersTable" class="table table-striped table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Keyword</th>
                    <th>Pekerjaan</th>
                    <th>Deadline</th>
                    <th>Desainer</th>
                    <th>Operator</th>
                    <th>Finishing</th>
                    <th>QC</th>
                    <th>Omset</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php

    // Query untuk mengambil semua data dari tabel 'users'
    $query = "SELECT * FROM data_antrian";
    // Menjalankan query dan menyimpan hasilnya dalam variabel $result
    $result = mysqli_query($connect, $query);
    // Menampilkan data dari database di tabel
    foreach ($result as $row => $data) {
        echo '<tr>';
        echo '<td id="orderIdValue">' . $data['no_antrian'] . '</td>';
        echo '<td>' . $data['keyword_stempel'] . '</td>';
        echo '<td>' . $data['nama_pekerjaan'] . '</td>';
        echo '<td>' . $data['selesai_kerja'] . '</td>';
        echo '<td>' . $data['nama_desainer'] . '</td>';
        echo '<td>' . $data['nama_operator'] . '</td>';
        echo '<td>' . $data['nama_finishing'] . '</td>';
        echo '<td>' . $data['nama_qc'] . '</td>';
        echo '<td>' . $data['omset'] . '</td>';
        //Tombol Opsi
        echo '<td class="text-center">';
        echo '<div class="btn-group" role="group" aria-label="Tombol Opsi">
                        <a type="button" href="edit-antrian.php?no_antrian='.$data['no_antrian'].'" class="btn btn-warning btn-sm">Edit</a>
                        <a type="button" href="delete-antrian.php?no_antrian='.$data['no_antrian'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus Antrian?\')">Hapus</a>
                        <a id="tombolDetail" type="button" href="detail-antrian.php?no_antrian='.$data['no_antrian'].'" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailOrder" data-record-id="'.$data['no_antrian'].'" disabled>Detail</a>
                      </div>';
        echo '</td>';
        echo '</tr>';
    }


    // Koneksi ke database MySQL

    // Ambil data terbaru dari tabel 'data'
    $result2 = mysqli_query($connect, 'SELECT * FROM data ORDER BY id DESC LIMIT 1');
    $dataa = mysqli_fetch_assoc($result2);
    print_r($dataa);

    $prevData = null;

    // Bandingkan data terbaru dengan data sebelumnya
    if ($dataa != $prevData) {
        // Output suara notifikasi menggunakan JavaScript
        echo '<audio src="music/notif.mp3" autoplay></audio>';

        // Simpan data terbaru sebagai data sebelumnya untuk perbandingan di iterasi selanjutnya
        $prevData = $dataa;
    }


    // Menutup koneksi ke database
    mysqli_close($connect);
    ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Detail Order -->
    <div class="modal fade" id="detailOrder" tabindex="-1" aria-labelledby="detailOrderLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailOrderLabel">Detail Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID Order</th>
                            <td><span id="orderId"></span></td>
                        </tr>
                        <tr>
                            <th>Nama Sales</th>
                            <td id="salesName"></td>
                        </tr>
                        <!-- Baris lainnya yang menampilkan detail keterangan order lainnya -->
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
            integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
        </script>

        <!-- Menyertakan file JavaScript DataTables -->
        <script src="js/datatables.min.js"></script>

        <!-- Inisialisasi plugin DataTables -->
        <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                responsive: true,
                scrollX: true
            });

            // membuat audio element
            var audio = new Audio('music/notif.mp3');

            // membuat interval yang akan memeriksa database setiap 5 detik
            setInterval(function() {
                // menggunakan Ajax untuk memeriksa database
                $.ajax({
                    url: 'check-table.php',
                    success: function(response) {
                        // jika ada perubahan data, mainkan suara notifikasi
                        if (response.hasChanged) {
                            audio.play();
                        }
                    }
                });
            }, 5000); // setiap 5 detik

        });
        </script>
</body>

</html>