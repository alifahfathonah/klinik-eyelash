<?php
include "../model/db.php";
session_start();

if(isset($_POST['submit'])){ 
  $nama = $_POST['nama'];
  $no_telp = $_POST['no_telp'];
  $start = $_POST['start'];
  $end = $_POST['end'];
  $start_jam = $_POST['start_jam'];
  $ends_jam = $_POST['ends_jam'];
  $sumber = $_POST['sumber'];
  $id_produk = $_POST['id_produk'];
  $id_cabang = $_POST['id_cabang'];;
  $harga = $_POST['harga'];
  $id_tipe = $_POST['id_tipe'];
  $id_users = $_POST['id_users'];
  $transfer = $_POST['transfer'];
  $cash = $_POST['cash'];
  $warna = $_POST['warna'];
  $keterangan = $_POST['keterangan'];
  $tgl_retouch = $_POST['tgl_retouch'];
  $tgl_lahir = $_POST['tgl_lahir'];
  $status = 1;

  $query = mysqli_query($link,"SELECT a.* FROM users a WHERE a.id_users = '$id_users' ");
  $username = mysqli_fetch_array($query);

  $cekdulu=  mysqli_query($link,"SELECT * FROM events WHERE start = '$start' ");
  $data = mysqli_fetch_array($cekdulu);
  // var_dump($data['start']);die();

  if ($start == $data['start'] && $ends_jam != $data['ends_jam']) {
    $query = "INSERT INTO events(nama, no_telp, start, start_jam, ends, ends_jam, sumber, id_produk, id_cabang, harga, id_tipe, id_users, transfer, cash, warna, keterangan, tgl_retouch, status) values ('$nama', '$no_telp', '$start', '$start_jam', '$end', '$ends_jam', '$sumber', '$id_produk', '$id_cabang', '$harga', '$id_tipe', '$id_users', '$transfer', '$cash', '$warna', '$keterangan', '$tgl_retouch', tgl_lahir = '$tgl_lahir', '$status')";
    $result=mysqli_query($link,$query);
    $id = mysqli_insert_id($link);
    // var_dump($result);die();
    if($result){ // Cek jika proses simpan ke database sukses atau tidak
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "Booking Berhasil Di Simpan";
      $_SESSION['status_code'] = "success";
      header("location: ../dashboard"); 
    }else{
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "Booking Gagal Di Simpan";
      $_SESSION['status_code'] = "error";
      header("location: ../dashboard"); 
    }
  }elseif ($start == $data['start'] && $ends_jam == $data['ends_jam'] && $id_users != $data['id_users']) {
    $query = "INSERT INTO events(nama, no_telp, start, start_jam, ends, ends_jam, sumber, id_produk, id_cabang, harga, id_tipe, id_users, transfer, cash, warna, keterangan, tgl_retouch, status) values ('$nama', '$no_telp', '$start', '$start_jam', '$end', '$ends_jam', '$sumber', '$id_produk', '$id_cabang', '$harga', '$id_tipe', '$id_users', '$transfer', '$cash', '$warna', '$keterangan', '$tgl_retouch', tgl_lahir = '$tgl_lahir', '$status')";
    $result=mysqli_query($link,$query);
    $id = mysqli_insert_id($link);
    // var_dump($result);die();
    if($result){ // Cek jika proses simpan ke database sukses atau tidak
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "Booking Berhasil Di Simpan";
      $_SESSION['status_code'] = "success";
      header("location: ../dashboard"); 
    }else{
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "Booking Gagal Di Simpan";
      $_SESSION['status_code'] = "error";
      header("location: ../dashboard"); 
    }

  }elseif ($start != $data['start']){
    $query = "INSERT INTO events(nama, no_telp, start, start_jam, ends, ends_jam, sumber, id_produk, id_cabang, harga, id_tipe, id_users, transfer, cash, warna, keterangan, tgl_retouch, tgl_lahir, status) values ('$nama', '$no_telp', '$start', '$start_jam', '$end', '$ends_jam', '$sumber', '$id_produk', '$id_cabang', '$harga', '$id_tipe', '$id_users', '$transfer', '$cash', '$warna', '$keterangan', '$tgl_retouch', '$tgl_lahir','$status')";
    $result=mysqli_query($link,$query);
    $id = mysqli_insert_id($link);
    // var_dump($result);die();
    if($result){ // Cek jika proses simpan ke database sukses atau tidak
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "Booking Berhasil Di Simpan";
      $_SESSION['status_code'] = "success";
      header("location: ../dashboard"); 
    }else{
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "Booking Gagal Di Simpan";
      $_SESSION['status_code'] = "error";
      header("location: ../dashboard"); 
    }
  }else{
    $_SESSION['status'] = "Gagal";
    $_SESSION['status_text'] = ' '.$username['username'].' Sudah Mempunyai Jadwal di Jam '.$start_jam.' - '.$ends_jam.' ';
    $_SESSION['status_code'] = "error";
    header("location: ../dashboard"); 
  }
}

