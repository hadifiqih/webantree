<?php
require '../connection.php';
$keyword = $_GET['keyword'];
$query = "SELECT * FROM data_antrian WHERE keyword_stempel LIKE '%$keyword%'";
$row = query($query);
?>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Sales</th>
            <th scope="col">Keyword</th>
            <th scope="col">Pekerjaan</th>
            <th scope="col">Deadline</th>
            <th scope="col">Workshop</th>
            <th scope="col" class="text-center">File Desain</th>
            <th scope="col" class="text-center">File Dokumentasi</th>
            <th scope="col">Status</th>
            <th scope="col" class="text-center">Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($row as $result) {
            echo '<tr>';

            // $kodeAntrian = preg_replace("/[^a-zA-Z0-9]/", "", $result['tanggal_antrian']);
            // $kodeAntrian = $kodeAntrian . "-" . $result['no_antrian'];

            echo '<td>' . $result['no_antrian'] . '</td>';
            echo '<td>' . $result['nama_sales'] . '</td>';
            echo '<td>' . $result['keyword_stempel'] . '</td>';
            echo '<td>' . $result['nama_pekerjaan'] . '</td>';
            echo '<td>' . $result['selesai_kerja'] . '</td>';
            echo '<td>' . $result['tempat_workshop'] . '</td>';

            echo '<td class="text-center">';
            if ($result['file_desain'] == "") {
                echo "<a href='edit-file.php?no_antrian=" . $result['no_antrian'] . "' type='button' class='btn btn-primary btn-sm'><i class='fa-solid fa-circle-arrow-up'></i><span class='mx-2'>Desain</span></a>";
            } elseif ($result['file_desain'] != "") {
                echo "<a href='edit-file.php?no_antrian=" . $result['no_antrian'] . "' type='button' class='btn btn-success btn-sm'><i class='fa-solid fa-circle-arrow-down'></i><span class='mx-2'>Download</span></a>";
            }
            echo '</td>';

            echo '<td class="text-center">';
            if ($result['file_dokumentasi'] == "") {
                echo "<a href='upload-dokumentasi.php?no_antrian=" . $result['no_antrian'] . "' type='button' class='btn btn-primary btn-sm'><i class='fa-solid fa-circle-arrow-up'></i><span class='mx-2'>Dokumentasi</span></a>";
            } else if ($result['file_dokumentasi'] != "") {
                echo "<a href='upload-dokumentasi.php?no_antrian=" . $result['no_antrian'] . "' type='button' class='btn btn-success btn-sm'><i class='fa-solid fa-circle-check'></i><span class='mx-2'>Selesai</span></a>";
            }
            echo '</td>';

            echo '<td>';
            if ($result['file_desain'] == "" && $result['file_dokumentasi'] == "") {
                echo '<span class="badge bg-danger text-light">Belum</span>';
            } else if ($result['file_desain'] != "" && $result['file_dokumentasi'] == "") {
                echo '<span class="badge bg-warning text-dark">Proses</span>';
            } else if ($result['file_desain'] != "" && $result['file_dokumentasi'] != "") {
                echo '<span class="badge bg-success text-light">Selesai</span>';
            }
            echo '</td>';

            echo '<td class="text-center">';
            echo '  <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Edit
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <a class="dropdown-item" href="edit-antrian.php?no_antrian=' . $result['no_antrian'] . '">Edit Antrian</a>
                                    <a class="dropdown-item deleteAntrian" href="delete-antrian.php?no_antrian=' . $result['no_antrian'] . '">Hapus Antrian</a>
                                ';
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>