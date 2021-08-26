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

    if ($start_jam != $data['start_jam'] && $ends_jam != $data['ends_jam'] && $id_cabang != $data['id_cabang']) {
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
