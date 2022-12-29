<!DOCTYPE html>
<html>
<head>
    <title>Antree | Daftar Antrian</title>

    <!-- Menyertakan file CSS Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Menyertakan file CSS DataTables -->
    <link rel="stylesheet" href="css/datatables.min.css">

    <!-- file Font Awesome -->
    <script src="https://kit.fontawesome.com/a49a4a7eca.js" crossorigin="anonymous"></script>

    <!-- CSS Bootstrap 5 CDN -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid position-relative">
            <nav class="nav nav-pills nav-fill">
                <a href="list-antrian.php"><img src="logo/antree-brand.png" alt="logo-antree" height="32px" class="pt-1 me-4 ms-3"></a>
                <a class="nav-link text-warning" aria-current="page" href="#">Dashboard</a>
                <a class="nav-link active bg-warning text-dark" href="admin-workshop.php">Antrian</a>
                <a class="nav-link text-warning" href="#">Data Customer</a>
                <a class="nav-link text-warning" href="dokumentasi-page.php" tabindex="-1"
                    aria-disabled="true">Dokumentasi</a>
                <div class="position-absolute top-50 end-0 translate-middle-y">
                    <a href="logout.php" class="nav-link float-end text-warning"><i
                            class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                </div>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Container untuk tabel -->
    <div class="container mt-5">
        <h1>Daftar Antrian</h1>
        <!-- Button tambah antrian -->
        <div class="" style="width: 100%;">
        <button class="btn btn-sm btn-warning float-right mt-1 mb-4">+ Tambah Antrian</button>
        </div>
        <table id="usersTable" class="table table-striped table-bordered table-hover">
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
                    <th>File Desain</th>
                    <th>Dokumentasi</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Koneksi ke database
                include('connection.php');

                // Query untuk mengambil semua data dari tabel 'users'
                $query = "SELECT * FROM data_antrian";

                // Menjalankan query dan menyimpan hasilnya dalam variabel $result
                $result = mysqli_query($connect, $query);
                // Menampilkan data dari database di tabel
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['no_antrian'] . '</td>';
                    echo '<td>' . $row['keyword_stempel'] . '</td>';
                    echo '<td>' . $row['nama_pekerjaan'] . '</td>';
                    echo '<td>' . $row['selesai_kerja'] . '</td>';
                    echo '<td>' . $row['nama_desainer'] . '</td>';
                    echo '<td>' . $row['nama_operator'] . '</td>';
                    echo '<td>' . $row['nama_finishing'] . '</td>';
                    echo '<td>' . $row['nama_qc'] . '</td>';
                    //Tombol File Desain
                    if($row['file_desain'] == ""){
                        echo '<td class="text-center"><a type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-solid fa-xs fa-circle-arrow-down"></i> Belum</a></td>';
                    }else{
                        echo '<td class="text-center"><a type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-xs fa-circle-arrow-down"></i> Siap</a></td>';
                    }
                    //Tombol Dokumentasi
                    if($row['file_dokumentasi'] == ""){
                        echo '<td class="text-center"><a type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-regular fa-xs fa-circle-xmark"></i> Dokumentasi</a></td>';
                    }else{
                        echo '<td class="text-center"><a type="button" class="btn btn-success btn-sm"><i class="fa-xs fa-solid fa-arrow-up-right-from-square"></i> Dokumentasi</b></td>';
                    }
                    //Tombol Opsi
                    echo '<td class="text-center">';
                        echo '<div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-warning btn-sm">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                      </div>';
                        echo '</td>';
                    echo '</tr>';
                }

                // Menutup koneksi ke database
                mysqli_close($connect);
                ?>
            </tbody>
        </table>
    </div>

    <!-- Menyertakan file JavaScript jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Menyertakan file JavaScript Bootstrap -->
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Menyertakan file JavaScript DataTables -->
    <script src="js/datatables.min.js"></script>

    <!-- Inisialisasi plugin DataTables -->
    <script>
    $(document).ready(function() {
        $('#usersTable').DataTable();
    });
    </script>
</body>
</html>