if(isset($_POST['edit'])){ 
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $no_telp = $_POST['no_telp'];
  $sumber = $_POST['sumber'];
  $id_produk = $_POST['id_produk'];
  $id_cabang = $_POST['id_cabang'];
  $harga = $_POST['harga'];
  $id_tipe = $_POST['id_tipe'];
  $id_users = $_POST['id_users'];
  $transfer = $_POST['transfer'];
  $cash = $_POST['cash'];
  $warna = $_POST['warna'];
  $keterangan = $_POST['keterangan'];
  $start = $_POST['start'];
  $start_jam = $_POST['start_jam'];
  $ends_jam = $_POST['ends_jam'];
  $tgl_retouch = $_POST['tgl_retouch'];
  $tgl_lahir = $_POST['tgl_lahir'];

  $query = mysqli_query($link,"SELECT a.* FROM users a WHERE a.id_users = '$id_users' ");
  $username = mysqli_fetch_array($query);

  $cekdulu=  mysqli_query($link,"SELECT * FROM events WHERE start = '$start' ");
  $data = mysqli_fetch_array($cekdulu);

  if ($start == $data['start'] && $ends_jam != $data['ends_jam']) {
    $sql = "UPDATE events SET nama='$nama', no_telp='$no_telp', sumber='$sumber', id_produk='$id_produk', id_cabang='$id_cabang', harga='$harga', id_tipe='$id_tipe', id_users='$id_users', transfer='$transfer', cash='$cash', warna='$warna', keterangan='$keterangan', start_jam = '$start_jam', ends_jam = '$ends_jam', tgl_retouch = '$tgl_retouch', tgl_lahir = '$tgl_lahir' WHERE id = $id";
    $result = mysqli_query($link, $sql);
    // var_dump($result);die();
    if($result){ // Cek jika proses simpan ke database sukses atau tidak
          // Jika Sukses, Lakukan :
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "Booking Berhasil Di Edit";
      $_SESSION['status_code'] = "success";
      header("location: ../dashboard");   

    }else{
      // Jika Gagal, Lakukan :  
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "Booking Gagal Di Edit";
      $_SESSION['status_code'] = "error";
      header("location: ../dashboard");   
    }
  }elseif ($start == $data['start'] && $ends_jam == $data['ends_jam'] && $id_users != $data['id_users']) {
    $sql = "UPDATE events SET nama='$nama', no_telp='$no_telp', sumber='$sumber', id_produk='$id_produk', id_cabang='$id_cabang', harga='$harga', id_tipe='$id_tipe', id_users='$id_users', transfer='$transfer', cash='$cash', warna='$warna', keterangan='$keterangan', start_jam = '$start_jam', ends_jam = '$ends_jam', tgl_retouch = '$tgl_retouch', tgl_lahir = '$tgl_lahir' WHERE id = $id";
    $result = mysqli_query($link, $sql);
    // var_dump($result);die();
    if($result){ // Cek jika proses simpan ke database sukses atau tidak
          // Jika Sukses, Lakukan :
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "Booking Berhasil Di Edit";
      $_SESSION['status_code'] = "success";
      header("location: ../dashboard");   

    }else{
      // Jika Gagal, Lakukan :  
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "Booking Gagal Di Edit";
      $_SESSION['status_code'] = "error";
      header("location: ../dashboard");   
    }
  }elseif ($start != $data['start']){
    $sql = "UPDATE events SET nama='$nama', no_telp='$no_telp', sumber='$sumber', id_produk='$id_produk', id_cabang='$id_cabang', harga='$harga', id_tipe='$id_tipe', id_users='$id_users', transfer='$transfer', cash='$cash', warna='$warna', keterangan='$keterangan', start_jam = '$start_jam', ends_jam = '$ends_jam', tgl_retouch = '$tgl_retouch', tgl_lahir = '$tgl_lahir' WHERE id = $id";
    $result = mysqli_query($link, $sql);
    // var_dump($result);die();
    if($result){ // Cek jika proses simpan ke database sukses atau tidak
          // Jika Sukses, Lakukan :
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "Booking Berhasil Di Edit";
      $_SESSION['status_code'] = "success";
      header("location: ../dashboard");   

    }else{
      // Jika Gagal, Lakukan :  
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "Booking Gagal Di Edit";
      $_SESSION['status_code'] = "error";
      header("location: ../dashboard");   
    }
  }elseif ($id_users == $data['id_users'] && $start_jam != $data['start_jam']){
    $sql = "UPDATE events SET nama='$nama', no_telp='$no_telp', sumber='$sumber', id_produk='$id_produk', id_cabang='$id_cabang', harga='$harga', id_tipe='$id_tipe', id_users='$id_users', transfer='$transfer', cash='$cash', warna='$warna', keterangan='$keterangan', start_jam = '$start_jam', ends_jam = '$ends_jam', tgl_retouch = '$tgl_retouch', tgl_lahir = '$tgl_lahir' WHERE id = $id";
    $result = mysqli_query($link, $sql);
    // var_dump($result);die();
    if($result){ // Cek jika proses simpan ke database sukses atau tidak
          // Jika Sukses, Lakukan :
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "Booking Berhasil Di Edit";
      $_SESSION['status_code'] = "success";
      header("location: ../dashboard");   

    }else{
      // Jika Gagal, Lakukan :  
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "Booking Gagal Di Edit";
      $_SESSION['status_code'] = "error";
      header("location: ../dashboard");   
    }
  }else{
    // Jika Gagal, Lakukan :  
    $_SESSION['status'] = "Gagal";
    $_SESSION['status_text'] = ' '.$username['username'].' Sudah Mempunyai Jadwal di Jam '.$start_jam.' - '.$ends_jam.' ';
    $_SESSION['status_code'] = "error";
    header("location: ../dashboard"); 
  }
}

