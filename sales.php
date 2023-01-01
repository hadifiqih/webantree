<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Antree | Daftar Antrian</title>

    <!-- Menyertakan file CSS Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Menyertakan file CSS DataTables -->
    <link rel="stylesheet" href="css/datatables.min.css">

    <!-- file Font Awesome -->
    <script src="https://kit.fontawesome.com/a49a4a7eca.js" crossorigin="anonymous"></script>

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
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
    <div class="container my-3">
        <h1>Daftar Antrian</h1>
        <!-- Button tambah antrian -->
        <a href="tambah-antrian.php" class="btn btn-sm btn-warning float-end ms-2">+ Tambah Antrian</a>
        
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
                    <th>Omset</th>
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
                    echo '<td>'. number_format($row['omset'], 0 , "," , ".") .'</td>';
                    //Tombol Dokumentasi
                    if($row['file_dokumentasi'] == ""){
                        echo '<td class="text-center"><button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-regular fa-xs fa-circle-xmark"></i> Dokumentasi</button></td>';
                    }else{
                      echo '<td class="text-center"><a href="dokumentasi.php?no_antrian='. $row['no_antrian'].'" type="button" class="btn btn-success btn-sm"><i class="fa-xs fa-solid fa-arrow-up-right-from-square"></i> Dokumentasi</a></td>';
                    }
                    echo '</tr>';
                }

                // Menutup koneksi ke database
                mysqli_close($connect);
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>    

    <!-- Menyertakan file JavaScript jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Menyertakan file JavaScript Bootstrap -->
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Menyertakan file JavaScript DataTables -->
    <script src="js/datatables.min.js"></script>

    <!-- Inisialisasi plugin DataTables -->
    <script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
          responsive:true,
          scrollX:true
        });
    });
    </script>
    <script>
      const myModal = document.getElementById('iniModal')
      const myInput = document.getElementById('myInput')

      myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
      })
    </script>
</body>
</html>
