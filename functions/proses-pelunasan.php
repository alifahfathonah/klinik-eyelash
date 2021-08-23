<?php 
include "../model/db.php";
session_start();

if(isset($_POST['bayar_trans'])){ 
  $id = $_POST['id'];
  $transfer = $_POST['transfer'];
  $warna = '#008000';

  $cekdulu=  mysqli_query($link,"SELECT * FROM events WHERE id = '$id' ");
  $data = mysqli_fetch_array($cekdulu);
  $data_trans = $data['transfer'];

  if ($data['transfer'] == true) {
    $hasil = $transfer + $data_trans;

    $sql = "UPDATE events SET transfer='$hasil', warna = '$warna' WHERE id = $id";
    $result = mysqli_query($link, $sql);
    // var_dump($result);die();
    if($result){ // Cek jika proses simpan ke database sukses atau tidak
          // Jika Sukses, Lakukan :
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "Pembayaran Berhasil";
      $_SESSION['status_code'] = "success";
      header("location: ../data-customer");   

    }else{
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "Pembayaran Gagal";
      $_SESSION['status_code'] = "error";
      header("location: ../data-customer");   
    }
  }else{
    $hasil = $transfer;
    $sql = "UPDATE events SET transfer='$hasil', warna = '$warna' WHERE id = $id";
    $result = mysqli_query($link, $sql);
    // var_dump($result);die();
    if($result){ // Cek jika proses simpan ke database sukses atau tidak
          // Jika Sukses, Lakukan :
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "Pembayaran Berhasil";
      $_SESSION['status_code'] = "success";
      header("location: ../data-customer");   

    }else{
      // Jika Gagal, Lakukan :  
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "Pembayaran Gagal";
      $_SESSION['status_code'] = "error";
      header("location: ../data-customer");   
    }
  }
}

if(isset($_POST['bayar_cash'])){ 
  $id = $_POST['id'];
  $cash = $_POST['cash'];
  $warna = '#008000';

  $cekdulu=  mysqli_query($link,"SELECT * FROM events WHERE id = '$id' ");
  $data = mysqli_fetch_array($cekdulu);
  $data_cash = $data['cash'];

  if ($data['cash'] == true) {
    $hasil = $cash + $data_cash;

    $sql = "UPDATE events SET cash='$hasil', warna = '$warna' WHERE id = $id";
    $result = mysqli_query($link, $sql);
    // var_dump($result);die();
    if($result){ // Cek jika proses simpan ke database sukses atau tidak
          // Jika Sukses, Lakukan :
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "Pembayaran Berhasil";
      $_SESSION['status_code'] = "success";
      header("location: ../data-customer");   

    }else{
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "Pembayaran Gagal";
      $_SESSION['status_code'] = "error";
      header("location: ../data-customer");   
    }
  }else{
    $hasil = $cash;
    $sql = "UPDATE events SET cash='$hasil', warna = '$warna' WHERE id = $id";
    $result = mysqli_query($link, $sql);
    // var_dump($result);die();
    if($result){ // Cek jika proses simpan ke database sukses atau tidak
          // Jika Sukses, Lakukan :
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "Pembayaran Berhasil";
      $_SESSION['status_code'] = "success";
      header("location: ../data-customer");   

    }else{
      // Jika Gagal, Lakukan :  
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "Pembayaran Gagal";
      $_SESSION['status_code'] = "error";
      header("location: ../data-customer");   
    }
  }
}