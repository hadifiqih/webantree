<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
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
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid position-relative">
            <nav class="nav nav-pills nav-fill">
                <a href="list-antrian.php"><img src="logo/antree-brand.png" alt="logo-antree" height="32px" class="pt-1 me-4 ms-3"></a>
                <a class="nav-link text-warning" aria-current="page" href="#">Dashboard</a>
                <a class="nav-link active bg-warning text-dark" href="list-antrian.php">Antrian</a>
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
        <a class="btn btn-sm btn-warning float-right mt-1 mb-4" href="tambah-antrian.php">+ Tambah Antrian</a>
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
                    //Tombol Dokumentasi
                    if($row['file_dokumentasi'] == ""){
                        echo '<td class="text-center"><button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-regular fa-xs fa-circle-xmark"></i> Dokumentasi</button></td>';
                    }else{
                        echo '<td class="text-center"><a type="button" class="btn btn-success btn-sm"><i class="fa-xs fa-solid fa-arrow-up-right-from-square"></i> Dokumentasi</a></td>';
                    }
                    echo '</tr>';
                }

                // Menutup koneksi ke database
                mysqli_close($connect);
                ?>
            </tbody>
        </table>
    </div>

<!-- Button trigger modal -->
<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#iniModal">
  Open Modal
</a>

<!-- Modal -->
<div class="modal fade" id="iniModal" tabindex="-1" role="dialog" aria-labelledby="iniModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="iniModalLabel">Modal Title</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      <div class="modal-body">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="dokumentasi/1679091c5a880faf6fb5e6087eb1b2dc-stempel spunbound.jpeg" class="img-fluid" alt="Responsive image">
            </div>
            <div class="carousel-item">
              <img src="dokumentasi/6512bd43d9caa6e02c990b0a82652dca-karnopel kotak regular.jpg" class="img-fluid" alt="Responsive image">
            </div>
            <div class="carousel-item">
              <img src="dokumentasi/Wga.jpg" class="img-fluid" alt="Responsive image">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
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
        $('#usersTable').DataTable();
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
