<?php

session_start();

$divisi = $_SESSION['divisi'];

if (isset($_SESSION['login'])) {
    if ($divisi == 'admwrk') {
        header('location:admin-workshop.php');
        exit;
    } elseif ($divisi == 'sales') {
        header('location:sales.php');
        exit;
    } elseif ($divisi == 'desopr') {
        header('location:desopr.php');
        exit;
    } elseif ($divisi == 'dokumentasi') {
        header('location:div-dokumentasi.php');
        exit;
    }
} else {
    header('location:login.php');
    exit;
}
