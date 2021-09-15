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
  $id_jabatan = $_POST['id_jabatan'];
  $warna = $_POST['warna'];
  $transfer = $_POST['transfer'];
  $cash = $_POST['cash'];
  $keterangan = $_POST['keterangan'];
  $status = 1;

  if ($id_cabang == '1') {
    if ($start_jam == '09:00') {
      $id_slot = '1';
    } else if ($start_jam == '10:00') {
      $id_slot = '2';
    } else if ($start_jam == '11:00') {
      $id_slot = '3';
    } else if ($start_jam == '12:00') {
      $id_slot = '4';
    } else if ($start_jam == '13:00') {
      $id_slot = '5';
    } else {
      $id_slot = '0';
    }
  } else if ($id_cabang == '2') {
    if ($start_jam == '09:00') {
      $id_slot = '16';
    } else if ($start_jam == '10:00') {
      $id_slot = '17';
    } else if ($start_jam == '11:00') {
      $id_slot = '18';
    } else if ($start_jam == '12:00') {
      $id_slot = '19';
    } else if ($start_jam == '13:00') {
      $id_slot = '20';
    } else {
      $id_slot = '0';
    }
  } else if ($id_cabang == '3') {
    if ($start_jam == '09:00') {
      $id_slot = '21';
    } else if ($start_jam == '10:00') {
      $id_slot = '22';
    } else if ($start_jam == '11:00') {
      $id_slot = '23';
    } else if ($start_jam == '12:00') {
      $id_slot = '24';
    } else if ($start_jam == '13:00') {
      $id_slot = '25';
    } else {
      $id_slot = '0';
    }
  }

  if ($_POST['jenis_customer'] == 'customer_lama') {
    $query = mysqli_query($link, "SELECT a.* FROM users a WHERE a.id_users = '$id_users' ");
    $username = mysqli_fetch_array($query);

    $cekdulu =  mysqli_query($link, "SELECT * FROM events WHERE start = '$tgl_pasang' AND id_users= '$id_users' AND id_cabang= '$id_cabang' AND start_jam = '$start_jam'");
    $data = mysqli_fetch_array($cekdulu);

    if ($_POST['status_customer'] == 1) {
      if ($data == NULL) {
        $query = "INSERT INTO events(start, start_jam, ends, ends_jam, id_produk, id_slot, id_cabang, harga, id_tipe, id_users, transfer, cash, warna, keterangan, tgl_retouch, kode_customer, id_jabatan) values ('$tgl_pasang', '$start_jam', '', '$ends_jam', '$id_produk', '$id_slot', '$id_cabang', '$harga', '', '$id_users', '$transfer', '$cash', '$warna', '$keterangan', '$tgl_retouch', '$nama', '$id_jabatan')";
        $result = mysqli_query($link, $query);
        $id = mysqli_insert_id($link);
        // var_dump($result);die();
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
    } else if ($_POST['status_customer'] == 2) {
      if ($data == NULL) {
        $query = "INSERT INTO events(start, start_jam, ends, ends_jam, id_produk, id_slot, id_cabang, harga, id_tipe, id_users, transfer, cash, warna, keterangan, tgl_retouch, kode_customer, id_jabatan) values ('$tgl_pasang', '$start_jam', '', '$ends_jam', '$id_produk', '$id_slot', '$id_cabang', '$harga', '', '$id_users', '$transfer', '$cash', '$warna', '$keterangan', '$tgl_retouch', '$nama', '$id_jabatan')";
        $result = mysqli_query($link, $query);
        $id = mysqli_insert_id($link);
        $query_update_customer = "UPDATE tbl_customer SET status = 1 WHERE kode_customer = '$nama'";
        mysqli_query($link, $query_update_customer);
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

  } else if ($_POST['jenis_customer'] == 'customer_baru') {
    $query_customer = mysqli_query($link, "SELECT max(kode_customer) as kode_customer FROM tbl_customer");
    $data = mysqli_fetch_array($query_customer);
    $kode_customer = $data['kode_customer'];
    $urutan = (int) substr($kode_customer, 4, 4);

    $urutan++;

    $huruf = "CKNW";
    $kodecustomer = $huruf . sprintf("%04s", $urutan);

    $query = mysqli_query($link, "SELECT a.* FROM users a WHERE a.id_users = '$id_users' ");
    $username = mysqli_fetch_array($query);

    $cekdulu =  mysqli_query($link, "SELECT * FROM events WHERE start = '$tgl_pasang' AND id_users= '$id_users' AND id_cabang= '$id_cabang' AND start_jam = '$start_jam'");
    $data = mysqli_fetch_array($cekdulu);

    if ($data == NULL) {
      $query = "INSERT INTO events(start, start_jam, ends, ends_jam, id_produk, id_slot, id_cabang, harga, id_tipe, id_users, transfer, cash, warna, keterangan, tgl_retouch, kode_customer, id_jabatan) values ('$tgl_pasang', '$start_jam', '', '$ends_jam', '$id_produk', '$id_slot', '$id_cabang', '$harga', '', '$id_users', '$transfer', '$cash', '$warna', '$keterangan', '$tgl_retouch', '$kodecustomer', '$id_jabatan')";
      $result = mysqli_query($link, $query);
      $id = mysqli_insert_id($link);
      $customer = "INSERT INTO tbl_customer(kode_customer, nama_customer, no_telp, tgl_lahir, sumber, status) VALUES('$kodecustomer', '$nama', '$no_telp', '$tgl_lahir', '$sumber', '$status')";
      mysqli_query($link, $customer);
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
}

if (isset($_POST['edit'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $kode_customer = $_POST['kode_customer'];
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

  $cekdulu =  mysqli_query($link, "SELECT * FROM events WHERE start = '$tgl_pasang' AND id_users= '$id_users' AND id_cabang= '$id_cabang' AND start_jam = '$start_jam'");
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

  if (!$data) {
    $sql = "UPDATE events SET id_produk='$id_produk', id_cabang='$id_cabang', harga='$harga', id_tipe='$id_tipe', id_users='$id_users', transfer='$transfer', cash='$cash', warna='$warna', keterangan='$keterangan', start_jam = '$start_jam', ends_jam = '$ends_jam', tgl_retouch = '$tgl_retouch', kode_customer = '$kode_customer', id_jabatan='$id_jabatan' WHERE id = $id";
    $result = mysqli_query($link, $sql);
    $query_customer = "UPDATE tbl_customer SET nama_customer = '$nama', no_telp = '$no_telp', sumber = '$sumber', tgl_lahir = '$tgl_lahir' WHERE kode_customer = '$kode_customer'";
    mysqli_query($link, $query_customer);
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

// FUNGSI TAMBAH CUSTOMER TANYA TANYA

if (isset($_POST['tanya_tanya'])) {

  $query = mysqli_query($link, "SELECT max(kode_customer) as kode_customer FROM tbl_customer");
  $data = mysqli_fetch_array($query);
  $kode_customer = $data['kode_customer'];
  $urutan = (int) substr($kode_customer, 4, 4);

  $urutan++;

  $huruf = "CKNW";
  $kodecustomer = $huruf . sprintf("%04s", $urutan);
  $nama = $_POST['nama'];
  $no_telp = $_POST['no_telp'];
  $sumber = $_POST['sumber'];
  $status = 2;

  $query = "INSERT INTO tbl_customer(kode_customer, nama_customer, no_telp, sumber, status) values ('$kodecustomer', '$nama', '$no_telp', '$sumber','$status')";
  $result = mysqli_query($link, $query);
  // var_dump($result);die();
  $id = mysqli_insert_id($link);
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

// FUNGSI EDIT TANYA TANYA
if (isset($_POST['edit_tanya'])) {

  $kode_customer = $_POST['kode_customer'];
  $nama = $_POST['nama'];
  $no_telp = $_POST['no_telp'];
  $sumber = $_POST['sumber'];
  $status = 2;

  $query = "UPDATE tbl_customer SET nama_customer = '$nama', no_telp = '$no_telp', sumber = '$sumber' WHERE kode_customer = '$kode_customer'";
  $result = mysqli_query($link, $query);
  // var_dump($result);die();
  $id = mysqli_insert_id($link);
  if ($result) { // Cek jika proses simpan ke database sukses atau tidak
    $_SESSION['status'] = "Berhasil";
    $_SESSION['status_text'] = "data Berhasil Di Simpan";
    $_SESSION['status_code'] = "success";
    header("location: ../data-customer");
  } else {
    $_SESSION['status'] = "Gagal";
    $_SESSION['status_text'] = "data Gagal Di Simpan";
    $_SESSION['status_code'] = "error";
    header("location: ../data-customer");
  }
}
// END FUNGSI EDIT TANYA TANYA

// FUNGSI EDIT CUSTOMER
if (isset($_POST['edit_customer'])) {

  $kode_customer = $_POST['kode_customer'];
  $nama = $_POST['nama'];
  $no_telp = $_POST['no_telp'];
  $sumber = $_POST['sumber'];
  $tgl_lahir = $_POST['tgl_lahir'];
  $status = 2;

  $query = "UPDATE tbl_customer SET nama_customer = '$nama', no_telp = '$no_telp', sumber = '$sumber', tgl_lahir = '$tgl_lahir' WHERE kode_customer = '$kode_customer'";
  $result = mysqli_query($link, $query);
  // var_dump($result);die();
  $id = mysqli_insert_id($link);
  if ($result) { // Cek jika proses simpan ke database sukses atau tidak
    $_SESSION['status'] = "Berhasil";
    $_SESSION['status_text'] = "data Berhasil Di Simpan";
    $_SESSION['status_code'] = "success";
    header("location: ../data-customer");
  } else {
    $_SESSION['status'] = "Gagal";
    $_SESSION['status_text'] = "data Gagal Di Simpan";
    $_SESSION['status_code'] = "error";
    header("location: ../data-customer");
  }
}
// END FUNGSI EDIT CUSTOMER

if (isset($_POST['Event'])) {
  $id = $_POST['Event'][0];
  $start = $_POST['Event'][1];
  $end = $_POST['Event'][2];

  $sql = "UPDATE events SET start = '$end' WHERE id = $id ";
  $result = mysqli_query($link, $sql);
  // var_dump($result);die();
  if ($result) { // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    echo "sukses";
  } else {
    echo "Gagal";
  }
}
