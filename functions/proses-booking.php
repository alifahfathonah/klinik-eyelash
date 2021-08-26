<?php
include "../model/db.php";
session_start();

if (isset($_POST['submit'])) {
  $id_produk = $_POST['id_produk'];
  $harga = $_POST['harga'];
  $nama = $_POST['nama'];
  $no_telp = $_POST['no_telp'];
  $tgl_lahir = $_POST['tgl_lahir'];
  $tgl_pasang = $_POST['start'];
  $tgl_retouch = $_POST['tgl_retouch'];
  $start_jam = $_POST['start_jam'];
  $ends_jam = $_POST['ends_jam'];
  $sumber = $_POST['sumber'];
  $id_cabang = $_POST['id_cabang'];
  $id_users = $_POST['id_users'];
  $warna = $_POST['warna'];
  $transfer = $_POST['transfer'];
  $cash = $_POST['cash'];
  $keterangan = $_POST['keterangan'];
  $status = 1;

  $query = mysqli_query($link, "SELECT a.* FROM users a WHERE a.id_users = '$id_users' ");
  $username = mysqli_fetch_array($query);

  $cekdulu =  mysqli_query($link, "SELECT * FROM events WHERE start = '$tgl_pasang' ");
  $data = mysqli_fetch_array($cekdulu);
  // var_dump($data['start']);die();

  // echo $start_jam . " != " . $data['start_jam'] . " && " . $ends_jam . " != " . $data['ends_jam'] . " && " . $id_cabang . " != " . $data['id_cabang'];
  // die();

  if (strval($start_jam) != strval($data['start_jam']) && strval($ends_jam) != strval($data['ends_jam']) && strval($id_cabang) != strval($data['id_cabang'])) {
    $query = "INSERT INTO events(nama, no_telp, start, start_jam, ends, ends_jam, sumber, id_produk, id_cabang, harga, id_tipe, id_users, transfer, cash, warna, keterangan, tgl_retouch, tgl_lahir, status) values ('$nama', '$no_telp', '$tgl_pasang', '$start_jam', '', '$ends_jam', '$sumber', '$id_produk', '$id_cabang', '$harga', '', '$id_users', '$transfer', '$cash', '$warna', '$keterangan', '$tgl_retouch', '$tgl_lahir', '$status')";
    $result = mysqli_query($link, $query);
    $id = mysqli_insert_id($link);
    // var_dump($query);
    // die();
    if ($result) { // Cek jika proses simpan ke database sukses atau tidak
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "Booking Berhasil Di Simpan";
      $_SESSION['status_code'] = "success";
      header("location: ../booking");
    } else {
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "Booking Gagal Di Simpan";
      $_SESSION['status_code'] = "error";
      header("location: ../booking");
    }
  } else {
    $_SESSION['status'] = "Gagal";
    $_SESSION['status_text'] = ' ' . $username['username'] . ' Sudah Mempunyai Jadwal di Jam ' . $start_jam . ' - ' . $ends_jam . ' ';
    $_SESSION['status_code'] = "error";
    header("location: ../booking");
  }
}

if (isset($_POST['edit'])) {
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

  $query = mysqli_query($link, "SELECT a.* FROM users a WHERE a.id_users = '$id_users' ");
  $username = mysqli_fetch_array($query);

  $cekdulu =  mysqli_query($link, "SELECT * FROM events WHERE start = '$start'");
  $data = mysqli_fetch_array($cekdulu);

  // echo $start . "<br />";
  // echo $start_jam . "<br />";
  // echo $ends_jam . "<br />";
  // echo $id_users . "<br /><br />";

  // echo $data['start'] . "<br />";
  // echo $data['start_jam'] . "<br />";
  // echo $data['ends_jam'] . "<br />";
  // echo $data['id_users'] . "<br />";

  // echo $start . " == " . $data['start'] . " && " . $start . " != " . $data['start'];
  // die();

  if ($start == $data['start']) {
    $sql = "UPDATE events SET nama='$nama', no_telp='$no_telp', sumber='$sumber', id_produk='$id_produk', id_cabang='$id_cabang', harga='$harga', id_tipe='$id_tipe', id_users='$id_users', transfer='$transfer', cash='$cash', warna='$warna', keterangan='$keterangan', start_jam = '$start_jam', ends_jam = '$ends_jam', tgl_retouch = '$tgl_retouch', tgl_lahir = '$tgl_lahir' WHERE id = $id";
    $result = mysqli_query($link, $sql);
    // var_dump($result);die();
    if ($result) { // Cek jika proses simpan ke database sukses atau tidak
      // Jika Sukses, Lakukan :
      $_SESSION['status'] = "Berhasil";
      $_SESSION['status_text'] = "Booking Berhasil Di Edit";
      $_SESSION['status_code'] = "success";
      header("location: ../booking");
    } else {
      // Jika Gagal, Lakukan :  
      $_SESSION['status'] = "Gagal";
      $_SESSION['status_text'] = "Booking Gagal Di Edit";
      $_SESSION['status_code'] = "error";
      header("location: ../booking");
    }
  } else {
    // Jika Gagal, Lakukan :  
    $_SESSION['status'] = "Gagal";
    $_SESSION['status_text'] = ' ' . $username['username'] . ' Sudah Mempunyai Jadwal di Jam ' . $start_jam . ' - ' . $ends_jam . ' ';
    $_SESSION['status_code'] = "error";
    header("location: ../booking");
  }
}

if (isset($_POST['tanya_tanya'])) {
  $nama = $_POST['nama'];
  $no_telp = $_POST['no_telp'];
  $sumber = $_POST['sumber'];
  $status = 2;

  $query = "INSERT INTO events(nama, no_telp, sumber, status) values ('$nama', '$no_telp', '$sumber','$status')";
  $result = mysqli_query($link, $query);
  $id = mysqli_insert_id($link);
  // var_dump($result);die();
  if ($result) { // Cek jika proses simpan ke database sukses atau tidak
    $_SESSION['status'] = "Berhasil";
    $_SESSION['status_text'] = "data Berhasil Di Simpan";
    $_SESSION['status_code'] = "success";
    header("location: ../dashboard");
  } else {
    $_SESSION['status'] = "Gagal";
    $_SESSION['status_text'] = "data Gagal Di Simpan";
    $_SESSION['status_code'] = "error";
    header("location: ../dashboard");
  }
}

if (isset($_POST['Event'])) {
  $id = $_POST['Event'][0];
  $start = $_POST['Event'][1];
  $end = $_POST['Event'][2];

  $sql = "UPDATE events SET  start = '$start', ends = '$end' WHERE id = $id ";
  $result = mysqli_query($link, $sql);
  // var_dump($result);die();
  if ($result) { // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    echo "sukses";
  } else {
    echo "Gagal";
  }
}
