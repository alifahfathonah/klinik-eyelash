<?php
// Load file koneksi.php
include "../model/db.php";
session_start();
// $jumlahFile = 10;

if (isset($_POST['submit'])) {
    $id_cabang = $_POST['id_cabang'];
    $id_jabatan = $_POST['jabatan'];
    $jam = $_POST['jam'];


    $query = "INSERT INTO tbl_slot(jam, id_cabang, id_jabatan) values('$jam', '$id_cabang', '$id_jabatan')";
    $result = mysqli_query($link, $query);
    $id = mysqli_insert_id($link);
    // var_dump($result);die();
    if ($result) { // Cek jika proses simpan ke database sukses atau tidak
        // Jika Sukses, Lakukan :
        $_SESSION['status'] = "Berhasil";
        $_SESSION['status_text'] = "Slot Jam Berhasil Di Simpan";
        $_SESSION['status_code'] = "success";
        header("location: ../slot");
    } else {
        // Jika Gagal, Lakukan :
        $_SESSION['status'] = "Gagal";
        $_SESSION['status_text'] = "Slot Jam Gagal Di Simpan";
        $_SESSION['status_code'] = "error";
        header("location: ../slot");
    }
}

if (isset($_POST['edit'])) {
    $id_cabang = $_POST['id_cabang'];
    $id_jabatan = $_POST['id_jabatan'];
    $jam = $_POST['jam'];
    $id_slot = $_POST['id_slot'];

    $sql = "UPDATE tbl_slot SET jam='$jam' WHERE id_slot = $id_slot";
    $result = mysqli_query($link, $sql);
    // var_dump($result);die();
    if ($result) { // Cek jika proses simpan ke database sukses atau tidak
        // Jika Sukses, Lakukan :
        $_SESSION['status'] = "Berhasil";
        $_SESSION['status_text'] = "Slot Jam Berhasil Di Edit";
        $_SESSION['status_code'] = "success";
        header("location: ../slot");
    } else {
        // Jika Gagal, Lakukan :
        $_SESSION['status'] = "Gagal";
        $_SESSION['status_text'] = "Slot Jam Gagal Di Edit";
        $_SESSION['status_code'] = "error";
        header("location: ../slot");
    }
}
