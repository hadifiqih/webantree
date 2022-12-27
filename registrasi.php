<?php

session_start();

if (isset($_SESSION['login'])) {
    header('location:list-antrian.php');
    exit;
}

require 'connection.php';

if(isset($_POST['register'])){

    $username = $_POST['username'];
    $namaLengkap = $_POST['namaUser'];
    $kataSandi = $_POST['password'];
    $divisi = $_POST['divisi'];

    //Enkripsi Password
    $saltKeamanan = bin2hex(random_bytes(32));
    $sandiTerenkripsi = hash('sha256', $saltKeamanan . $kataSandi);

    //select username terdaftar
    $sql = "SELECT * FROM data_user WHERE username='$username'";
    $query = mysqli_query($connect,$sql);
    // cek username terdaftar
    if(mysqli_num_rows($query) > 0){
        echo '<div class="alert alert-danger" role="alert">Username sudah terdaftar, gunakan username lain !</div>"';
    }
    else {
        //Jika username aman, Menyimpan ke database
        $sql = "INSERT INTO data_user (username, kata_sandi, salt , nama, divisi) VALUES ('$username', '$sandiTerenkripsi', '$saltKeamanan' , '$namaLengkap', '$divisi')";
        $query = mysqli_query($connect,$sql);

        echo '<div class="alert alert-success" role="alert">Registrasi berhasil, silahkan <a href="login.php" class="alert-link">klik disini</a> untuk login</div>"';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="M. Hadi Fiqih Pratama">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="This is a login page template based on Bootstrap 5">
    <title>Daftar - Antree Web App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="logo/antree-brand-dark.png" alt="logo" width="200">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Daftar</h1>

                            <form action="" method="POST" class="needs-validation" autocomplete="off" novalidate>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="name">Username</label>
                                    <input id="name" type="text" class="form-control" name="username" value="" required
                                        autofocus>
                                    <div class="invalid-feedback">
                                        Username is required
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="namaUser">Nama Lengkap</label>
                                    <input id="namaUser" type="text" class="form-control" name="namaUser" value="" required
                                        autofocus>
                                    <div class="invalid-feedback">
                                        Name is required
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="password">Kata Sandi</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="password">Konfirmasi Kata Sandi</label>
                                    <input id="password2" type="password" class="form-control" name="konfirm" required>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>

                                <div class="mb-3">
                                <label class="mb-2 text-muted" for="divis">Pilih Divisi</label>
                                <select id="divisi" name="divisi" class="form-select" aria-label="Default select example">
                                    <option selected>- Pilih Divisi -</option>
                                    <option value="sales">Sales</option>
                                    <option value="admin">Admin</option>
                                    <option value="desopr">Desain & Operator</option>
                                    <option value="admwrk">Admin Workshop</option>
                                    <option value="gudang">Gudang</option>
                                    <option value="marol">Marketing Online</option>
                                </select>
                                </div>

                                <p class="form-text text-muted mb-3">
                                    Dengan mendaftar Anda setuju dengan syarat dan ketentuan kami.
                                </p>

                                <div class="align-items-center d-flex">
                                    <button type="submit" class="btn btn-warning ms-auto" name="register">
                                        Daftar
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                Sudah memiliki akun? <a href="login.php" class="text-primary">Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-5 text-muted mb-5">
                        Copyright &copy; 2022 &mdash; by Hadi Fiqih
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>