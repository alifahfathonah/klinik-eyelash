<?php

// include database connection file
include("../model/db.php");

$id_produk = $_POST['id_produk'];
$start = $_POST['start'];

$query = mysqli_query($link, "SELECT * FROM tbl_produk WHERE id_produk = $id_produk ");
$hasil = mysqli_fetch_array($query);

$date = strtotime($start);
$tujuh_hari = strtotime('+'.$hasil['waktu_retouch'].' day', $date);
$retouch = date("Y-m-d", $tujuh_hari);
// $retouch = date("Y-m-d", $hasil['waktu_retouch']);
// $retouch = date('d F Y', strtotime($kembali));

echo '<input type="date" name="tgl_retouch" class="form-control tgl_retouch" id="tgl_retouch" placeholder="Title" required="" value="' . $retouch . '">';
// while ($hasil = mysqli_fetch_array($query)) {
// 	echo '<option value="'.$hasil['id_produk'].'">'.$hasil['waktu_pemasangan'].'</option>';
// }