if(isset($_POST['tanya_tanya'])){ 
  $nama = $_POST['nama'];
  $no_telp = $_POST['no_telp'];
  $sumber = $_POST['sumber'];
  $status = 2;

  $query = "INSERT INTO events(nama, no_telp, sumber, status) values ('$nama', '$no_telp', '$sumber','$status')";
    $result=mysqli_query($link,$query);
    $id = mysqli_insert_id($link);
    // var_dump($result);die();
    if($result){ // Cek jika proses simpan ke database sukses atau tidak
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "data Berhasil Di Simpan";
      $_SESSION['status_code'] = "success";
      header("location: ../dashboard"); 
    }else{
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "data Gagal Di Simpan";
      $_SESSION['status_code'] = "error";
      header("location: ../dashboard"); 
    }
}

if(isset($_POST['Event'])){ 
  $id = $_POST['Event'][0];
  $start = $_POST['Event'][1];
  $end = $_POST['Event'][2];

  $sql = "UPDATE events SET  start = '$start', ends = '$end' WHERE id = $id ";
  $result = mysqli_query($link, $sql);
  // var_dump($result);die();
  if($result){ // Cek jika proses simpan ke database sukses atau tidak
        // Jika Sukses, Lakukan :
    echo "sukses";

  }else{
    echo "Gagal";
  }
}