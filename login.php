<?php

session_start();
require 'connection.php';

if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($connect, "SELECT * FROM data_user WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);

    if($key === hash('sha512', $row['username'])){
        $_SESSION['login'] = true;
    }
}

if(isset($_SESSION['login'])){
    header('location:list-antrian.php');
}

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($connect, "SELECT * FROM data_user WHERE username='$username'");

    if(mysqli_num_rows($result) === 1){
        //cek password
        $row = mysqli_fetch_assoc($result);
        $checkpass = password_verify($password, $row['password']);
        if($checkpass == true){
            $_SESSION['login'] = true;

            if(isset($_POST['remember'])){
                setcookie('id', $row['id'], time() + 172800);
                setcookie('key', hash('sha512', $row['username']), time() + 172800);
            }

            header('location:list-antrian.php');
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
    <meta name="author" content="Muhamad Nauval Azhar">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="This is a login page template based on Bootstrap 5">
    <title>Login - Antree Web App</title>
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
                            <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                            <?php if (isset($error)) :?>
                                <div class="alert alert-danger" role="alert">
                                    Username / password salah !
                                </div>
                            <?php endif; ?>
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
                    <div class="text-center mt-5 text-muted">
                            Copyright &copy; 2022 &mdash; by Hadi Fiqih
                        </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/login.js"></script>
</body>

</html>
