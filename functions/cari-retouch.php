<?php 

// include database connection file
include ("../model/db.php");

$id_produk = $_POST['id_produk'];

$query = mysqli_query($link,"SELECT * FROM tbl_produk WHERE id_produk = $id_produk ");
$hasil = mysqli_fetch_array($query);

$booking = date("Y-m-d");
$tujuh_hari = mktime(0,0,0,date("n"),date("j")+$hasil['waktu_pemasangan'],date("Y"));
$retouch = date("Y-m-d", $tujuh_hari);
// $retouch = date('d F Y', strtotime($kembali));

echo '<input type="date" name="tgl_retouch" class="form-control" id="tgl_retouch" placeholder="Title" required="" value="'.$retouch.'">';
// while ($hasil = mysqli_fetch_array($query)) {
// 	echo '<option value="'.$hasil['id_produk'].'">'.$hasil['waktu_pemasangan'].'</option>';
// }


	
