<?php
// Load file koneksi.php
include "../model/db.php";
session_start();

if(isset($_POST['submit'])){ 
  $id_pemesanan = $_POST['id_events'];
  $kode_customer = $_POST['kode_customer'];
  $komplain = $_POST['komplain'];
  $penyebab = $_POST['penyebab'];
  $solusi = $_POST['solusi'];
  $date_created = date('Y-m-d');
  $date_updated = date('Y-m-d');

  $query="INSERT INTO komplain(id_pemesanan, kode_customer, komplain, penyebab, solusi, date_created, date_updated) values('$id_pemesanan', '$kode_customer', '$komplain', '$penyebab', '$solusi', '$date_created', '$date_updated')";
  $result=mysqli_query($link,$query);
  $id = mysqli_insert_id($link);
  // var_dump($result);die();
  if($result){ // Cek jika proses simpan ke database sukses atau tidak
        // Jika Sukses, Lakukan :
    $_SESSION['status'] = "Berhasil";
    $_SESSION['status_text'] = "Komplain Berhasil Di Simpan";
    $_SESSION['status_code'] = "success";
    header("location: ../data-customer"); 

  }else{
    // Jika Gagal, Lakukan :
    $_SESSION['status'] = "Gagal";
    $_SESSION['status_text'] = "Komplain Gagal Di Simpan";
    $_SESSION['status_code'] = "error";
    header("location: ../data-customer");   
  }
}

?>