<?php
session_start();
require 'connection.php';

if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($connect, "SELECT * FROM data_user WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);

    if($key === hash('sha512', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if(isset($_SESSION['login'])) {
    if(isset($_SESSION['admwrk'])) {
        header('Location:admin-workshop.php');
        exit;
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($connect, "SELECT * FROM data_user WHERE username='$username'");

    if (mysqli_num_rows($result) === 1) {
        //Cek password
        $row = mysqli_fetch_assoc($result);
        $sandiTerenkripsi = $row['kata_sandi'];
        $saltKeamanan = $row['salt'];

        //Memasang Cookie
        if (isset($_POST['remember'])) {
            setcookie('id', $row['id'], time() + (60*60*24*2));
            setcookie('key', hash('sha512', $row['username']), time() + (60*60*24*2));
        }

        $_SESSION['login'] = true;
        $_SESSION['divisi'] = $row['divisi'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['namaKecil'] = $row['nama_kecil'];


        $inputTerenkripsi = hash('sha256', $saltKeamanan . $password);

        if ($sandiTerenkripsi == $inputTerenkripsi) {
            header('location:index.php');
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="M. Hadi Fiqih Pratama">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="This is a login page template based on Bootstrap 5">
    <title>Login - Antree Web App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <?php if(isset($error)):?>
    <div class="alert alert-danger" role="alert">
        Maaf, Username / Kata sandi tidak benar!
    </div>
    <?php endif; ?>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="logo/antree-brand-dark.png" alt="logo" width="200">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                            <form method="POST" class="needs-validation" novalidate="" autocomplete="off">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="email">Username</label>
                                    <input id="email" type="email" class="form-control" name="username" value="" required
                                        autofocus>
                                    <div class="invalid-feedback">
                                        Username masih kosong
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="password">Password</label>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <div class="invalid-feedback">
                                        Password masih kosong
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                        <label for="remember" class="form-check-label">Ingat saya</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary ms-auto" name="login">
                                        Login
                                    </button>
                                </div>
                                <div class="mt-3">
                                        <a href="https://wa.me/6289680280452" class="float-start text-decoration-none fst-italic text-secondary">
                                            Lupa sandi ?
                                        </a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-center mt-5 text-muted mb-5">
                            Copyright &copy; 2022 &mdash; by Hadi Fiqih
                        </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/login.js"></script>
</body>

</html>
