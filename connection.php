<?php

$connect = mysqli_connect('localhost', 'intd4232_antree', 'adminantree', 'intd4232_webantree');

if ($connect) {
    // echo "Berhasil";
} else {
    echo "Error: " . mysqli_connect_error();
}

function query($query)
{
    global $connect;
    $hasil = mysqli_query($connect, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($hasil)) {
        $rows[] = $row;
    }
    return $rows;
}

function registrasi($data)
{
    global $connect;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($connect, $data['password']);
    $konfirm = mysqli_real_escape_string($connect, $data['konfirm']);

    $result = mysqli_query($connect, "SELECT username FROM data_user WHERE username = '$username'");

    if ($password == "" || $konfirm == ""){
        echo "<script>
            alert('Password masih kosong !');
        </script>
        ";

        return false;
    }

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Gunakan username lain !');
                </script>";
        return false;
    }

    if ($password !== $konfirm) {
        echo "<script>
            alert('Konfirmasi password tidak sama !');
        </script>
        ";

        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($connect, "INSERT INTO data_user VALUES ('', '$username', '$password')");

    return mysqli_affected_rows($connect);
}
