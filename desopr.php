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

</head>
<body>
   <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="login.php">
        <img src="logo/antree-brand.png" alt="Antree Logo" width="100">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" href="#">Antrian</a>
          <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
        </div>
      </div>
    </div>
  </nav>
    <!-- End Navbar -->
    <!-- Container untuk tabel -->
    <div class="container mt-5 table-responsive">
        <h1>Daftar Antrian</h1>
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
                        echo '<td class="text-center"><a href="edit-file.php?no_antrian='.$row['no_antrian'].'"type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-arrow-up"></i> Unggah</a></td>';
                    }else{
                        echo '<td class="text-center"><a href="file/'.$row['file_desain'].'" type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-xs fa-circle-arrow-down"></i> Unduh</a></td>';
                    }
                    //Tombol Dokumentasi
                    if($row['file_dokumentasi'] == ""){
                        echo '<td class="text-center"><a href="upload-dokumentasi.php?no_antrian='.$row['no_antrian'].'" type="button" class="btn btn-danger btn-sm"><i class="fa-xs fa-solid fa-arrow-up"></i> Unggah</a></td>';
                    }else{
                        echo '<td class="text-center"><a href="dokumentasi.php?no_antrian='.$row['no_antrian'].'" type="button" class="btn btn-success btn-sm"><i class="fa-xs fa-solid fa-arrow-up-right-from-square"></i> Lihat</a></td>';
                    }
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
