<?php
// Load file koneksi.php
include "../model/db.php";
session_start();
// $jumlahFile = 10;

if (isset($_POST['submit'])) {
  $nama_cabang = $_POST['nama_cabang'];

  $query = "INSERT INTO tbl_cabang(nama_cabang) values('$nama_cabang')";
  $result = mysqli_query($link, $query);
  $id = mysqli_insert_id($link);
  // var_dump($result);die();
  if ($result) { // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    $_SESSION['status'] = "Berhasil";
    $_SESSION['status_text'] = "Cabang Berhasil Di Simpan";
    $_SESSION['status_code'] = "success";
    header("location: ../cabang");
  } else {
    // Jika Gagal, Lakukan :
    $_SESSION['status'] = "Gagal";
    $_SESSION['status_text'] = "cabang Gagal Di Simpan";
    $_SESSION['status_code'] = "error";
    header("location: ../cabang");
  }
}

if (isset($_POST['edit'])) {
  $id_cabang = $_POST['id_cabang'];
  $nama_cabang = $_POST['nama_cabang'];

  $sql = "UPDATE tbl_cabang SET nama_cabang='$nama_cabang' WHERE id_cabang = $id_cabang";
  $result = mysqli_query($link, $sql);
  // var_dump($result);die();
  if ($result) { // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    $_SESSION['status'] = "Berhasil";
    $_SESSION['status_text'] = "Cabang Berhasil Di Edit";
    $_SESSION['status_code'] = "success";
    header("location: ../cabang");
  } else {
    // Jika Gagal, Lakukan :
    $_SESSION['status'] = "Gagal";
    $_SESSION['status_text'] = "Cabang Gagal Di Edit";
    $_SESSION['status_code'] = "error";
    header("location: ../cabang");
  }
}

if (isset($_POST['submit-tipe'])) {
  $nama_produk = $_POST['nama_tipe'];

  $query = "INSERT INTO tbl_tipe(nama_tipe) values('$nama_produk')";
  $result = mysqli_query($link, $query);
  $id = mysqli_insert_id($link);
  // var_dump($result);die();
  if ($result) { // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    $_SESSION['status'] = "Berhasil";
    $_SESSION['status_text'] = "Tipe Produk Berhasil Di Simpan";
    $_SESSION['status_code'] = "success";
    header("location: ../tipe-produk");
  } else {
    // Jika Gagal, Lakukan :
    $_SESSION['status'] = "Gagal";
    $_SESSION['status_text'] = "Tipe Produk Gagal Di Simpan";
    $_SESSION['status_code'] = "error";
    header("location: ../tipe-produk");
  }
}

if (isset($_POST['edit-tipe'])) {
  $id_tipe = $_POST['id_tipe'];
  $nama_tipe = $_POST['nama_tipe'];

  $sql = "UPDATE tbl_tipe SET nama_tipe='$nama_tipe' WHERE id_tipe = $id_tipe";
  $result = mysqli_query($link, $sql);
  // var_dump($result);die();
  if ($result) { // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    $_SESSION['status'] = "Berhasil";
    $_SESSION['status_text'] = "Tipe Produk Berhasil Di Edit";
    $_SESSION['status_code'] = "success";
    header("location: ../tipe-produk");
  } else {
    // Jika Gagal, Lakukan :
    $_SESSION['status'] = "Gagal";
    $_SESSION['status_text'] = "Tipe Produk Gagal Di Edit";
    $_SESSION['status_code'] = "error";
    header("location: ../tipe-produk");
  }
}
