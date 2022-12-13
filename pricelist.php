<?php

session_start();

if(!isset($_SESSION['login'])){
    header('location:login.php');
    exit;
}

include('connection.php');

$query = mysqli_query($connect, 'SELECT * FROM data_flash');
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">
    <title>Pricelist Stempel</title>
</head>

<body>
    <div class="container">
        <div class="bg-warning rounded-3 mb-3">
            <br>
            <h1 class="text-center">Pricelist Stempel Flash</h1><br>
        </div>
        <table class="table">
            <thead>
                <th scope="col">Jenis Stempel</th>
                <th scope="col">Ukuran Stempel</th>
                <th scope="col">Ukuran Desain</th>
                <th scope="col">Harga</th>
            </thead>
            <tbody>
                <?php foreach ($result as $result) : ?>
                <tr>
                    <td><?php echo $result['jenis'] ?></td>
                    <td><?php echo $result['ukuran'] ?></td>
                    <td><?php echo $result['desain'] ?></td>
                    <td class="text-danger"><strong> Rp <?php echo $result['harga'] ?> </strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>