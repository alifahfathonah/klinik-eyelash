<?php

$host   = 'onyx.cloudns.io';
$user   = 'sitesidadmin_klinik';
$pass   = 'Admin1234@yx##';
$db     = 'sitesidadmin_klinik';

// Admin1234@yx##
// db : sisiranb_batununggal

$link   = mysqli_connect($host, $user, $pass, $db);

// check koneksi
if (!$link) {
    die("Connection Failed: " . mysqli_connect_error());
    // printf("Connection failed: %s\n", mysqli_connect_error());
    // exit();
}

// echo "Connection successfully";